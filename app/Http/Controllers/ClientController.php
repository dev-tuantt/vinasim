<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{
    public function home()
    {
        $homeBannerUrl = null;
        $simProducts = [];
        $homePackages = [];

        if (Schema::hasTable('banners')) {
            $homeBanner = DB::table('banners')
                ->where('title', 'Trang chủ (Home)')
                ->where('is_active', 1)
                ->whereNotNull('image_url')
                ->orderByDesc('updated_at')
                ->first();

            $homeBannerUrl = $homeBanner->image_url ?? null;
        }

        if (Schema::hasTable('products')) {
            $simProducts = $this->getSimProducts(6);
            $homePackages = $this->getDataPackages(6);
        }

        return view('client.index', [
            'homeBannerUrl' => $homeBannerUrl,
            'simProducts' => $simProducts,
            'homePackages' => $homePackages,
        ]);
    }

    public function dataPackages()
    {
        return view('client.data', [
            'packages' => $this->getDataPackages(),
        ]);
    }

    public function simNumbers()
    {
        return view('client.sim', [
            'simProducts' => $this->getSimProducts(),
        ]);
    }

    public function news(Request $request)
    {
        $newsItems = $this->getPublishedNewsPaginated(6);

        if ($request->boolean('load_more')) {
            return response()->json([
                'html' => view('client.partials.news-cards', [
                    'newsItems' => $newsItems,
                ])->render(),
                'hasMorePages' => $newsItems->hasMorePages(),
                'nextPage' => $newsItems->currentPage() + 1,
            ]);
        }

        return view('client.news', [
            'newsItems' => $newsItems,
        ]);
    }

    public function newsDetail(string $slug)
    {
        $newsItem = $this->findPublishedNewsBySlug($slug);

        abort_if($newsItem === null, 404);

        return view('client.news-detail', [
            'newsItem' => $newsItem,
            'relatedNews' => $this->getRelatedNews($newsItem['id'], 3),
        ]);
    }

    public function about()
    {
        return view('client.about');
    }

    public function orderTracking(Request $request)
    {
        $phone = trim((string) $request->query('phone', ''));
        $normalizedPhone = $this->normalizePhone($phone);

        return view('client.order-tracking', [
            'phone' => $phone,
            'searched' => $phone !== '',
            'orders' => $normalizedPhone !== '' ? $this->findOrdersByPhone($phone, $normalizedPhone) : [],
        ]);
    }

    private function getDataPackages(?int $limit = null): array
    {
        if (!Schema::hasTable('products')) {
            return [];
        }

        $packageQuery = DB::table('products')
            ->where('category_id', 1)
            ->where('is_active', 1)
            ->orderByDesc('id');

        if ($limit !== null) {
            $packageQuery->limit($limit);
        }

        if (Schema::hasColumn('products', 'deleted_at')) {
            $packageQuery->whereNull('deleted_at');
        }

        return $packageQuery->get()->map(function ($product) {
            $specifications = json_decode($product->specifications ?? '{}', true);
            if (!is_array($specifications)) {
                $specifications = [];
            }

            return [
                'id' => (int) $product->id,
                'name' => (string) ($product->name ?? 'Goi cuoc uu dai'),
                'description' => (string) ($product->description ?? ''),
                'price' => (float) ($product->price ?? 0),
                'data' => (string) ($specifications['data'] ?? ''),
                'duration' => (string) ($specifications['duration'] ?? ''),
                'image' => (string) ($product->image_url ?? ''),
            ];
        })->all();
    }

    private function getSimProducts(?int $limit = null): array
    {
        if (!Schema::hasTable('products')) {
            return [];
        }

        $simQuery = DB::table('products')
            ->where('category_id', 2)
            ->where('is_active', 1)
            ->orderByDesc('id');

        if ($limit !== null) {
            $simQuery->limit($limit);
        }

        if (Schema::hasColumn('products', 'deleted_at')) {
            $simQuery->whereNull('deleted_at');
        }

        return $simQuery->get()->map(function ($product) {
            $specifications = json_decode($product->specifications ?? '{}', true);
            if (!is_array($specifications)) {
                $specifications = [];
            }

            $price = (float) ($product->price ?? 0);
            $oldPrice = isset($specifications['old_price']) ? (float) $specifications['old_price'] : 0;

            return [
                'id' => (int) $product->id,
                'name' => (string) ($product->name ?? 'SIM so dep uu dai'),
                'number' => (string) ($specifications['number'] ?? $product->name),
                'line_1' => (string) ($specifications['carrier'] ?? 'Data linh hoat cho nhu cau su dung hang ngay'),
                'line_2' => (string) ($specifications['commitment'] ?? ('gia chi tu ' . number_format($price, 0, ',', '.') . 'd/thang')),
                'description' => (string) ($product->description ?? ''),
                'price' => $price,
                'old_price' => $oldPrice > 0 ? $oldPrice : 0,
                'image' => (string) ($product->image_url ?? ''),
            ];
        })->all();
    }

    private function getPublishedNews(?int $limit = null): array
    {
        if (!Schema::hasTable('news')) {
            return [];
        }

        $newsQuery = DB::table('news')
            ->where('is_published', 1)
            ->orderByDesc('published_at')
            ->orderByDesc('id');

        if ($limit !== null) {
            $newsQuery->limit($limit);
        }

        return $newsQuery->get()->map(function ($news) {
            return $this->mapNewsItem($news);
        })->all();
    }

    private function findOrdersByPhone(string $rawPhone, string $normalizedPhone): array
    {
        if (!Schema::hasTable('orders')) {
            return [];
        }

        $phoneCandidates = array_values(array_unique(array_filter([
            $rawPhone,
            $normalizedPhone,
            $this->convertPhoneToLocal($normalizedPhone),
            $this->convertPhoneToInternational($normalizedPhone),
        ])));

        $query = DB::table('orders')->select('orders.*');

        if (Schema::hasTable('products')) {
            $query->leftJoin('products', 'products.id', '=', 'orders.product_id')
                ->addSelect('products.name as product_name');
        }

        $normalizedPhoneExpression = "REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(orders.customer_phone, ' ', ''), '.', ''), '-', ''), '(', ''), ')', '')";

        return $query
            ->where(function ($builder) use ($phoneCandidates, $normalizedPhoneExpression) {
                $builder->whereIn('orders.customer_phone', $phoneCandidates);

                foreach ($phoneCandidates as $candidate) {
                    $builder->orWhereRaw($normalizedPhoneExpression . ' = ?', [$candidate]);
                }
            })
            ->orderByDesc('orders.id')
            ->get()
            ->map(function ($order) {
                return $this->mapOrderItem($order);
            })
            ->all();
    }

    private function getPublishedNewsPaginated(int $perPage)
    {
        if (!Schema::hasTable('news')) {
            return new LengthAwarePaginator(
                [],
                0,
                $perPage,
                1,
                ['path' => route('news')]
            );
        }

        return DB::table('news')
            ->where('is_published', 1)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate($perPage)
            ->through(function ($news) {
                return $this->mapNewsItem($news);
            });
    }

    private function findPublishedNewsBySlug(string $slug): ?array
    {
        if (!Schema::hasTable('news')) {
            return null;
        }

        $news = DB::table('news')
            ->where('slug', $slug)
            ->where('is_published', 1)
            ->first();

        if ($news === null) {
            return null;
        }

        return $this->mapNewsItem($news);
    }

    private function getRelatedNews(int $excludeId, int $limit = 3): array
    {
        if (!Schema::hasTable('news')) {
            return [];
        }

        return DB::table('news')
            ->where('is_published', 1)
            ->where('id', '!=', $excludeId)
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->limit($limit)
            ->get()
            ->map(function ($news) {
                return $this->mapNewsItem($news);
            })
            ->all();
    }

    private function mapOrderItem(object $order): array
    {
        $orderDetailsRaw = (string) ($order->order_details ?? '');
        $orderDetails = json_decode($orderDetailsRaw, true);

        if (!is_array($orderDetails)) {
            $orderDetails = [];
        }

        $statusMeta = $this->getOrderStatusMeta((int) ($order->status ?? 1));

        return [
            'id' => (int) $order->id,
            'customer_name' => (string) ($order->customer_name ?? 'Khach hang'),
            'customer_phone' => (string) ($order->customer_phone ?? ''),
            'customer_email' => (string) ($order->customer_email ?? ''),
            'product_name' => (string) ($order->product_name ?? ('San pham #' . (int) ($order->product_id ?? 0))),
            'status' => (int) ($order->status ?? 1),
            'status_label' => $statusMeta['label'],
            'status_class' => $statusMeta['class'],
            'details' => $orderDetails,
            'created_at' => !empty($order->created_at) ? date('d/m/Y H:i', strtotime((string) $order->created_at)) : '',
            'updated_at' => !empty($order->updated_at) ? date('d/m/Y H:i', strtotime((string) $order->updated_at)) : '',
        ];
    }

    private function getOrderStatusMeta(int $status): array
    {
        return match ($status) {
            2 => ['label' => 'Dang xu ly', 'class' => 'bg-amber-100 text-amber-800 border border-amber-200'],
            3 => ['label' => 'Da xu ly', 'class' => 'bg-indigo-100 text-indigo-800 border border-indigo-200'],
            4 => ['label' => 'Hoan thanh', 'class' => 'bg-emerald-100 text-emerald-800 border border-emerald-200'],
            default => ['label' => 'Cho xu ly', 'class' => 'bg-slate-100 text-slate-700 border border-slate-200'],
        };
    }

    private function normalizePhone(string $phone): string
    {
        $normalized = preg_replace('/[^0-9+]/', '', $phone) ?? '';

        if (str_starts_with($normalized, '+')) {
            $normalized = substr($normalized, 1);
        }

        return $normalized;
    }

    private function convertPhoneToLocal(string $phone): string
    {
        if (str_starts_with($phone, '84')) {
            return '0' . substr($phone, 2);
        }

        return $phone;
    }

    private function convertPhoneToInternational(string $phone): string
    {
        if (str_starts_with($phone, '0')) {
            return '84' . substr($phone, 1);
        }

        return $phone;
    }

    private function mapNewsItem(object $news): array
    {
            $excerpt = trim((string) ($news->excerpt ?? ''));
            $content = trim(strip_tags((string) ($news->content ?? '')));

            return [
                'id' => (int) $news->id,
                'title' => (string) ($news->title ?? 'Tin tuc myLocal'),
                'slug' => (string) ($news->slug ?? ''),
                'excerpt' => $excerpt !== '' ? $excerpt : Str::limit($content, 180),
                'content' => (string) ($news->content ?? ''),
                'image' => (string) ($news->featured_image ?? ''),
                'published_at' => $news->published_at ? date('d/m/Y', strtotime((string) $news->published_at)) : '',
            ];
    }
}
