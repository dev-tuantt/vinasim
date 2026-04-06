@extends('admin_layout')
@section('css')
<style>
		.sidebar-link { color: rgb(71 85 105); }
		.sidebar-link.active { background-color: rgb(79 70 229); color: #fff; box-shadow: 0 1px 2px rgba(15, 23, 42, 0.15); }
		.sidebar-link:not(.active):hover { background-color: rgb(238 242 255); color: rgb(67 56 202); }
		/* table { min-height: 400px; } */
		.action-dropdown {
			position: absolute;
			right: 0;
			top: calc(100% + 8px);
			z-index: 20;
			display: none;
			min-width: 140px;
			border-radius: 0.75rem;
			border: 1px solid rgb(226 232 240);
			background: #fff;
			padding: 0.35rem;
			box-shadow: 0 10px 25px rgba(15, 23, 42, 0.12);
		}
		.action-dropdown.open { display: block; }
		.action-item {
			display: block;
			width: 100%;
			border-radius: 0.5rem;
			padding: 0.45rem 0.65rem;
			text-align: left;
			font-size: 0.875rem;
			color: rgb(51 65 85);
		}
		.action-item:hover { background: rgb(248 250 252); }
		.action-item.danger { color: rgb(220 38 38); }
	</style>
@endsection
@section('content')
    <section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm flex items-center justify-between">
		<div><h2 class="text-base font-semibold text-slate-900">Danh sách bài viết</h2><p class="mt-1 text-sm text-slate-500">Quản lý bài viết tin tức và mở editor để tạo mới hoặc cập nhật nội dung.</p></div>
		<a href="{{ route('admin.news.editor') }}" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Tạo bài viết</a>
    </section>
    <section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
        <div class="overflow-x-auto rounded-xl border border-slate-100">
            <table class="min-w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-600"><tr><th class="px-4 py-3">Tiêu đề</th><th class="px-4 py-3">Tác giả</th><th class="px-4 py-3">Ngày đăng</th><th class="px-4 py-3">Trạng thái</th><th class="px-4 py-3">Action</th></tr></thead>
                <tbody class="divide-y divide-slate-100 bg-white">
					@forelse($newsItems as $news)
					<tr data-id="{{ $news->id }}" data-title="{{ $news->title }}">
						<td class="px-4 py-3">{{ $news->title }}</td>
						<td class="px-4 py-3">-</td>
						<td class="px-4 py-3">{{ $news->published_at ? \Carbon\Carbon::parse($news->published_at)->format('d/m/Y H:i') : '-' }}</td>
						<td class="px-4 py-3">
							@if((int) $news->is_published === 1)
							<span class="rounded-full bg-emerald-50 px-2 py-1 text-xs font-medium text-emerald-600">Đã đăng</span>
							@else
							<span class="rounded-full bg-amber-50 px-2 py-1 text-xs font-medium text-amber-600">Nháp</span>
							@endif
						</td>
						<td class="px-4 py-3">
							<div class="relative inline-block">
								<button data-action-button class="rounded-lg border border-slate-200 px-2.5 py-1.5 text-xs font-medium text-slate-700 hover:bg-slate-50">Thao tác</button>
								<div data-action-menu class="action-dropdown">
									<a href="{{ route('admin.news.editor', ['id' => $news->id]) }}" class="action-item">Cập nhật</a>
									<button data-delete-btn class="action-item danger" type="button">Xóa</button>
								</div>
							</div>
						</td>
					</tr>
					@empty
					<tr>
						<td colspan="5" class="px-4 py-6 text-center text-sm text-slate-500">Chưa có bài viết nào. Hãy tạo bài viết mới.</td>
					</tr>
					@endforelse
                </tbody>
            </table>
        </div>
    </section>
    <div id="deleteNewsModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 p-4">
		<div class="w-full max-w-md rounded-2xl bg-white p-5 shadow-2xl">
			<h3 class="text-base font-semibold text-slate-900">Xác nhận xóa bài viết</h3>
			<p class="mt-2 text-sm text-slate-600">Bạn có chắc muốn xóa bài viết <span id="deleteNewsTitle" class="font-semibold text-slate-900"></span> không?</p>
			<div class="mt-5 flex justify-end gap-2">
				<button id="cancelDeleteNews" type="button" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Hủy</button>
				<button id="confirmDeleteNews" type="button" class="rounded-xl bg-rose-600 px-4 py-2 text-sm font-medium text-white">Xóa</button>
			</div>
		</div>
	</div>
    @section('script')
    <script>
		// const sidebar = document.getElementById('sidebar');
		// const overlay = document.getElementById('overlay');
		// const menuButton = document.getElementById('menuButton');
		const actionButtons = document.querySelectorAll('[data-action-button]');
		const deleteButtons = document.querySelectorAll('[data-delete-btn]');
		const deleteNewsModal = document.getElementById('deleteNewsModal');
		const deleteNewsTitle = document.getElementById('deleteNewsTitle');
		const cancelDeleteNews = document.getElementById('cancelDeleteNews');
		const confirmDeleteNews = document.getElementById('confirmDeleteNews');
		let deletingRow = null;

		// menuButton.addEventListener('click', () => { sidebar.classList.remove('-translate-x-full'); overlay.classList.remove('hidden'); });
		// overlay.addEventListener('click', () => { sidebar.classList.add('-translate-x-full'); overlay.classList.add('hidden'); });

		const closeAllActionMenus = () => {
			document.querySelectorAll('[data-action-menu]').forEach((menuElement) => {
				menuElement.classList.remove('open');
			});
		};

		actionButtons.forEach((buttonElement) => {
			buttonElement.addEventListener('click', (event) => {
				event.stopPropagation();
				const menuElement = buttonElement.nextElementSibling;
				const isOpen = menuElement.classList.contains('open');
				closeAllActionMenus();
				if (!isOpen) {
					menuElement.classList.add('open');
				}
			});
		});

		document.addEventListener('click', () => {
			closeAllActionMenus();
		});

		deleteButtons.forEach((buttonElement) => {
			buttonElement.addEventListener('click', (event) => {
				event.stopPropagation();
				closeAllActionMenus();
				deletingRow = buttonElement.closest('tr');
				deleteNewsTitle.textContent = `"${deletingRow.dataset.title}"`;
				deleteNewsModal.classList.remove('hidden');
				deleteNewsModal.classList.add('flex');
			});
		});

		cancelDeleteNews.addEventListener('click', () => {
			deleteNewsModal.classList.add('hidden');
			deleteNewsModal.classList.remove('flex');
			deletingRow = null;
		});

		confirmDeleteNews.addEventListener('click', () => {
			if (deletingRow) {
				deletingRow.remove();
			}
			deleteNewsModal.classList.add('hidden');
			deleteNewsModal.classList.remove('flex');
			deletingRow = null;
		});

		deleteNewsModal.addEventListener('click', (event) => {
			if (event.target === deleteNewsModal) {
				deleteNewsModal.classList.add('hidden');
				deleteNewsModal.classList.remove('flex');
				deletingRow = null;
			}
		});
	</script>
    @endsection
@endsection