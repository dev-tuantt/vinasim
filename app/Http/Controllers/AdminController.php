<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Seo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('admin.dashboard');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'Email hoặc mật khẩu không đúng'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    private function getBannerSlots(): array
    {
        return [
            [
                'screen' => 'Trang chủ (Home)',
                'description' => 'Vi tri hero dau trang khach hang',
                'placeholder' => 'https://placehold.co/640x320/e2e8f0/334155?text=Home+Banner',
            ],
            [
                'screen' => 'Gói cước 4G/5G',
                'description' => 'Banner danh sach san pham goi cuoc',
                'placeholder' => 'https://placehold.co/640x320/dbeafe/1e40af?text=4G%2F5G+Banner',
            ],
            [
                'screen' => 'Sim số đẹp',
                'description' => 'Banner khu vuc chon sim',
                'placeholder' => 'https://placehold.co/640x320/ede9fe/5b21b6?text=Sim+Banner',
            ],
            [
                'screen' => 'Tin tức (News)',
                'description' => 'Banner dau muc bai viet',
                'placeholder' => 'https://placehold.co/640x320/fef3c7/92400e?text=News+Banner',
            ],
            [
                'screen' => 'Về chúng tôi (About)',
                'description' => 'Banner gioi thieu thuong hieu',
                'placeholder' => 'https://placehold.co/640x320/d1fae5/065f46?text=About+Banner',
            ],
            [
                'screen' => 'Tra cứu đơn hàng',
                'description' => 'Banner ho tro kiem tra trang thai don',
                'placeholder' => 'https://placehold.co/640x320/fee2e2/991b1b?text=Tracking+Banner',
            ],
        ];
    }

    public function index()
    {
        return view('/admin/index');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function user_index()
    {
        $users = User::latest()->get(); // lấy tất cả user, mới nhất trước

        return view('admin.user_index', compact('users'));
    }
    public function store_user(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return response()->json([
            'message' => 'Tạo người dùng thành công',
            'user' => $user
        ]);
    }
    public function update_user(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required|in:1,2',
            'password' => 'nullable|min:6'
        ]);

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'Updated successfully'
        ]);
    }

    public function destroy_user($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'Deleted successfully'
        ]);
    }

    public function banner_index()
    {
        $bannerSlots = $this->getBannerSlots();
        $bannerByTitle = [];

        if (Schema::hasTable('banners')) {
            $titles = array_map(static fn ($slot) => $slot['screen'], $bannerSlots);

            $bannerByTitle = DB::table('banners')
                ->whereIn('title', $titles)
                ->orderByDesc('updated_at')
                ->get()
                ->keyBy('title')
                ->toArray();
        }

        $banners = array_map(function ($slot) use ($bannerByTitle) {
            $bannerRecord = $bannerByTitle[$slot['screen']] ?? null;

            return [
                'id' => $bannerRecord->id ?? null,
                'screen' => $slot['screen'],
                'description' => $slot['description'],
                'placeholder' => $slot['placeholder'],
                'image_url' => $bannerRecord->image_url ?? $slot['placeholder'],
            ];
        }, $bannerSlots);

        return view('/admin/banner_index', compact('banners'));
    }

    public function upload_banner(Request $request)
    {
        if (!Schema::hasTable('banners')) {
            return response()->json(['message' => 'Bảng banners chưa được tạo'], 500);
        }

        $allowedScreens = array_map(static fn ($slot) => $slot['screen'], $this->getBannerSlots());

        $validatedData = $request->validate([
            'screen' => 'required|in:' . implode(',', $allowedScreens),
            'banner_image' => 'required|image|max:4096',
        ]);

        $storedPath = $request->file('banner_image')->store('banners', 'public');
        $imageUrl = Storage::url($storedPath);

        $existingBanner = DB::table('banners')->where('title', $validatedData['screen'])->first();

        if ($existingBanner) {
            if (!empty($existingBanner->image_url) && str_starts_with($existingBanner->image_url, '/storage/')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $existingBanner->image_url));
            }

            DB::table('banners')
                ->where('id', $existingBanner->id)
                ->update([
                    'image_url' => $imageUrl,
                    'is_active' => 1,
                    'updated_at' => now(),
                ]);

            $bannerId = $existingBanner->id;
        } else {
            $bannerId = DB::table('banners')->insertGetId([
                'title' => $validatedData['screen'],
                'description' => '',
                'image_url' => $imageUrl,
                'is_active' => 1,
                'display_order' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Upload banner thành công',
            'banner_id' => $bannerId,
            'image_url' => $imageUrl,
        ]);
    }

    public function delete_banner(Request $request)
    {
        if (!Schema::hasTable('banners')) {
            return response()->json(['message' => 'Bảng banners chưa được tạo'], 500);
        }

        $allowedScreens = array_map(static fn ($slot) => $slot['screen'], $this->getBannerSlots());

        $validatedData = $request->validate([
            'screen' => 'required|in:' . implode(',', $allowedScreens),
        ]);

        $banner = DB::table('banners')->where('title', $validatedData['screen'])->first();

        if ($banner && !empty($banner->image_url) && str_starts_with($banner->image_url, '/storage/')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $banner->image_url));
        }

        if ($banner) {
            DB::table('banners')->where('id', $banner->id)->update([
                'image_url' => null,
                'is_active' => 0,
                'updated_at' => now(),
            ]);
        }

        return response()->json([
            'message' => 'Xóa banner thành công',
        ]);
    }

    public function seo_index()
    {
        $pageKeys = ['home', 'pricing', 'sim', 'news', 'about', 'tracking', 'product-detail'];
        $seoPages = [];

        foreach ($pageKeys as $pageKey) {
            $seoPages[$pageKey] = [
                'page_key' => $pageKey,
                'product_id' => null,
                'title' => '',
                'meta_description' => '',
                'keywords' => '',
                'og_image' => '',
                'canonical_url' => '',
            ];
        }

        if (Schema::hasTable('seos')) {
            $seoRecords = Seo::query()->whereIn('page_key', $pageKeys)->get();

            foreach ($seoRecords as $seoRecord) {
                $decodedData = json_decode($seoRecord->data_seo ?? '{}', true);

                if (!is_array($decodedData)) {
                    $decodedData = [];
                }

                $seoPages[$seoRecord->page_key] = [
                    'page_key' => $seoRecord->page_key,
                    'product_id' => $seoRecord->product_id,
                    'title' => (string) ($decodedData['title'] ?? ''),
                    'meta_description' => (string) ($decodedData['meta_description'] ?? ''),
                    'keywords' => (string) ($decodedData['keywords'] ?? ''),
                    'og_image' => (string) ($decodedData['og_image'] ?? ''),
                    'canonical_url' => (string) ($decodedData['canonical_url'] ?? ''),
                ];
            }
        }

        return view('/admin/seo_index', compact('seoPages'));
    }

    public function save_seo(Request $request)
    {
        if (!Schema::hasTable('seos')) {
            return response()->json([
                'message' => 'Bảng seos chưa được tạo'
            ], 500);
        }

        $pageKeys = ['home', 'pricing', 'sim', 'news', 'about', 'tracking', 'product-detail'];

        $validatedData = $request->validate([
            'page_key' => 'required|in:' . implode(',', $pageKeys),
            'product_id' => 'nullable|integer|min:1',
            'title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'keywords' => 'nullable|string|max:500',
            'og_image' => 'nullable|string|max:500',
            'canonical_url' => 'nullable|string|max:500',
        ]);

        $pageKey = $validatedData['page_key'];
        $productId = $pageKey === 'product-detail' ? ($validatedData['product_id'] ?? null) : null;

        $dataSeo = [
            'title' => $validatedData['title'] ?? '',
            'meta_description' => $validatedData['meta_description'] ?? '',
            'keywords' => $validatedData['keywords'] ?? '',
            'og_image' => $validatedData['og_image'] ?? '',
            'canonical_url' => $validatedData['canonical_url'] ?? '',
        ];

        Seo::updateOrCreate(
            ['page_key' => $pageKey],
            [
                'product_id' => $productId,
                'data_seo' => json_encode($dataSeo, JSON_UNESCAPED_UNICODE),
            ]
        );

        return response()->json([
            'message' => 'Lưu SEO thành công',
            'page_key' => $pageKey,
        ]);
    }

    public function order_index()
    {
        $orders = collect();
        $statusLabels = [
            1 => '1 - Chờ xử lý',
            2 => '2 - Đang xử lý',
            3 => '3 - Đã xử lý',
            4 => '4 - Hoàn thành',
        ];

        $statusClasses = [
            1 => 'bg-slate-100 text-slate-700',
            2 => 'bg-amber-100 text-amber-700',
            3 => 'bg-indigo-100 text-indigo-700',
            4 => 'bg-emerald-100 text-emerald-700',
        ];

        if (Schema::hasTable('orders')) {
            $query = DB::table('orders')->select('orders.*');

            if (Schema::hasTable('products')) {
                $query->leftJoin('products', 'products.id', '=', 'orders.product_id')
                    ->addSelect('products.name as product_name');
            }

            $orders = $query->orderByDesc('orders.id')->get();
        }

        return view('/admin/order/index', compact('orders', 'statusLabels', 'statusClasses'));
    }

    public function news_index()
    {
        $newsItems = collect();

        if (Schema::hasTable('news')) {
            $newsItems = DB::table('news')
                ->orderByDesc('id')
                ->get();
        }

        return view('/admin/news/index', compact('newsItems'));
    }

    public function news_editor()
    {
        return view('/admin/news/editor');
    }

    public function news_show($id)
    {
        if (!Schema::hasTable('news')) {
            return response()->json(['message' => 'Bảng news chưa được tạo'], 500);
        }

        $news = DB::table('news')->where('id', $id)->first();

        if (!$news) {
            return response()->json(['message' => 'Không tìm thấy bài viết'], 404);
        }

        return response()->json([
            'id' => (int) $news->id,
            'title' => (string) $news->title,
            'slug' => (string) $news->slug,
            'content' => (string) $news->content,
            'featured_image' => (string) ($news->featured_image ?? ''),
            'excerpt' => (string) ($news->excerpt ?? ''),
            'is_published' => (int) $news->is_published,
            'published_at' => $news->published_at ? date('Y-m-d\TH:i', strtotime((string) $news->published_at)) : '',
            'created_at' => $news->created_at,
            'updated_at' => $news->updated_at,
        ]);
    }

    public function store_news(Request $request)
    {
        if (!Schema::hasTable('news')) {
            return response()->json(['message' => 'Bảng news chưa được tạo'], 500);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:news,slug',
            'content' => 'required|string',
            'featured_image' => 'nullable|string|max:500',
            'excerpt' => 'nullable|string|max:1000',
            'is_published' => 'required|integer|in:0,1',
            'published_at' => 'nullable|date',
        ]);

        $slug = $this->generateUniqueNewsSlug(
            $validatedData['slug'] ?? null,
            $validatedData['title'],
            null
        );

        $publishedAt = $validatedData['published_at'] ?? null;
        if ((int) $validatedData['is_published'] === 1 && empty($publishedAt)) {
            $publishedAt = now();
        }

        $newsId = DB::table('news')->insertGetId([
            'title' => $validatedData['title'],
            'slug' => $slug,
            'content' => $validatedData['content'],
            'featured_image' => $validatedData['featured_image'] ?? null,
            'excerpt' => $validatedData['excerpt'] ?? null,
            'is_published' => (int) $validatedData['is_published'],
            'published_at' => $publishedAt,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Tạo bài viết thành công',
            'news_id' => $newsId,
        ]);
    }

    public function update_news(Request $request, $id)
    {
        if (!Schema::hasTable('news')) {
            return response()->json(['message' => 'Bảng news chưa được tạo'], 500);
        }

        $news = DB::table('news')->where('id', $id)->first();
        if (!$news) {
            return response()->json(['message' => 'Không tìm thấy bài viết'], 404);
        }

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'nullable|string|max:500',
            'excerpt' => 'nullable|string|max:1000',
            'is_published' => 'required|integer|in:0,1',
            'published_at' => 'nullable|date',
        ]);

        $slug = $this->generateUniqueNewsSlug(
            $validatedData['slug'] ?? null,
            $validatedData['title'],
            (int) $id
        );

        $publishedAt = $validatedData['published_at'] ?? null;
        if ((int) $validatedData['is_published'] === 1 && empty($publishedAt)) {
            $publishedAt = $news->published_at ?: now();
        }

        DB::table('news')->where('id', $id)->update([
            'title' => $validatedData['title'],
            'slug' => $slug,
            'content' => $validatedData['content'],
            'featured_image' => $validatedData['featured_image'] ?? null,
            'excerpt' => $validatedData['excerpt'] ?? null,
            'is_published' => (int) $validatedData['is_published'],
            'published_at' => $publishedAt,
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Cập nhật bài viết thành công',
        ]);
    }

    private function generateUniqueNewsSlug(?string $incomingSlug, string $title, ?int $ignoreId): string
    {
        $baseSlug = Str::slug(trim((string) ($incomingSlug ?: $title)));
        if ($baseSlug === '') {
            $baseSlug = 'news-' . now()->timestamp;
        }

        $slug = $baseSlug;
        $suffix = 1;

        while (true) {
            $query = DB::table('news')->where('slug', $slug);
            if ($ignoreId !== null) {
                $query->where('id', '!=', $ignoreId);
            }

            if (!$query->exists()) {
                return $slug;
            }

            $suffix++;
            $slug = $baseSlug . '-' . $suffix;
        }
    }
}