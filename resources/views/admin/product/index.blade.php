@extends('admin_layout')

@section('css')
<style>
        .sidebar-link { color: rgb(71 85 105); }
        .sidebar-link.active { background-color: rgb(79 70 229); color: #fff; box-shadow: 0 1px 2px rgba(15, 23, 42, 0.15); }
        .sidebar-link:not(.active):hover { background-color: rgb(238 242 255); color: rgb(67 56 202); }
        .product-tab.active {
            background-color: rgb(79 70 229);
            color: #fff;
        }
    </style>
@endsection

@section('content')
@php
    $packageCategory = collect($categories)->firstWhere('id', 1);
    $simCategory = collect($categories)->firstWhere('id', 2);
@endphp

<section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm flex items-center justify-between">
                    <div><h2 class="text-base font-semibold text-slate-900">Gói cước 4G/5G & Sim số đẹp</h2><p class="mt-1 text-sm text-slate-500">CRUD sản phẩm hiển thị ở giao diện khách hàng.</p></div>
                    <div class="flex items-center gap-2">
                        <button id="openImportProductModalBtn" type="button" class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-2 text-sm font-medium text-emerald-700 hover:bg-emerald-100">Import file</button>
                        <button id="openCreatePackageModalBtn" type="button" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Tạo gói cước</button>
                        <button id="openCreateSimModalBtn" type="button" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Tạo sim số đẹp</button>
                    </div>
                </section>
                <section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
                    <div class="mb-4 flex items-center gap-2 text-sm">
                        <button type="button" data-tab="package" class="product-tab active rounded-lg border border-slate-200 px-3 py-1.5 font-medium transition">Gói cước 4G/5G</button>
                        <button type="button" data-tab="sim" class="product-tab rounded-lg border border-slate-200 px-3 py-1.5 font-medium text-slate-700 transition hover:bg-slate-50">Sim số đẹp</button>
                    </div>

                    <div id="packageTableWrap" class="overflow-x-auto rounded-xl border border-slate-100">
                        <table class="min-w-full text-left text-sm">
                            <thead class="bg-slate-50 text-slate-600">
                                <tr>
                                    <th class="px-4 py-3">Tên gói</th>
                                    <th class="px-4 py-3">Giá</th>
                                    <th class="px-4 py-3">Dung lượng</th>
                                    <th class="px-4 py-3">Thời hạn</th>
                                    <th class="px-4 py-3">Trạng thái</th>
                                    <th class="px-4 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @forelse ($packageProducts as $product)
                                    @php
                                        $spec = $product['specifications'] ?? [];
                                        $statusText = (int) $product['is_active'] === 1 ? 'Hiển thị' : 'Ẩn';
                                        $statusClass = (int) $product['is_active'] === 1
                                            ? 'bg-emerald-100 text-emerald-700'
                                            : 'bg-slate-100 text-slate-700';
                                    @endphp
                                    <tr
                                        data-product-id="{{ $product['id'] }}"
                                        data-type="package"
                                        data-name="{{ $product['name'] }}"
                                        data-description="{{ $product['description'] }}"
                                        data-category-id="{{ $product['category_id'] }}"
                                        data-price="{{ $product['price'] }}"
                                        data-image-url="{{ $product['image_url'] }}"
                                        data-data="{{ $spec['data'] ?? '' }}"
                                        data-duration="{{ $spec['duration'] ?? '' }}"
                                        data-status="{{ $product['is_active'] }}"
                                    >
                                        <td class="px-4 py-3">{{ $product['name'] }}</td>
                                        <td class="px-4 py-3">{{ number_format((float) $product['price'], 0, ',', '.') }}đ</td>
                                        <td class="px-4 py-3">{{ $spec['data'] ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $spec['duration'] ?? '' }}</td>
                                        <td class="px-4 py-3"><span class="rounded-full px-2 py-1 text-xs font-medium {{ $statusClass }}">{{ $statusText }}</span></td>
                                        <td class="px-4 py-3">
                                            <select class="product-action-select rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm text-slate-700 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                                                <option value="">Chọn thao tác</option>
                                                <option value="update">Cập nhật</option>
                                                <option value="delete">Xóa</option>
                                            </select>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-6 text-center text-sm text-slate-500">Chưa có gói cước nào</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div id="simTableWrap" class="hidden overflow-x-auto rounded-xl border border-slate-100">
                        <table class="min-w-full text-left text-sm">
                            <thead class="bg-slate-50 text-slate-600">
                                <tr>
                                    <th class="px-4 py-3">Số sim</th>
                                    <th class="px-4 py-3">Tên hiển thị</th>
                                    <th class="px-4 py-3">Nhà mạng</th>
                                    <th class="px-4 py-3">Giá</th>
                                    <th class="px-4 py-3">Trạng thái</th>
                                    <th class="px-4 py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 bg-white">
                                @forelse ($simProducts as $product)
                                    @php
                                        $spec = $product['specifications'] ?? [];
                                        $statusText = (int) $product['is_active'] === 1 ? 'Hiển thị' : 'Ẩn';
                                        $statusClass = (int) $product['is_active'] === 1
                                            ? 'bg-emerald-100 text-emerald-700'
                                            : 'bg-slate-100 text-slate-700';
                                    @endphp
                                    <tr
                                        data-product-id="{{ $product['id'] }}"
                                        data-type="sim"
                                        data-name="{{ $product['name'] }}"
                                        data-description="{{ $product['description'] }}"
                                        data-category-id="{{ $product['category_id'] }}"
                                        data-price="{{ $product['price'] }}"
                                        data-image-url="{{ $product['image_url'] }}"
                                        data-number="{{ $spec['number'] ?? '' }}"
                                        data-carrier="{{ $spec['carrier'] ?? '' }}"
                                        data-status="{{ $product['is_active'] }}"
                                    >
                                        <td class="px-4 py-3">{{ $spec['number'] ?? '' }}</td>
                                        <td class="px-4 py-3">{{ $product['name'] }}</td>
                                        <td class="px-4 py-3">{{ $spec['carrier'] ?? '' }}</td>
                                        <td class="px-4 py-3">{{ number_format((float) $product['price'], 0, ',', '.') }}đ</td>
                                        <td class="px-4 py-3"><span class="rounded-full px-2 py-1 text-xs font-medium {{ $statusClass }}">{{ $statusText }}</span></td>
                                        <td class="px-4 py-3">
                                            <select class="product-action-select rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm text-slate-700 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
                                                <option value="">Chọn thao tác</option>
                                                <option value="update">Cập nhật</option>
                                                <option value="delete">Xóa</option>
                                            </select>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-6 text-center text-sm text-slate-500">Chưa có sim số đẹp nào</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </section>
<div id="importProductModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
        <div class="w-full max-w-xl rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Import sản phẩm từ file</h3>
                <button type="button" data-close-modal="importProductModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700">✕</button>
            </div>
            <form id="importProductForm" class="space-y-4">
                <div>
                    <label for="importProductFile" class="mb-1 block text-sm font-medium text-slate-700">File dữ liệu (.csv, .xls, .xlsx)</label>
                    <input id="importProductFile" name="file" type="file" accept=".csv,.xls,.xlsx" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" />
                </div>
                <div class="rounded-xl bg-slate-50 p-3 text-xs text-slate-600">
                    Cột khuyến nghị: name, description, category_id/category/type, price, image_url, is_active/status.
                    <br>
                    Với gói cước: thêm data, duration. Với sim số đẹp: thêm number, carrier.
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" data-close-modal="importProductModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Cancel</button>
                    <button type="submit" class="rounded-xl bg-emerald-600 px-4 py-2 text-sm font-medium text-white">Xác nhận import</button>
                </div>
            </form>
        </div>
    </div>

<div id="createPackageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
        <div class="w-full max-w-2xl rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Tạo gói cước 4G/5G</h3>
                <button type="button" data-close-modal="createPackageModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700">✕</button>
            </div>

            <form id="createPackageForm" class="grid gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="packageName" class="mb-1 block text-sm font-medium text-slate-700">Tên sản phẩm (name)</label>
                    <input id="packageName" name="name" type="text" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="VD: MAX 90" />
                </div>
                <div class="sm:col-span-2">
                    <label for="packageDescription" class="mb-1 block text-sm font-medium text-slate-700">Mô tả (description)</label>
                    <textarea id="packageDescription" name="description" rows="3" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="Mô tả chi tiết gói cước"></textarea>
                </div>
                <div>
                    <label for="packageCategory" class="mb-1 block text-sm font-medium text-slate-700">Danh mục (category_id)</label>
                    <select id="packageCategory" name="category_id" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm">
                        <option value="1" selected>{{ $packageCategory['id'] ?? 1 }} - {{ $packageCategory['name'] ?? 'Gói cước 4G/5G' }}</option>
                    </select>
                </div>
                <div>
                    <label for="packagePrice" class="mb-1 block text-sm font-medium text-slate-700">Giá (price)</label>
                    <input id="packagePrice" name="price" type="number" min="0" step="0.01" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="90000" />
                </div>
                <div class="sm:col-span-2">
                    <label for="packageImage" class="mb-1 block text-sm font-medium text-slate-700">Ảnh (image_url)</label>
                    <input id="packageImage" name="image_url" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="https://..." />
                </div>
                <div>
                    <label for="packageData" class="mb-1 block text-sm font-medium text-slate-700">Dung lượng (specifications)</label>
                    <input id="packageData" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="VD: 30GB" />
                </div>
                <div>
                    <label for="packageDuration" class="mb-1 block text-sm font-medium text-slate-700">Thời hạn (specifications)</label>
                    <input id="packageDuration" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="VD: 30 ngày" />
                </div>
                <div class="sm:col-span-2">
                    <label for="packageStatus" class="mb-1 block text-sm font-medium text-slate-700">Trạng thái (is_active)</label>
                    <select id="packageStatus" name="is_active" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm">
                        <option value="1" selected>Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <div class="sm:col-span-2 flex justify-end gap-2">
                    <button type="button" data-close-modal="createPackageModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Cancel</button>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Xác nhận tạo gói cước</button>
                </div>
            </form>
        </div>
    </div>

    <div id="createSimModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
        <div class="w-full max-w-2xl rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Tạo sim số đẹp</h3>
                <button type="button" data-close-modal="createSimModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700">✕</button>
            </div>

            <form id="createSimForm" class="grid gap-4 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <label for="simName" class="mb-1 block text-sm font-medium text-slate-700">Tên sản phẩm (name)</label>
                    <input id="simName" name="name" type="text" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="VD: Sim số 09xx" />
                </div>
                <div class="sm:col-span-2">
                    <label for="simDescription" class="mb-1 block text-sm font-medium text-slate-700">Mô tả (description)</label>
                    <textarea id="simDescription" name="description" rows="3" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="Mô tả sim số đẹp"></textarea>
                </div>
                <div>
                    <label for="simCategory" class="mb-1 block text-sm font-medium text-slate-700">Danh mục (category_id)</label>
                    <select id="simCategory" name="category_id" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm">
                        <option value="2" selected>{{ $simCategory['id'] ?? 2 }} - {{ $simCategory['name'] ?? 'Sim số đẹp' }}</option>
                    </select>
                </div>
                <div>
                    <label for="simPrice" class="mb-1 block text-sm font-medium text-slate-700">Giá (price)</label>
                    <input id="simPrice" name="price" type="number" min="0" step="0.01" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="250000" />
                </div>
                <div class="sm:col-span-2">
                    <label for="simImage" class="mb-1 block text-sm font-medium text-slate-700">Ảnh (image_url)</label>
                    <input id="simImage" name="image_url" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="https://..." />
                </div>
                <div>
                    <label for="simNumber" class="mb-1 block text-sm font-medium text-slate-700">Số sim (specifications)</label>
                    <input id="simNumber" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="VD: 0912345678" />
                </div>
                <div>
                    <label for="simCarrier" class="mb-1 block text-sm font-medium text-slate-700">Nhà mạng (specifications)</label>
                    <input id="simCarrier" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" placeholder="VD: Viettel" />
                </div>
                <div class="sm:col-span-2">
                    <label for="simStatus" class="mb-1 block text-sm font-medium text-slate-700">Trạng thái (is_active)</label>
                    <select id="simStatus" name="is_active" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm">
                        <option value="1" selected>Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <div class="sm:col-span-2 flex justify-end gap-2">
                    <button type="button" data-close-modal="createSimModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Cancel</button>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Xác nhận tạo sim</button>
                </div>
            </form>
        </div>
    </div>

    <div id="updatePackageModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
        <div class="w-full max-w-2xl rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Cập nhật gói cước 4G/5G</h3>
                <button type="button" data-close-modal="updatePackageModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700">✕</button>
            </div>

            <form id="updatePackageForm" class="grid gap-4 sm:grid-cols-2">
                <input id="updatePackageId" type="hidden" />
                <div class="sm:col-span-2">
                    <label for="updatePackageName" class="mb-1 block text-sm font-medium text-slate-700">Tên sản phẩm (name)</label>
                    <input id="updatePackageName" name="name" type="text" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" />
                </div>
                <div class="sm:col-span-2">
                    <label for="updatePackageDescription" class="mb-1 block text-sm font-medium text-slate-700">Mô tả (description)</label>
                    <textarea id="updatePackageDescription" name="description" rows="3" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm"></textarea>
                </div>
                <div>
                    <label for="updatePackageCategory" class="mb-1 block text-sm font-medium text-slate-700">Danh mục (category_id)</label>
                    <select id="updatePackageCategory" name="category_id" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm">
                        <option value="1">{{ $packageCategory['id'] ?? 1 }} - {{ $packageCategory['name'] ?? 'Gói cước 4G/5G' }}</option>
                    </select>
                </div>
                <div>
                    <label for="updatePackagePrice" class="mb-1 block text-sm font-medium text-slate-700">Giá (price)</label>
                    <input id="updatePackagePrice" name="price" type="number" min="0" step="0.01" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" />
                </div>
                <div class="sm:col-span-2">
                    <label for="updatePackageImage" class="mb-1 block text-sm font-medium text-slate-700">Ảnh (image_url)</label>
                    <input id="updatePackageImage" name="image_url" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" />
                </div>
                <div>
                    <label for="updatePackageData" class="mb-1 block text-sm font-medium text-slate-700">Dung lượng (specifications)</label>
                    <input id="updatePackageData" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" />
                </div>
                <div>
                    <label for="updatePackageDuration" class="mb-1 block text-sm font-medium text-slate-700">Thời hạn (specifications)</label>
                    <input id="updatePackageDuration" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" />
                </div>
                <div class="sm:col-span-2">
                    <label for="updatePackageStatus" class="mb-1 block text-sm font-medium text-slate-700">Trạng thái (is_active)</label>
                    <select id="updatePackageStatus" name="is_active" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <div class="sm:col-span-2 flex justify-end gap-2">
                    <button type="button" data-close-modal="updatePackageModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Cancel</button>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Xác nhận cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    <div id="updateSimModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
        <div class="w-full max-w-2xl rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
            <div class="mb-4 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Cập nhật sim số đẹp</h3>
                <button type="button" data-close-modal="updateSimModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700">✕</button>
            </div>

            <form id="updateSimForm" class="grid gap-4 sm:grid-cols-2">
                <input id="updateSimId" type="hidden" />
                <div class="sm:col-span-2">
                    <label for="updateSimName" class="mb-1 block text-sm font-medium text-slate-700">Tên sản phẩm (name)</label>
                    <input id="updateSimName" name="name" type="text" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" />
                </div>
                <div class="sm:col-span-2">
                    <label for="updateSimDescription" class="mb-1 block text-sm font-medium text-slate-700">Mô tả (description)</label>
                    <textarea id="updateSimDescription" name="description" rows="3" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm"></textarea>
                </div>
                <div>
                    <label for="updateSimCategory" class="mb-1 block text-sm font-medium text-slate-700">Danh mục (category_id)</label>
                    <select id="updateSimCategory" name="category_id" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm">
                        <option value="2">{{ $simCategory['id'] ?? 2 }} - {{ $simCategory['name'] ?? 'Sim số đẹp' }}</option>
                    </select>
                </div>
                <div>
                    <label for="updateSimPrice" class="mb-1 block text-sm font-medium text-slate-700">Giá (price)</label>
                    <input id="updateSimPrice" name="price" type="number" min="0" step="0.01" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" />
                </div>
                <div class="sm:col-span-2">
                    <label for="updateSimImage" class="mb-1 block text-sm font-medium text-slate-700">Ảnh (image_url)</label>
                    <input id="updateSimImage" name="image_url" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" />
                </div>
                <div>
                    <label for="updateSimNumber" class="mb-1 block text-sm font-medium text-slate-700">Số sim (specifications)</label>
                    <input id="updateSimNumber" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" />
                </div>
                <div>
                    <label for="updateSimCarrier" class="mb-1 block text-sm font-medium text-slate-700">Nhà mạng (specifications)</label>
                    <input id="updateSimCarrier" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm" />
                </div>
                <div class="sm:col-span-2">
                    <label for="updateSimStatus" class="mb-1 block text-sm font-medium text-slate-700">Trạng thái (is_active)</label>
                    <select id="updateSimStatus" name="is_active" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm">
                        <option value="1">Hiển thị</option>
                        <option value="0">Ẩn</option>
                    </select>
                </div>
                <div class="sm:col-span-2 flex justify-end gap-2">
                    <button type="button" data-close-modal="updateSimModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Cancel</button>
                    <button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Xác nhận cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteProductModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
        <div class="w-full max-w-md rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
            <div class="mb-3 flex items-center justify-between">
                <h3 class="text-lg font-semibold text-slate-900">Xác nhận xóa sản phẩm</h3>
                <button type="button" data-close-modal="deleteProductModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700">✕</button>
            </div>
            <p class="text-sm text-slate-600">Bạn có chắc muốn xóa sản phẩm <span id="deleteProductName" class="font-semibold text-slate-900"></span> không?</p>
            <div class="mt-5 flex justify-end gap-2">
                <button type="button" data-close-modal="deleteProductModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Cancel</button>
                <button type="button" id="confirmDeleteProductBtn" class="rounded-xl bg-rose-600 px-4 py-2 text-sm font-medium text-white">Xác nhận xóa</button>
            </div>
        </div>
    </div>

@section('script')
<script>
        const storeProductUrl = '{{ route('admin.products.store') }}';
    const importProductUrl = '{{ route('admin.products.import') }}';
        const productBaseUrl = '{{ url('/admin/product') }}';
        const csrfToken = '{{ csrf_token() }}';

        // const sidebar = document.getElementById('sidebar');
        // const overlay = document.getElementById('overlay');
        // const menuButton = document.getElementById('menuButton');
        const createPackageModal = document.getElementById('createPackageModal');
        const createSimModal = document.getElementById('createSimModal');
        const importProductModal = document.getElementById('importProductModal');
        const openImportProductModalBtn = document.getElementById('openImportProductModalBtn');
        const openCreatePackageModalBtn = document.getElementById('openCreatePackageModalBtn');
        const openCreateSimModalBtn = document.getElementById('openCreateSimModalBtn');
        const importProductForm = document.getElementById('importProductForm');
        const createPackageForm = document.getElementById('createPackageForm');
        const createSimForm = document.getElementById('createSimForm');
        const updatePackageModal = document.getElementById('updatePackageModal');
        const updateSimModal = document.getElementById('updateSimModal');
        const deleteProductModal = document.getElementById('deleteProductModal');
        const updatePackageForm = document.getElementById('updatePackageForm');
        const updateSimForm = document.getElementById('updateSimForm');
        const deleteProductName = document.getElementById('deleteProductName');
        const confirmDeleteProductBtn = document.getElementById('confirmDeleteProductBtn');
        const productTabs = document.querySelectorAll('.product-tab');
        const packageTableWrap = document.getElementById('packageTableWrap');
        const simTableWrap = document.getElementById('simTableWrap');

        let currentDeleteProductId = '';

        // if (menuButton && sidebar && overlay) {
        //     menuButton.addEventListener('click', () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); });
        //     overlay.addEventListener('click', () => { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); });
        // }

        function openModal(modalElement) {
            if (!modalElement) {
                return;
            }

            modalElement.classList.remove('hidden');
            modalElement.classList.add('flex');
        }

        function closeModal(modalElement) {
            if (!modalElement) {
                return;
            }

            modalElement.classList.add('hidden');
            modalElement.classList.remove('flex');
        }

        function refreshAfterSuccess(message) {
            alert(message);
            window.location.reload();
        }

        async function requestJson(url, method, payload) {
            const response = await fetch(url, {
                method,
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                },
                body: JSON.stringify(payload),
            });

            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        }

        if (openCreatePackageModalBtn) {
            openCreatePackageModalBtn.addEventListener('click', () => {
                openModal(createPackageModal);
            });
        }

        if (openImportProductModalBtn) {
            openImportProductModalBtn.addEventListener('click', () => {
                openModal(importProductModal);
            });
        }

        if (openCreateSimModalBtn) {
            openCreateSimModalBtn.addEventListener('click', () => {
                openModal(createSimModal);
            });
        }

        document.querySelectorAll('.product-action-select').forEach((selectElement) => {
            selectElement.addEventListener('change', (event) => {
                const action = event.target.value;
                const currentRow = event.target.closest('tr');

                if (!action || !currentRow) {
                    return;
                }

                if (action === 'update') {
                    if (currentRow.dataset.type === 'package') {
                        document.getElementById('updatePackageId').value = currentRow.dataset.productId || '';
                        document.getElementById('updatePackageName').value = currentRow.dataset.name || '';
                        document.getElementById('updatePackageDescription').value = currentRow.dataset.description || '';
                        document.getElementById('updatePackageCategory').value = currentRow.dataset.categoryId || '1';
                        document.getElementById('updatePackagePrice').value = currentRow.dataset.price || '';
                        document.getElementById('updatePackageImage').value = currentRow.dataset.imageUrl || '';
                        document.getElementById('updatePackageData').value = currentRow.dataset.data || '';
                        document.getElementById('updatePackageDuration').value = currentRow.dataset.duration || '';
                        document.getElementById('updatePackageStatus').value = currentRow.dataset.status || '1';
                        openModal(updatePackageModal);
                    } else {
                        document.getElementById('updateSimId').value = currentRow.dataset.productId || '';
                        document.getElementById('updateSimName').value = currentRow.dataset.name || '';
                        document.getElementById('updateSimDescription').value = currentRow.dataset.description || '';
                        document.getElementById('updateSimCategory').value = currentRow.dataset.categoryId || '2';
                        document.getElementById('updateSimPrice').value = currentRow.dataset.price || '';
                        document.getElementById('updateSimImage').value = currentRow.dataset.imageUrl || '';
                        document.getElementById('updateSimNumber').value = currentRow.dataset.number || '';
                        document.getElementById('updateSimCarrier').value = currentRow.dataset.carrier || '';
                        document.getElementById('updateSimStatus').value = currentRow.dataset.status || '1';
                        openModal(updateSimModal);
                    }
                }

                if (action === 'delete') {
                    currentDeleteProductId = currentRow.dataset.productId || '';
                    deleteProductName.textContent = currentRow.dataset.name || '';
                    openModal(deleteProductModal);
                }

                event.target.value = '';
            });
        });

        productTabs.forEach((tabElement) => {
            tabElement.addEventListener('click', () => {
                productTabs.forEach((itemElement) => {
                    itemElement.classList.remove('active');
                    itemElement.classList.add('text-slate-700', 'hover:bg-slate-50');
                });

                tabElement.classList.add('active');
                tabElement.classList.remove('text-slate-700', 'hover:bg-slate-50');

                if (tabElement.dataset.tab === 'package') {
                    packageTableWrap.classList.remove('hidden');
                    simTableWrap.classList.add('hidden');
                } else {
                    simTableWrap.classList.remove('hidden');
                    packageTableWrap.classList.add('hidden');
                }
            });
        });

        document.querySelectorAll('[data-close-modal]').forEach((buttonElement) => {
            buttonElement.addEventListener('click', () => {
                const modalId = buttonElement.getAttribute('data-close-modal');
                const modalElement = document.getElementById(modalId);
                if (modalElement) {
                    closeModal(modalElement);
                }
            });
        });

        [importProductModal, createPackageModal, createSimModal, updatePackageModal, updateSimModal, deleteProductModal].forEach((modalElement) => {
            if (!modalElement) {
                return;
            }

            modalElement.addEventListener('click', (event) => {
                if (event.target === modalElement) {
                    closeModal(modalElement);
                }
            });
        });

        if (createPackageForm) {
            createPackageForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                const payload = {
                    name: document.getElementById('packageName').value.trim(),
                    description: document.getElementById('packageDescription').value.trim(),
                    category_id: Number(document.getElementById('packageCategory').value),
                    price: Number(document.getElementById('packagePrice').value),
                    image_url: document.getElementById('packageImage').value.trim(),
                    data: document.getElementById('packageData').value.trim(),
                    duration: document.getElementById('packageDuration').value.trim(),
                    is_active: Number(document.getElementById('packageStatus').value),
                };

                try {
                    const data = await requestJson(storeProductUrl, 'POST', payload);
                    closeModal(createPackageModal);
                    createPackageForm.reset();
                    refreshAfterSuccess(data.message || 'Tạo sản phẩm thành công');
                } catch (error) {
                    console.error(error);
                    alert(error.message || 'Không thể tạo sản phẩm');
                }
            });
        }

        if (importProductForm) {
            importProductForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                const importFileInput = document.getElementById('importProductFile');
                const importFile = importFileInput ? importFileInput.files[0] : null;

                if (!importFile) {
                    alert('Vui lòng chọn file import');
                    return;
                }

                const formData = new FormData();
                formData.append('file', importFile);

                try {
                    const response = await fetch(importProductUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formData,
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw data;
                    }

                    closeModal(importProductModal);
                    importProductForm.reset();

                    if (Array.isArray(data.errors) && data.errors.length > 0) {
                        alert((data.message || 'Import hoàn tất') + '\n\n' + data.errors.join('\n'));
                    } else {
                        alert(data.message || 'Import thành công');
                    }

                    window.location.reload();
                } catch (error) {
                    console.error(error);
                    alert(error.message || 'Không thể import dữ liệu');
                }
            });
        }

        if (createSimForm) {
            createSimForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                const payload = {
                    name: document.getElementById('simName').value.trim(),
                    description: document.getElementById('simDescription').value.trim(),
                    category_id: Number(document.getElementById('simCategory').value),
                    price: Number(document.getElementById('simPrice').value),
                    image_url: document.getElementById('simImage').value.trim(),
                    number: document.getElementById('simNumber').value.trim(),
                    carrier: document.getElementById('simCarrier').value.trim(),
                    is_active: Number(document.getElementById('simStatus').value),
                };

                try {
                    const data = await requestJson(storeProductUrl, 'POST', payload);
                    closeModal(createSimModal);
                    createSimForm.reset();
                    refreshAfterSuccess(data.message || 'Tạo sản phẩm thành công');
                } catch (error) {
                    console.error(error);
                    alert(error.message || 'Không thể tạo sản phẩm');
                }
            });
        }

        if (updatePackageForm) {
            updatePackageForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                const productId = document.getElementById('updatePackageId').value;
                if (!productId) {
                    alert('Không tìm thấy sản phẩm cần cập nhật');
                    return;
                }

                const payload = {
                    name: document.getElementById('updatePackageName').value.trim(),
                    description: document.getElementById('updatePackageDescription').value.trim(),
                    category_id: Number(document.getElementById('updatePackageCategory').value),
                    price: Number(document.getElementById('updatePackagePrice').value),
                    image_url: document.getElementById('updatePackageImage').value.trim(),
                    data: document.getElementById('updatePackageData').value.trim(),
                    duration: document.getElementById('updatePackageDuration').value.trim(),
                    is_active: Number(document.getElementById('updatePackageStatus').value),
                };

                try {
                    const data = await requestJson(`${productBaseUrl}/${productId}`, 'PUT', payload);
                    closeModal(updatePackageModal);
                    refreshAfterSuccess(data.message || 'Cập nhật sản phẩm thành công');
                } catch (error) {
                    console.error(error);
                    alert(error.message || 'Không thể cập nhật sản phẩm');
                }
            });
        }

        if (updateSimForm) {
            updateSimForm.addEventListener('submit', async (event) => {
                event.preventDefault();

                const productId = document.getElementById('updateSimId').value;
                if (!productId) {
                    alert('Không tìm thấy sản phẩm cần cập nhật');
                    return;
                }

                const payload = {
                    name: document.getElementById('updateSimName').value.trim(),
                    description: document.getElementById('updateSimDescription').value.trim(),
                    category_id: Number(document.getElementById('updateSimCategory').value),
                    price: Number(document.getElementById('updateSimPrice').value),
                    image_url: document.getElementById('updateSimImage').value.trim(),
                    number: document.getElementById('updateSimNumber').value.trim(),
                    carrier: document.getElementById('updateSimCarrier').value.trim(),
                    is_active: Number(document.getElementById('updateSimStatus').value),
                };

                try {
                    const data = await requestJson(`${productBaseUrl}/${productId}`, 'PUT', payload);
                    closeModal(updateSimModal);
                    refreshAfterSuccess(data.message || 'Cập nhật sản phẩm thành công');
                } catch (error) {
                    console.error(error);
                    alert(error.message || 'Không thể cập nhật sản phẩm');
                }
            });
        }

        if (confirmDeleteProductBtn) {
            confirmDeleteProductBtn.addEventListener('click', async () => {
                if (!currentDeleteProductId) {
                    alert('Không tìm thấy sản phẩm cần xóa');
                    return;
                }

                try {
                    const data = await requestJson(`${productBaseUrl}/${currentDeleteProductId}`, 'DELETE', {});
                    closeModal(deleteProductModal);
                    currentDeleteProductId = '';
                    deleteProductName.textContent = '';
                    refreshAfterSuccess(data.message || 'Xóa sản phẩm thành công');
                } catch (error) {
                    console.error(error);
                    alert(error.message || 'Không thể xóa sản phẩm');
                }
            });
        }
    </script>
@endsection
@endsection
