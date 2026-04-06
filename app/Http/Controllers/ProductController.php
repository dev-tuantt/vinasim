<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;

class ProductController extends Controller
{
    private function defaultCategories(): array
    {
        return [
            ['id' => 1, 'name' => 'Gói cước 4G/5G'],
            ['id' => 2, 'name' => 'Sim số đẹp'],
        ];
    }

    public function index()
    {
        $categories = $this->defaultCategories();

        if (Schema::hasTable('categories')) {
            $categoriesFromDb = DB::table('categories')
                ->whereIn('id', [1, 2])
                ->orderBy('id')
                ->get(['id', 'name'])
                ->map(fn ($category) => ['id' => (int) $category->id, 'name' => (string) $category->name])
                ->values()
                ->all();

            if (!empty($categoriesFromDb)) {
                $categories = $categoriesFromDb;
            }
        }

        $products = collect();

        if (Schema::hasTable('products')) {
            $productsQuery = DB::table('products')->select('products.*');

            if (Schema::hasColumn('products', 'deleted_at')) {
                $productsQuery->whereNull('products.deleted_at');
            }

            $products = $productsQuery->orderByDesc('products.id')->get();
        }

        $packageProducts = [];
        $simProducts = [];

        foreach ($products as $product) {
            $specifications = json_decode($product->specifications ?? '{}', true);
            if (!is_array($specifications)) {
                $specifications = [];
            }

            $normalizedProduct = [
                'id' => (int) $product->id,
                'name' => (string) $product->name,
                'description' => (string) ($product->description ?? ''),
                'category_id' => (int) $product->category_id,
                'price' => (float) $product->price,
                'image_url' => (string) ($product->image_url ?? ''),
                'is_active' => (int) $product->is_active,
                'specifications' => $specifications,
            ];

            if ((int) $product->category_id === 1) {
                $packageProducts[] = $normalizedProduct;
            }

            if ((int) $product->category_id === 2) {
                $simProducts[] = $normalizedProduct;
            }
        }

        return view('/admin/product/index', compact('categories', 'packageProducts', 'simProducts'));
    }

    public function store(Request $request)
    {
        if (!Schema::hasTable('products')) {
            return response()->json(['message' => 'Bảng products chưa được tạo'], 500);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => ['required', 'integer', Rule::in([1, 2])],
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|max:500',
            'is_active' => 'required|integer|in:0,1',
            'data' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:255',
            'carrier' => 'nullable|string|max:255',
        ]);

        $specifications = [];
        if ((int) $validatedData['category_id'] === 1) {
            $specifications['data'] = $validatedData['data'] ?? '';
            $specifications['duration'] = $validatedData['duration'] ?? '';
        }

        if ((int) $validatedData['category_id'] === 2) {
            $specifications['number'] = $validatedData['number'] ?? '';
            $specifications['carrier'] = $validatedData['carrier'] ?? '';
        }

        $productId = DB::table('products')->insertGetId([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? '',
            'category_id' => (int) $validatedData['category_id'],
            'price' => $validatedData['price'],
            'image_url' => $validatedData['image_url'] ?? null,
            'specifications' => json_encode($specifications, JSON_UNESCAPED_UNICODE),
            'is_active' => (int) $validatedData['is_active'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Tạo sản phẩm thành công',
            'product_id' => $productId,
        ]);
    }

    public function update(Request $request, $id)
    {
        if (!Schema::hasTable('products')) {
            return response()->json(['message' => 'Bảng products chưa được tạo'], 500);
        }

        $product = DB::table('products')->where('id', $id)->first();
        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => ['required', 'integer', Rule::in([1, 2])],
            'price' => 'required|numeric|min:0',
            'image_url' => 'nullable|string|max:500',
            'is_active' => 'required|integer|in:0,1',
            'data' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'number' => 'nullable|string|max:255',
            'carrier' => 'nullable|string|max:255',
        ]);

        $specifications = [];
        if ((int) $validatedData['category_id'] === 1) {
            $specifications['data'] = $validatedData['data'] ?? '';
            $specifications['duration'] = $validatedData['duration'] ?? '';
        }

        if ((int) $validatedData['category_id'] === 2) {
            $specifications['number'] = $validatedData['number'] ?? '';
            $specifications['carrier'] = $validatedData['carrier'] ?? '';
        }

        DB::table('products')->where('id', $id)->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? '',
            'category_id' => (int) $validatedData['category_id'],
            'price' => $validatedData['price'],
            'image_url' => $validatedData['image_url'] ?? null,
            'specifications' => json_encode($specifications, JSON_UNESCAPED_UNICODE),
            'is_active' => (int) $validatedData['is_active'],
            'updated_at' => now(),
        ]);

        return response()->json([
            'message' => 'Cập nhật sản phẩm thành công',
        ]);
    }

    public function destroy($id)
    {
        if (!Schema::hasTable('products')) {
            return response()->json(['message' => 'Bảng products chưa được tạo'], 500);
        }

        $productQuery = DB::table('products')->where('id', $id);
        $product = $productQuery->first();

        if (!$product) {
            return response()->json(['message' => 'Không tìm thấy sản phẩm'], 404);
        }

        if (Schema::hasColumn('products', 'deleted_at')) {
            $productQuery->update([
                'deleted_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            $productQuery->delete();
        }

        return response()->json([
            'message' => 'Xóa sản phẩm thành công',
        ]);
    }

    public function import(Request $request)
    {
        if (!Schema::hasTable('products')) {
            return response()->json(['message' => 'Bảng products chưa được tạo'], 500);
        }

        $validatedData = $request->validate([
            'file' => 'required|file|mimes:csv,txt,xls,xlsx',
        ]);

        $sheets = Excel::toArray([], $validatedData['file']);
        $rows = $sheets[0] ?? [];

        if (count($rows) < 2) {
            return response()->json([
                'message' => 'File import không có dữ liệu hợp lệ',
            ], 422);
        }

        $headers = array_map(fn ($header) => $this->normalizeImportHeader($header), $rows[0]);

        $importedCount = 0;
        $skippedCount = 0;
        $errors = [];

        DB::beginTransaction();

        try {
            foreach (array_slice($rows, 1) as $index => $row) {
                $lineNumber = $index + 2;
                $mappedRow = [];

                foreach ($headers as $columnIndex => $header) {
                    if ($header === '') {
                        continue;
                    }

                    $mappedRow[$header] = $this->normalizeImportValue($row[$columnIndex] ?? null);
                }

                if (empty(array_filter($mappedRow, fn ($value) => $value !== ''))) {
                    continue;
                }

                $categoryId = $this->resolveImportedCategory($mappedRow);
                if (!in_array($categoryId, [1, 2], true)) {
                    $skippedCount++;
                    $errors[] = "Dòng {$lineNumber}: Không xác định được category (1: gói cước, 2: sim số đẹp).";
                    continue;
                }

                $name = trim((string) ($mappedRow['name'] ?? ''));
                if ($name === '') {
                    $skippedCount++;
                    $errors[] = "Dòng {$lineNumber}: Thiếu cột name.";
                    continue;
                }

                $price = $this->parseImportedPrice($mappedRow['price'] ?? null);
                if ($price === null || $price < 0) {
                    $skippedCount++;
                    $errors[] = "Dòng {$lineNumber}: Giá không hợp lệ.";
                    continue;
                }

                $description = (string) ($mappedRow['description'] ?? '');
                $imageUrl = (string) ($mappedRow['image_url'] ?? '');
                $isActive = $this->resolveImportedStatus($mappedRow['is_active'] ?? ($mappedRow['status'] ?? null));

                $specifications = [];
                if ($categoryId === 1) {
                    $specifications['data'] = (string) ($mappedRow['data'] ?? '');
                    $specifications['duration'] = (string) ($mappedRow['duration'] ?? '');
                }

                if ($categoryId === 2) {
                    $specifications['number'] = (string) ($mappedRow['number'] ?? ($mappedRow['sim_number'] ?? ''));
                    $specifications['carrier'] = (string) ($mappedRow['carrier'] ?? '');
                }

                DB::table('products')->insert([
                    'name' => $name,
                    'description' => $description,
                    'category_id' => $categoryId,
                    'price' => $price,
                    'image_url' => $imageUrl !== '' ? $imageUrl : null,
                    'specifications' => json_encode($specifications, JSON_UNESCAPED_UNICODE),
                    'is_active' => $isActive,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $importedCount++;
            }

            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();

            return response()->json([
                'message' => 'Import thất bại: ' . $exception->getMessage(),
            ], 500);
        }

        return response()->json([
            'message' => "Import thành công {$importedCount} dòng, bỏ qua {$skippedCount} dòng.",
            'imported' => $importedCount,
            'skipped' => $skippedCount,
            'errors' => array_slice($errors, 0, 20),
        ]);
    }

    private function normalizeImportHeader(mixed $header): string
    {
        return (string) Str::of((string) $header)
            ->ascii()
            ->lower()
            ->replace(['-', ' '], '_')
            ->replace('__', '_')
            ->trim('_');
    }

    private function normalizeImportValue(mixed $value): string
    {
        return trim((string) ($value ?? ''));
    }

    private function resolveImportedCategory(array $mappedRow): ?int
    {
        $rawCategory = $mappedRow['category_id']
            ?? $mappedRow['category']
            ?? $mappedRow['type']
            ?? null;

        if ($rawCategory === null || $rawCategory === '') {
            return null;
        }

        if (is_numeric($rawCategory)) {
            $asInt = (int) $rawCategory;
            if (in_array($asInt, [1, 2], true)) {
                return $asInt;
            }
        }

        $normalized = Str::of((string) $rawCategory)->ascii()->lower()->value();
        if (str_contains($normalized, 'sim')) {
            return 2;
        }

        if (
            str_contains($normalized, 'goi') ||
            str_contains($normalized, 'package') ||
            str_contains($normalized, '4g') ||
            str_contains($normalized, '5g')
        ) {
            return 1;
        }

        return null;
    }

    private function resolveImportedStatus(mixed $rawStatus): int
    {
        if ($rawStatus === null || $rawStatus === '') {
            return 1;
        }

        if (is_numeric($rawStatus)) {
            return (int) $rawStatus === 0 ? 0 : 1;
        }

        $normalized = Str::of((string) $rawStatus)->ascii()->lower()->value();
        $inactiveValues = ['0', 'an', 'hide', 'hidden', 'inactive', 'off'];

        return in_array($normalized, $inactiveValues, true) ? 0 : 1;
    }

    private function parseImportedPrice(mixed $rawPrice): ?float
    {
        if ($rawPrice === null || $rawPrice === '') {
            return null;
        }

        $price = preg_replace('/[^0-9,\.\-]/', '', (string) $rawPrice);
        if ($price === null || $price === '') {
            return null;
        }

        if (str_contains($price, '.') && str_contains($price, ',')) {
            $price = str_replace('.', '', $price);
            $price = str_replace(',', '.', $price);
        } elseif (substr_count($price, '.') > 1) {
            $price = str_replace('.', '', $price);
        } elseif (substr_count($price, ',') > 1) {
            $price = str_replace(',', '', $price);
        } elseif (str_contains($price, ',')) {
            $price = str_replace(',', '.', $price);
        }

        return is_numeric($price) ? (float) $price : null;
    }
}