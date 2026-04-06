@extends('admin_layout')

@section('css')
<style>
		.sidebar-link { color: rgb(71 85 105); }
		.sidebar-link.active { background-color: rgb(79 70 229); color: #fff; box-shadow: 0 1px 2px rgba(15, 23, 42, 0.15); }
		.sidebar-link:not(.active):hover { background-color: rgb(238 242 255); color: rgb(67 56 202); }
		table { min-height: 400px; }
	</style>
@endsection


@section('content')
				<section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
					<div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
						<div>
							<h2 class="text-base font-semibold text-slate-900">Danh sách tài khoản hệ thống</h2>
							<p class="mt-1 text-sm text-slate-500">Admin có toàn quyền, Supporter chỉ quản lý nội dung.</p>
						</div>
						<button id="openCreateUserModalBtn" type="button" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Tạo người dùng</button>
					</div>
				</section>

				<section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
					<div class="overflow-x-auto rounded-xl border border-slate-100">
						<table class="min-w-full text-left text-sm">
							<thead class="bg-slate-50 text-slate-600">
								<tr>
									<th class="px-4 py-3 font-medium">Tên</th>
									<th class="px-4 py-3 font-medium">Email</th>
									<th class="px-4 py-3 font-medium">Vai trò</th>
									<th class="px-4 py-3 font-medium">Trạng thái</th>
									<th class="px-4 py-3 font-medium">Action</th>
								</tr>
							</thead>
							<tbody class="divide-y divide-slate-100 bg-white">
								@foreach ($users as $user)
									<tr 
										data-user-id="{{ $user->id }}" 
										data-name="{{ $user->name }}" 
										data-email="{{ $user->email }}" 
										data-role="{{ $user->role }}"
									>
										<td class="px-4 py-3">{{ $user->name }}</td>

										<td class="px-4 py-3">{{ $user->email }}</td>

										<td class="px-4 py-3">
											@if ($user->role == 1)
												<span class="rounded-full bg-indigo-100 px-2 py-1 text-xs font-medium text-indigo-700">Admin</span>
											@else
												<span class="rounded-full bg-amber-100 px-2 py-1 text-xs font-medium text-amber-700">Supporter</span>
											@endif
										</td>

										<td class="px-4 py-3">
											<span class="rounded-full bg-emerald-100 px-2 py-1 text-xs font-medium text-emerald-700">
												Active
											</span>
										</td>

										<td class="px-4 py-3">
											<select class="user-action-select rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm text-slate-700 focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
												<option value="">Chọn thao tác</option>
												<option value="edit">Chỉnh sửa</option>
												<option value="delete">Xóa user</option>
											</select>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</section>

	<div id="createUserModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
		<div class="w-full max-w-xl rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
			<div class="mb-4 flex items-center justify-between">
				<h3 class="text-lg font-semibold text-slate-900">Tạo người dùng</h3>
				<button type="button" data-close-modal="createUserModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700" aria-label="Đóng modal tạo người dùng">✕</button>
			</div>

			<form id="createUserForm" method="POST" action="{{ route('admin.users.store') }}" class="grid gap-4 sm:grid-cols-2">
    			@csrf
				<div class="sm:col-span-2">
					<label for="userName" class="mb-1 block text-sm font-medium text-slate-700">Tên người dùng</label>
					<input id="userName" name="name" type="text" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Nhập tên người dùng" />
				</div>
				<div class="sm:col-span-2">
					<label for="userEmail" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
					<input id="userEmail" name="email" type="email" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="user@example.com" />
				</div>
				<div>
					<label for="userRole" class="mb-1 block text-sm font-medium text-slate-700">Vai trò</label>
					<select id="userRole" name="role" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
						<option value="1">Admin</option>
						<option value="2">Supporter</option>
					</select>
				</div>
				<div>
					<label for="userPassword" class="mb-1 block text-sm font-medium text-slate-700">Mật khẩu</label>
					<input id="userPassword" name="password" type="password" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Nhập mật khẩu" />
				</div>

				<div class="sm:col-span-2 flex justify-end gap-2">
					<button type="button" data-close-modal="createUserModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</button>
					<button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Xác nhận tạo</button>
				</div>
			</form>
		</div>
	</div>

	<div id="editUserModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
		<div class="w-full max-w-xl rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
			<div class="mb-4 flex items-center justify-between">
				<h3 class="text-lg font-semibold text-slate-900">Chỉnh sửa người dùng</h3>
				<button type="button" data-close-modal="editUserModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700" aria-label="Đóng modal sửa user">✕</button>
			</div>

			<form id="editUserForm" class="grid gap-4 sm:grid-cols-2">
				@csrf
				<input type="hidden" name="_method" value="PUT">
				<input id="editUserId" name="id" type="hidden" />
				<div class="sm:col-span-2">
					<label for="editUserName" class="mb-1 block text-sm font-medium text-slate-700">Tên người dùng</label>
					<input id="editUserName" name="name" type="text" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
				</div>
				<div class="sm:col-span-2">
					<label for="editUserEmail" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
					<input id="editUserEmail" name="email" type="email" required class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" />
				</div>
				<div>
					<label for="editUserRole" class="mb-1 block text-sm font-medium text-slate-700">Vai trò</label>
					<select id="editUserRole" name="role" required class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100">
						<option value="1">Admin</option>
						<option value="2">Supporter</option>
					</select>
				</div>
				<div>
					<label for="editUserPassword" class="mb-1 block text-sm font-medium text-slate-700">Mật khẩu mới (tuỳ chọn)</label>
					<input id="editUserPassword" name="password" type="password" class="w-full rounded-xl border border-slate-200 px-3 py-2 text-sm focus:border-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-100" placeholder="Để trống nếu không đổi" />
				</div>

				<div class="sm:col-span-2 flex justify-end gap-2">
					<button type="button" data-close-modal="editUserModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</button>
					<button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700">Lưu thay đổi</button>
				</div>
			</form>
		</div>
	</div>

	<div id="deleteUserModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
		<div class="w-full max-w-md rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
			<div class="mb-3 flex items-center justify-between">
				<h3 class="text-lg font-semibold text-slate-900">Xác nhận xóa user</h3>
				<button type="button" data-close-modal="deleteUserModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700" aria-label="Đóng modal xóa user">✕</button>
			</div>
			<p class="text-sm text-slate-600">Bạn có chắc muốn xóa user <span id="deleteUserName" class="font-semibold text-slate-900"></span> không?</p>
			<div class="mt-5 flex justify-end gap-2">
				<button type="button" data-close-modal="deleteUserModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700 hover:bg-slate-50">Cancel</button>
				<button type="button" id="confirmDeleteUserBtn" class="rounded-xl bg-rose-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-rose-700">Xác nhận xóa</button>
			</div>
		</div>
	</div>
    @section('script')
	<script>
		// const sidebar = document.getElementById('sidebar');
		// const overlay = document.getElementById('overlay');
		// const menuButton = document.getElementById('menuButton');
		const createUserModal = document.getElementById('createUserModal');
		const openCreateUserModalBtn = document.getElementById('openCreateUserModalBtn');
		const createUserForm = document.getElementById('createUserForm');
		const editUserModal = document.getElementById('editUserModal');
		const editUserForm = document.getElementById('editUserForm');
		const deleteUserModal = document.getElementById('deleteUserModal');
		const deleteUserName = document.getElementById('deleteUserName');
		const confirmDeleteUserBtn = document.getElementById('confirmDeleteUserBtn');
		let currentDeleteUserId = '';

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

		if (openCreateUserModalBtn && createUserModal) {
			openCreateUserModalBtn.addEventListener('click', () => {
				openModal(createUserModal);
			});
		}

		document.querySelectorAll('.user-action-select').forEach((selectElement) => {
			selectElement.addEventListener('change', (event) => {
				const action = event.target.value;
				const currentRow = event.target.closest('tr');

				if (!action || !currentRow) {
					return;
				}

				if (action === 'edit') {
					document.getElementById('editUserId').value = currentRow.dataset.userId || '';
					document.getElementById('editUserName').value = currentRow.dataset.name || '';
					document.getElementById('editUserEmail').value = currentRow.dataset.email || '';
					document.getElementById('editUserRole').value = currentRow.dataset.role || '2';
					document.getElementById('editUserPassword').value = '';
					openModal(editUserModal);
				}

				if (action === 'delete') {
					currentDeleteUserId = currentRow.dataset.userId || '';
					deleteUserName.textContent = currentRow.dataset.name || '';
					openModal(deleteUserModal);
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

		if (createUserModal) {
			createUserModal.addEventListener('click', (event) => {
				if (event.target === createUserModal) {
					closeModal(createUserModal);
				}
			});
		}

		[editUserModal, deleteUserModal].forEach((modalElement) => {
			if (!modalElement) {
				return;
			}

			modalElement.addEventListener('click', (event) => {
				if (event.target === modalElement) {
					closeModal(modalElement);
				}
			});
		});

		if (createUserForm) {
			createUserForm.addEventListener('submit', async (event) => { // ✅ thêm async
				event.preventDefault();

				const formData = new FormData(createUserForm);

				try {
					const response = await fetch(createUserForm.action, {
						method: 'POST',
						headers: {
							'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
							'Accept': 'application/json'
						},
						body: formData
					});

					const data = await response.json();

					if (response.ok) {
						alert('Tạo user thành công');
						createUserForm.reset();
						closeModal(createUserModal);

						// TODO: reload table hoặc append row
						setTimeout(() => {
							window.location.reload();
						}, 3000);
					} else {
						console.log(data);
						alert('Có lỗi xảy ra');
					}

				} catch (error) {
					console.error(error);
					alert('Lỗi server');
				}

				createUserForm.reset();          
				closeModal(createUserModal);     
			});
}

		if (editUserForm) {
			editUserForm.addEventListener('submit', async (event) => {
				event.preventDefault();

				const formData = new FormData(editUserForm);
				const userId = document.getElementById('editUserId').value;

				try {
					const response = await fetch(`/admin/users/${userId}`, {
						method: 'POST', // Laravel thường dùng POST + _method=PUT
						headers: {
							'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
							'Accept': 'application/json'
						},
						body: formData
					});

					const data = await response.json();

					if (response.ok) {
						alert('Cập nhật user thành công');

						closeModal(editUserModal);

						// 👉 update lại UI luôn (không cần reload)
						const row = document.querySelector(`tr[data-user-id="${userId}"]`);
						if (row) {
							row.dataset.name = formData.get('name');
							row.dataset.email = formData.get('email');
							row.dataset.role = formData.get('role');

							row.children[0].textContent = formData.get('name');
							row.children[1].textContent = formData.get('email');

							// update role label
							const roleCell = row.children[2];
							if (formData.get('role') == 1) {
								roleCell.innerHTML = `<span class="rounded-full bg-indigo-100 px-2 py-1 text-xs font-medium text-indigo-700">Admin</span>`;
							} else {
								roleCell.innerHTML = `<span class="rounded-full bg-amber-100 px-2 py-1 text-xs font-medium text-amber-700">Supporter</span>`;
							}
						}

					} else {
						console.log(data);
						alert('Có lỗi xảy ra');
					}

				} catch (error) {
					console.error(error);
					alert('Lỗi server');
				}
			});
		}

		if (confirmDeleteUserBtn) {
			confirmDeleteUserBtn.addEventListener('click', async () => {
				if (!currentDeleteUserId) {
					return;
				}

				try {
					const response = await fetch(`/admin/users/${currentDeleteUserId}`, {
						method: 'DELETE',
						headers: {
							'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
							'Accept': 'application/json'
						}
					});

					const data = await response.json();

					if (response.ok) {
						alert('Xóa user thành công');

						const row = document.querySelector(`tr[data-user-id="${currentDeleteUserId}"]`);
						if (row) {
							row.remove();
						}

						currentDeleteUserId = '';
						deleteUserName.textContent = '';
						closeModal(deleteUserModal);
					} else {
						console.log(data);
						alert('Có lỗi xảy ra');
					}
				} catch (error) {
					console.error(error);
					alert('Lỗi server');
				}
			});
		}
	</script>
    @endsection
@endsection
