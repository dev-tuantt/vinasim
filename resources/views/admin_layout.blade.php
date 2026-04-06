<!doctype html>
<html lang="vi">
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Admin Dashboard</title>
	<script src="https://cdn.tailwindcss.com"></script>
	<style>
		.sidebar-link {
			color: rgb(71 85 105);
		}

		.sidebar-link.active {
			background-color: rgb(79 70 229);
			color: #fff;
			box-shadow: 0 1px 2px rgba(15, 23, 42, 0.15);
		}

		.sidebar-link:not(.active):hover {
			background-color: rgb(238 242 255);
			color: rgb(67 56 202);
		}
	</style>
    @yield('css')
</head>
<body class="min-h-screen bg-slate-50 text-slate-700 antialiased">
	<div class="flex min-h-screen">
		<aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-72 -translate-x-full border-r border-slate-100 bg-white/95 shadow-xl transition-transform duration-300 md:static md:translate-x-0 md:shadow-none">
			<div class="flex h-20 items-center border-b border-slate-100 px-5">
				<a href="/admin" class="flex items-center gap-3 text-xl font-semibold text-slate-900" aria-label="Về trang admin">
					<span class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm">
						<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path d="M10 2a2 2 0 0 1 2 2v1.172a3.001 3.001 0 0 1 .879 5.994A3 3 0 0 1 10 16a3 3 0 0 1-2.879-4.834A3.001 3.001 0 0 1 8 5.172V4a2 2 0 0 1 2-2Z" />
							<path d="M3 14.5A2.5 2.5 0 0 1 5.5 12h9a2.5 2.5 0 0 1 2.5 2.5V16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.5Z" />
						</svg>
					</span>
					<span>Admin Panel</span>
				</a>
			</div>

			<nav class="space-y-2 p-4">

                <a href="{{ route('admin.users') }}"
                class="sidebar-link {{ request()->routeIs('admin.users') ? 'active' : '' }} block rounded-xl px-3 py-2.5 text-sm font-medium transition">
                    Quản lý người dùng
                </a>

                <a href="{{ route('admin.banners') }}"
                class="sidebar-link {{ request()->routeIs('admin.banners') ? 'active' : '' }} block rounded-xl px-3 py-2.5 text-sm font-medium transition">
                    Quản lý Banner
                </a>

                <a href="{{ route('admin.products') }}"
                class="sidebar-link {{ request()->routeIs('admin.products') ? 'active' : '' }} block rounded-xl px-3 py-2.5 text-sm font-medium transition">
                    Quản lý Sản phẩm
                </a>

                <a href="{{ route('admin.orders') }}"
                class="sidebar-link {{ request()->routeIs('admin.orders') ? 'active' : '' }} block rounded-xl px-3 py-2.5 text-sm font-medium transition">
                    Quản lý Đơn hàng
                </a>

                <a href="{{ route('admin.seo') }}"
                class="sidebar-link {{ request()->routeIs('admin.seo') ? 'active' : '' }} block rounded-xl px-3 py-2.5 text-sm font-medium transition">
                    Quản lý SEO
                </a>

                <a href="{{ route('admin.news') }}"
                class="sidebar-link {{ request()->routeIs('admin.news*') ? 'active' : '' }} block rounded-xl px-3 py-2.5 text-sm font-medium transition">
                    Quản lý Tin tức
                </a>

            </nav>
		</aside>

		<div id="overlay" class="fixed inset-0 z-30 hidden bg-slate-900/40 backdrop-blur-sm md:hidden"></div>

		<div class="flex min-h-screen flex-1 flex-col">
			<header class="sticky top-0 z-20 border-b border-slate-100 bg-white/90 shadow-sm backdrop-blur">
				<div class="flex h-20 items-center justify-between px-4 md:px-8">
					<div class="flex items-center gap-3">
						<button id="menuButton" class="inline-flex h-10 w-10 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 transition hover:bg-slate-50 md:hidden" aria-label="Mở menu">
							<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
							</svg>
						</button>
						<a href="/admin" class="hidden items-center gap-2 text-slate-900 md:flex" aria-label="Về trang admin">
							<span class="flex h-9 w-9 items-center justify-center rounded-xl bg-indigo-600 text-white shadow-sm">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
									<path d="M10 2a2 2 0 0 1 2 2v1.172a3.001 3.001 0 0 1 .879 5.994A3 3 0 0 1 10 16a3 3 0 0 1-2.879-4.834A3.001 3.001 0 0 1 8 5.172V4a2 2 0 0 1 2-2Z" />
									<path d="M3 14.5A2.5 2.5 0 0 1 5.5 12h9a2.5 2.5 0 0 1 2.5 2.5V16a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1v-1.5Z" />
								</svg>
							</span>
							<span class="font-semibold">Admin</span>
						</a>
					</div>

					<div class="flex items-center gap-3">
						<div class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm shadow-sm">
							Xin chào, <span class="font-semibold">{{ auth()->check() ? auth()->user()->name : 'Admin' }}</span>
						</div>
						<form action="{{ route('admin.logout') }}" method="POST" class="inline-block">
							@csrf
							<button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700">
								Đăng xuất
							</button>
						</form>
					</div>
				</div>
			</header>

			<main class="flex-1 p-5 md:p-8">
				@yield('content')
			</main>
		</div>
	</div>

	<div id="editModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
		<div class="w-full max-w-xl rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
			<div class="mb-4 flex items-center justify-between">
				<h3 class="text-lg font-semibold text-slate-900">Sửa dữ liệu</h3>
				<button type="button" data-close-modal="editModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700" aria-label="Đóng modal sửa">✕</button>
			</div>
			<form id="editForm" class="grid gap-4 sm:grid-cols-2">
				<div>
					<label for="editCode" class="mb-1 block text-sm font-medium text-slate-700">Mã đơn</label>
					<input id="editCode" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
				</div>
				<div>
					<label for="editCreator" class="mb-1 block text-sm font-medium text-slate-700">Người tạo</label>
					<input id="editCreator" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
				</div>
				<div>
					<label for="editDepartment" class="mb-1 block text-sm font-medium text-slate-700">Phòng ban</label>
					<input id="editDepartment" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
				</div>
				<div>
					<label for="editDate" class="mb-1 block text-sm font-medium text-slate-700">Ngày tạo</label>
					<input id="editDate" type="text" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
				</div>
				<div class="sm:col-span-2">
					<label for="editStatus" class="mb-1 block text-sm font-medium text-slate-700">Trạng thái</label>
					<select id="editStatus" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
						<option value="approved">Đã duyệt</option>
						<option value="pending">Chờ duyệt</option>
						<option value="rejected">Từ chối</option>
					</select>
				</div>
				<div class="sm:col-span-2 flex justify-end gap-2">
					<button type="button" data-close-modal="editModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Hủy</button>
					<button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Xác nhận sửa</button>
				</div>
			</form>
		</div>
	</div>

	<div id="deleteModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
		<div class="w-full max-w-md rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
			<div class="mb-3 flex items-center justify-between">
				<h3 class="text-lg font-semibold text-slate-900">Xác nhận xóa</h3>
				<button type="button" data-close-modal="deleteModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700" aria-label="Đóng modal xóa">✕</button>
			</div>
			<p class="text-sm text-slate-600">Bạn có chắc chắn muốn xóa bản ghi <span id="deleteTargetCode" class="font-semibold text-slate-900"></span> không?</p>
			<div class="mt-5 flex justify-end gap-2">
				<button type="button" data-close-modal="deleteModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Hủy</button>
				<button type="button" id="confirmDeleteBtn" class="rounded-xl bg-rose-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-rose-700">Xác nhận xóa</button>
			</div>
		</div>
	</div>

	<div id="createModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
		<div class="w-full max-w-xl rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
			<div class="mb-4 flex items-center justify-between">
				<h3 class="text-lg font-semibold text-slate-900">Tạo mới dữ liệu</h3>
				<button type="button" data-close-modal="createModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700" aria-label="Đóng modal tạo mới">✕</button>
			</div>
			<form id="createForm" class="grid gap-4 sm:grid-cols-2">
				<div>
					<label for="createCode" class="mb-1 block text-sm font-medium text-slate-700">Mã đơn</label>
					<input id="createCode" type="text" placeholder="VD: REQ-1004" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
				</div>
				<div>
					<label for="createCreator" class="mb-1 block text-sm font-medium text-slate-700">Người tạo</label>
					<input id="createCreator" type="text" placeholder="Nhập tên người tạo" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
				</div>
				<div>
					<label for="createDepartment" class="mb-1 block text-sm font-medium text-slate-700">Phòng ban</label>
					<input id="createDepartment" type="text" placeholder="VD: Kế toán" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
				</div>
				<div>
					<label for="createDate" class="mb-1 block text-sm font-medium text-slate-700">Ngày tạo</label>
					<input id="createDate" type="text" placeholder="DD/MM/YYYY" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
				</div>
				<div class="sm:col-span-2">
					<label for="createStatus" class="mb-1 block text-sm font-medium text-slate-700">Trạng thái</label>
					<select id="createStatus" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
						<option value="pending">Chờ duyệt</option>
						<option value="approved">Đã duyệt</option>
						<option value="rejected">Từ chối</option>
					</select>
				</div>
				<div class="sm:col-span-2 flex justify-end gap-2">
					<button type="button" data-close-modal="createModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</button>
					<button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Xác nhận tạo</button>
				</div>
			</form>
		</div>
	</div>

	<script>
		const sidebar = document.getElementById('sidebar');
		const overlay = document.getElementById('overlay');
		const menuButton = document.getElementById('menuButton');
		const editModal = document.getElementById('editModal');
		const deleteModal = document.getElementById('deleteModal');
		const editForm = document.getElementById('editForm');
		const deleteTargetCode = document.getElementById('deleteTargetCode');
		const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
		const createModal = document.getElementById('createModal');
		const openCreateModalBtn = document.getElementById('openCreateModalBtn');
		const createForm = document.getElementById('createForm');
		const sidebarLinks = document.querySelectorAll('.sidebar-link');
		let currentDeleteCode = '';

		function openSidebar() {
			sidebar.classList.remove('-translate-x-full');
			overlay.classList.remove('hidden');
		}

		function closeSidebar() {
			sidebar.classList.add('-translate-x-full');
			overlay.classList.add('hidden');
		}

		menuButton.addEventListener('click', openSidebar);
		overlay.addEventListener('click', closeSidebar);

		if (openCreateModalBtn && createModal) {
			openCreateModalBtn.addEventListener('click', () => {
				openModal(createModal);
			});
		}

		sidebarLinks.forEach((linkElement) => {
			linkElement.addEventListener('click', () => {
				sidebarLinks.forEach((itemElement) => {
					itemElement.classList.remove('active');
				});

				linkElement.classList.add('active');
			});
		});

		function openModal(modalElement) {
			modalElement.classList.remove('hidden');
			modalElement.classList.add('flex');
		}

		function closeModal(modalElement) {
			modalElement.classList.add('hidden');
			modalElement.classList.remove('flex');
		}

		document.querySelectorAll('.row-action-select').forEach((selectElement) => {
			selectElement.addEventListener('change', (event) => {
				const action = event.target.value;
				const currentRow = event.target.closest('tr');

				if (!action || !currentRow) {
					return;
				}

				if (action === 'edit') {
					document.getElementById('editCode').value = currentRow.dataset.code || '';
					document.getElementById('editCreator').value = currentRow.dataset.creator || '';
					document.getElementById('editDepartment').value = currentRow.dataset.department || '';
					document.getElementById('editDate').value = currentRow.dataset.date || '';
					document.getElementById('editStatus').value = currentRow.dataset.status || 'pending';
					openModal(editModal);
				}

				if (action === 'delete') {
					currentDeleteCode = currentRow.dataset.code || '';
					deleteTargetCode.textContent = currentDeleteCode;
					openModal(deleteModal);
				}

				event.target.value = '';
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

		[editModal, deleteModal, createModal].forEach((modalElement) => {
			if (!modalElement) {
				return;
			}

			modalElement.addEventListener('click', (event) => {
				if (event.target === modalElement) {
					closeModal(modalElement);
				}
			});
		});

		editForm.addEventListener('submit', (event) => {
			event.preventDefault();
			closeModal(editModal);
		});

		confirmDeleteBtn.addEventListener('click', () => {
			currentDeleteCode = '';
			deleteTargetCode.textContent = '';
			closeModal(deleteModal);
		});

		if (createForm) {
			createForm.addEventListener('submit', (event) => {
				event.preventDefault();
				createForm.reset();
				closeModal(createModal);
			});
		}

		window.addEventListener('resize', () => {
			if (window.innerWidth >= 768) {
				overlay.classList.add('hidden');
			}
		});
	</script>
    @yield('script')
</body>
</html>
