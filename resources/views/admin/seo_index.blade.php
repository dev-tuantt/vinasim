@extends('admin_layout')

@section('css')
<style>
		.sidebar-link { color: rgb(71 85 105); }
		.sidebar-link.active { background-color: rgb(79 70 229); color: #fff; box-shadow: 0 1px 2px rgba(15, 23, 42, 0.15); }
		.sidebar-link:not(.active):hover { background-color: rgb(238 242 255); color: rgb(67 56 202); }
		.seo-tab.active { background-color: rgb(79 70 229); border-color: rgb(79 70 229); color: #fff; }
	</style>
@endsection


@section('content')
<section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
					@php
						$tabLabels = [
							'home' => 'Home',
							'pricing' => 'Gói cước 4G/5G',
							'sim' => 'Sim số đẹp',
							'news' => 'Tin tức',
							'about' => 'Về chúng tôi',
							'tracking' => 'Tra cứu đơn hàng',
							'product-detail' => 'Chi tiết sản phẩm',
						];
					@endphp

					<div class="mb-4 flex flex-wrap items-center gap-2 text-sm">
						@foreach ($tabLabels as $tabKey => $tabLabel)
							<button
								type="button"
								data-tab="{{ $tabKey }}"
								class="seo-tab {{ $loop->first ? 'active' : 'text-slate-700 hover:bg-slate-50' }} rounded-lg border border-slate-200 px-3 py-1.5 font-medium transition"
							>
								{{ $tabLabel }}
							</button>
						@endforeach
					</div>

					@foreach ($tabLabels as $tabKey => $tabLabel)
						@php
							$seoData = $seoPages[$tabKey] ?? [];
						@endphp
						<div id="seo-tab-{{ $tabKey }}" data-page-key="{{ $tabKey }}" class="seo-panel {{ $loop->first ? '' : 'hidden' }} grid gap-4 md:grid-cols-2">
							<div class="rounded-xl border border-slate-100 p-4 {{ $tabKey === 'product-detail' ? '' : 'md:col-span-2' }}">
								<label class="mb-1 block text-sm font-medium text-slate-700">Page key</label>
								<input data-field="page_key" class="w-full rounded-lg border border-slate-200 bg-slate-50 px-3 py-2 text-sm" value="{{ $seoData['page_key'] ?? $tabKey }}" readonly />
							</div>

							@if ($tabKey === 'product-detail')
								<div class="rounded-xl border border-slate-100 p-4">
									<label class="mb-1 block text-sm font-medium text-slate-700">Product ID (product_id)</label>
									<input data-field="product_id" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" value="{{ $seoData['product_id'] ?? '' }}" />
								</div>
							@endif

							<div class="rounded-xl border border-slate-100 p-4">
								<label class="mb-1 block text-sm font-medium text-slate-700">SEO title</label>
								<input data-field="title" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" value="{{ $seoData['title'] ?? '' }}" />
							</div>

							<div class="rounded-xl border border-slate-100 p-4">
								<label class="mb-1 block text-sm font-medium text-slate-700">Meta description</label>
								<input data-field="meta_description" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" value="{{ $seoData['meta_description'] ?? '' }}" />
							</div>

							<div class="rounded-xl border border-slate-100 p-4">
								<label class="mb-1 block text-sm font-medium text-slate-700">Keywords</label>
								<input data-field="keywords" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" value="{{ $seoData['keywords'] ?? '' }}" />
							</div>

							<div class="rounded-xl border border-slate-100 p-4">
								<label class="mb-1 block text-sm font-medium text-slate-700">OG image</label>
								<input data-field="og_image" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" value="{{ $seoData['og_image'] ?? '' }}" />
							</div>

							<div class="rounded-xl border border-slate-100 p-4 md:col-span-2">
								<label class="mb-1 block text-sm font-medium text-slate-700">Canonical URL</label>
								<input data-field="canonical_url" class="w-full rounded-lg border border-slate-200 px-3 py-2 text-sm" value="{{ $seoData['canonical_url'] ?? '' }}" />
							</div>
						</div>
					@endforeach

					<div class="mt-4 text-right"><button id="saveSeoBtn" type="button" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Lưu SEO</button></div>
				</section>
                @section('script')
                <script>
		const seoSaveUrl = '{{ route('admin.seo.save') }}';
		const csrfToken = '{{ csrf_token() }}';
		// const sidebar = document.getElementById('sidebar');
		// const overlay = document.getElementById('overlay');
		// const menuButton = document.getElementById('menuButton');
		const seoTabs = document.querySelectorAll('.seo-tab');
		const seoPanels = document.querySelectorAll('.seo-panel');
		const saveSeoBtn = document.getElementById('saveSeoBtn');

		// menuButton.addEventListener('click', () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); });
		// overlay.addEventListener('click', () => { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); });

		seoTabs.forEach((tabElement) => {
			tabElement.addEventListener('click', () => {
				const tabKey = tabElement.dataset.tab;

				seoTabs.forEach((itemElement) => {
					itemElement.classList.remove('active');
					itemElement.classList.add('text-slate-700', 'hover:bg-slate-50');
				});

				tabElement.classList.add('active');
				tabElement.classList.remove('text-slate-700', 'hover:bg-slate-50');

				seoPanels.forEach((panelElement) => {
					panelElement.classList.add('hidden');
				});

				const activePanel = document.getElementById(`seo-tab-${tabKey}`);
				if (activePanel) {
					activePanel.classList.remove('hidden');
				}
			});
		});

		if (saveSeoBtn) {
			saveSeoBtn.addEventListener('click', async () => {
				const activePanel = document.querySelector('.seo-panel:not(.hidden)');

				if (!activePanel) {
					alert('Không tìm thấy tab SEO đang mở');
					return;
				}

				const pageKey = activePanel.dataset.pageKey || '';
				const payload = {
					page_key: pageKey,
					title: activePanel.querySelector('[data-field="title"]')?.value?.trim() || '',
					meta_description: activePanel.querySelector('[data-field="meta_description"]')?.value?.trim() || '',
					keywords: activePanel.querySelector('[data-field="keywords"]')?.value?.trim() || '',
					og_image: activePanel.querySelector('[data-field="og_image"]')?.value?.trim() || '',
					canonical_url: activePanel.querySelector('[data-field="canonical_url"]')?.value?.trim() || '',
				};

				const productIdInput = activePanel.querySelector('[data-field="product_id"]');
				if (productIdInput) {
					const productId = productIdInput.value.trim();
					payload.product_id = productId === '' ? null : Number(productId);
				}

				saveSeoBtn.disabled = true;
				saveSeoBtn.textContent = 'Đang lưu...';

				try {
					const response = await fetch(seoSaveUrl, {
						method: 'POST',
						headers: {
							'Content-Type': 'application/json',
							'Accept': 'application/json',
							'X-CSRF-TOKEN': csrfToken,
						},
						body: JSON.stringify(payload),
					});

					const data = await response.json();

					if (!response.ok) {
						console.log(data);
						alert(data.message || 'Lưu SEO thất bại');
						return;
					}

					alert(`Đã lưu SEO cho tab ${pageKey}`);
				} catch (error) {
					console.error(error);
					alert('Lỗi server khi lưu SEO');
				} finally {
					saveSeoBtn.disabled = false;
					saveSeoBtn.textContent = 'Lưu SEO';
				}
			});
		}
	</script>
@endsection
@endsection