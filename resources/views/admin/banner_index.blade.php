
@extends('admin_layout')

@section('css')
<style>
		.sidebar-link { color: rgb(71 85 105); }
		.sidebar-link.active { background-color: rgb(79 70 229); color: #fff; box-shadow: 0 1px 2px rgba(15, 23, 42, 0.15); }
		.sidebar-link:not(.active):hover { background-color: rgb(238 242 255); color: rgb(67 56 202); }
	</style>
@endsection

@section('content')

<section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm flex items-center justify-between">
					<div><h2 class="text-base font-semibold text-slate-900">Danh sách banner hiển thị khách hàng</h2><p class="mt-1 text-sm text-slate-500">CRUD banner cho trang chủ và landing pages.</p></div>
					<!-- <button class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Tạo banner</button> -->
				</section>
				<section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
					<div class="mb-4 flex items-center justify-between">
						<h3 class="text-base font-semibold text-slate-900">Preview banner theo màn hình bán hàng</h3>
						<span class="text-sm text-slate-500">6 vị trí hiển thị</span>
					</div>

					<div class="flex flex-wrap gap-4">
						@foreach ($banners as $banner)
							<article
								data-screen="{{ $banner['screen'] }}"
								data-banner-id="{{ $banner['id'] ?? '' }}"
								data-placeholder="{{ $banner['placeholder'] }}"
								class="w-full rounded-2xl border border-slate-100 bg-white p-3 shadow-sm sm:w-[calc(50%-0.5rem)] xl:w-[calc(33.333%-0.75rem)]"
							>
								<img src="{{ $banner['image_url'] }}" alt="Banner {{ $banner['screen'] }}" class="h-36 w-full rounded-xl object-cover" />
								<p class="mt-3 text-sm font-semibold text-slate-900">{{ $banner['screen'] }}</p>
								<p class="mt-1 text-xs text-slate-500">{{ $banner['description'] }}</p>
								<div class="mt-3 flex items-center gap-2">
									<button type="button" class="banner-upload-btn rounded-lg bg-indigo-600 px-3 py-1.5 text-xs font-medium text-white hover:bg-indigo-700">Upload</button>
									<button type="button" class="banner-delete-btn rounded-lg border border-rose-200 px-3 py-1.5 text-xs font-medium text-rose-600 hover:bg-rose-50">Xóa banner</button>
								</div>
							</article>
						@endforeach
					</div>
				</section>

            <div id="uploadBannerModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
		<div class="w-full max-w-lg rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
			<div class="mb-4 flex items-center justify-between">
				<h3 class="text-lg font-semibold text-slate-900">Upload banner</h3>
				<button type="button" data-close-modal="uploadBannerModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700">✕</button>
			</div>
			<p class="mb-3 text-sm text-slate-600">Màn hình: <span id="uploadBannerScreen" class="font-semibold text-slate-900"></span></p>
			<form id="uploadBannerForm" class="space-y-4">
				<div>
					<label for="bannerFile" class="mb-1 block text-sm font-medium text-slate-700">Chọn file banner</label>
					<input id="bannerFile" type="file" accept="image/*" required class="hidden" />
					<div class="flex items-center gap-3">
						<button id="triggerBannerFileBtn" type="button" class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Chọn ảnh banner</button>
						<span id="selectedBannerFileName" class="text-sm text-slate-500">Chưa chọn file</span>
					</div>
				</div>
				<div class="flex justify-end gap-2">
					<button type="button" data-close-modal="uploadBannerModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</button>
					<button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700">Xác nhận thay đổi banner</button>
				</div>
			</form>
		</div>
	</div>

	<div id="deleteBannerModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
		<div class="w-full max-w-md rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
			<div class="mb-3 flex items-center justify-between">
				<h3 class="text-lg font-semibold text-slate-900">Xác nhận xóa banner</h3>
				<button type="button" data-close-modal="deleteBannerModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700">✕</button>
			</div>
			<p class="text-sm text-slate-600">Bạn có chắc muốn xóa banner của màn hình <span id="deleteBannerScreen" class="font-semibold text-slate-900"></span> không?</p>
			<div class="mt-5 flex justify-end gap-2">
				<button type="button" data-close-modal="deleteBannerModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</button>
				<button type="button" id="confirmDeleteBannerBtn" class="rounded-xl bg-rose-600 px-4 py-2 text-sm font-medium text-white hover:bg-rose-700">Xác nhận xóa</button>
			</div>
		</div>
	</div>

	@section('script')
	<script>
		const uploadBannerUrl = '{{ route('admin.banners.upload') }}';
		const deleteBannerUrl = '{{ route('admin.banners.delete') }}';
		const csrfToken = '{{ csrf_token() }}';
		// const sidebar = document.getElementById('sidebar');
		// const overlay = document.getElementById('overlay');
		// const menuButton = document.getElementById('menuButton');
		const uploadBannerModal = document.getElementById('uploadBannerModal');
		const deleteBannerModal = document.getElementById('deleteBannerModal');
		const uploadBannerScreen = document.getElementById('uploadBannerScreen');
		const deleteBannerScreen = document.getElementById('deleteBannerScreen');
		const uploadBannerForm = document.getElementById('uploadBannerForm');
		const bannerFileInput = document.getElementById('bannerFile');
		const triggerBannerFileBtn = document.getElementById('triggerBannerFileBtn');
		const selectedBannerFileName = document.getElementById('selectedBannerFileName');
		const confirmDeleteBannerBtn = document.getElementById('confirmDeleteBannerBtn');
		let currentUploadCard = null;
		let currentDeleteCard = null;
		// menuButton.addEventListener('click', () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); });
		// overlay.addEventListener('click', () => { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); });

		function openModal(modalElement) {
			modalElement.classList.remove('hidden');
			modalElement.classList.add('flex');
		}

		function closeModal(modalElement) {
			modalElement.classList.add('hidden');
			modalElement.classList.remove('flex');
		}

		document.querySelectorAll('.banner-upload-btn').forEach((button) => {
			button.addEventListener('click', () => {
				const card = button.closest('article');
				currentUploadCard = card;
				uploadBannerScreen.textContent = card?.dataset.screen || '';
				if (bannerFileInput) {
					bannerFileInput.value = '';
				}
				if (selectedBannerFileName) {
					selectedBannerFileName.textContent = 'Chưa chọn file';
				}
				openModal(uploadBannerModal);
			});
		});

		if (triggerBannerFileBtn && bannerFileInput) {
			triggerBannerFileBtn.addEventListener('click', () => {
				bannerFileInput.click();
			});
		}

		if (bannerFileInput && selectedBannerFileName) {
			bannerFileInput.addEventListener('change', () => {
				selectedBannerFileName.textContent = bannerFileInput.files?.[0]?.name || 'Chưa chọn file';
			});
		}

		document.querySelectorAll('.banner-delete-btn').forEach((button) => {
			button.addEventListener('click', () => {
				const card = button.closest('article');
				currentDeleteCard = card;
				deleteBannerScreen.textContent = card?.dataset.screen || '';
				openModal(deleteBannerModal);
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

		[uploadBannerModal, deleteBannerModal].forEach((modalElement) => {
			if (!modalElement) {
				return;
			}

			modalElement.addEventListener('click', (event) => {
				if (event.target === modalElement) {
					closeModal(modalElement);
				}
			});
		});

		uploadBannerForm.addEventListener('submit', async (event) => {
			event.preventDefault();

			if (!currentUploadCard) {
				alert('Không tìm thấy card banner cần upload');
				return;
			}

			const bannerFile = bannerFileInput?.files?.[0];
			if (!bannerFile) {
				alert('Vui lòng chọn file ảnh banner');
				return;
			}

			const formData = new FormData();
			formData.append('screen', currentUploadCard.dataset.screen || '');
			formData.append('banner_image', bannerFile);

			try {
				const response = await fetch(uploadBannerUrl, {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': csrfToken,
						'Accept': 'application/json'
					},
					body: formData
				});

				const data = await response.json();

				if (!response.ok) {
					console.log(data);
					alert(data.message || 'Upload banner thất bại');
					return;
				}

				const previewImage = currentUploadCard.querySelector('img');
				if (previewImage && data.image_url) {
					previewImage.src = `${data.image_url}?t=${Date.now()}`;
				}

				if (typeof data.banner_id !== 'undefined') {
					currentUploadCard.dataset.bannerId = data.banner_id;
				}

				uploadBannerForm.reset();
				if (selectedBannerFileName) {
					selectedBannerFileName.textContent = 'Chưa chọn file';
				}
				closeModal(uploadBannerModal);
				alert('Upload banner thành công');
			} catch (error) {
				console.error(error);
				alert('Lỗi server khi upload banner');
			}
		});

		confirmDeleteBannerBtn.addEventListener('click', async () => {
			if (!currentDeleteCard) {
				alert('Không tìm thấy card banner cần xóa');
				return;
			}

			try {
				const response = await fetch(deleteBannerUrl, {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': csrfToken,
						'Content-Type': 'application/json',
						'Accept': 'application/json'
					},
					body: JSON.stringify({
						screen: currentDeleteCard.dataset.screen || ''
					})
				});

				const data = await response.json();

				if (!response.ok) {
					console.log(data);
					alert(data.message || 'Xóa banner thất bại');
					return;
				}

				const previewImage = currentDeleteCard.querySelector('img');
				if (previewImage) {
					previewImage.src = currentDeleteCard.dataset.placeholder || previewImage.src;
				}

				currentDeleteCard.dataset.bannerId = '';
				deleteBannerScreen.textContent = '';
				closeModal(deleteBannerModal);
				alert('Xóa banner thành công');
			} catch (error) {
				console.error(error);
				alert('Lỗi server khi xóa banner');
			}
		});
	</script>
	@endsection

    @endsection