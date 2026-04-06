@extends('admin_layout')
@section('css')
<style>
		.sidebar-link { color: rgb(71 85 105); }
		.sidebar-link.active { background-color: rgb(79 70 229); color: #fff; box-shadow: 0 1px 2px rgba(15, 23, 42, 0.15); }
		.sidebar-link:not(.active):hover { background-color: rgb(238 242 255); color: rgb(67 56 202); }
	</style>
@endsection
@section('content')
<section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
					<h2 class="text-base font-semibold text-slate-900">Danh sách đơn hàng</h2>
					<p class="mt-1 text-sm text-slate-500">Supporter cập nhật trạng thái đơn hàng để khách tra cứu.</p>
				</section>
				<section class="rounded-2xl border border-slate-100 bg-white p-5 shadow-sm">
					<div class="overflow-x-auto rounded-xl border border-slate-100">
						<table class="min-w-full text-left text-sm">
							<thead class="bg-slate-50 text-slate-600"><tr><th class="px-4 py-3">ID</th><th class="px-4 py-3">Tên khách hàng</th><th class="px-4 py-3">SĐT</th><th class="px-4 py-3">Email</th><th class="px-4 py-3">Sản phẩm (product_id)</th><th class="px-4 py-3">Chi tiết đơn (order_details)</th><th class="px-4 py-3">Trạng thái</th><th class="px-4 py-3">Thời gian tạo</th><th class="px-4 py-3">Cập nhật cuối</th><th class="px-4 py-3">Action</th></tr></thead>
							<tbody class="divide-y divide-slate-100 bg-white">
								@forelse ($orders as $order)
									@php
										$status = (int) ($order->status ?? 1);
										$statusLabel = $statusLabels[$status] ?? ($status . ' - Không xác định');
										$statusClass = $statusClasses[$status] ?? 'bg-slate-100 text-slate-700';
										$productDisplay = (string) $order->product_id;
										if (!empty($order->product_name)) {
											$productDisplay .= ' (' . $order->product_name . ')';
										}
									@endphp
									<tr data-order-id="{{ $order->id }}" data-status="{{ $status }}">
										<td class="px-4 py-3">{{ $order->id }}</td>
										<td class="px-4 py-3">{{ $order->customer_name }}</td>
										<td class="px-4 py-3">{{ $order->customer_phone }}</td>
										<td class="px-4 py-3">{{ $order->customer_email }}</td>
										<td class="px-4 py-3">{{ $productDisplay }}</td>
										<td class="px-4 py-3">{{ \Illuminate\Support\Str::limit((string) $order->order_details, 80) }}</td>
										<td class="px-4 py-3"><span class="rounded-full px-2 py-1 text-xs {{ $statusClass }}">{{ $statusLabel }}</span></td>
										<td class="px-4 py-3">{{ $order->created_at ? \Illuminate\Support\Carbon::parse($order->created_at)->format('Y-m-d H:i') : '' }}</td>
										<td class="px-4 py-3">{{ $order->updated_at ? \Illuminate\Support\Carbon::parse($order->updated_at)->format('Y-m-d H:i') : '' }}</td>
										<td class="px-4 py-3"><button type="button" class="update-status-btn rounded-lg border border-indigo-200 bg-indigo-50 px-3 py-1.5 text-xs font-medium text-indigo-700 transition hover:bg-indigo-100">Đổi trạng thái</button></td>
									</tr>
								@empty
									<tr>
										<td colspan="10" class="px-4 py-6 text-center text-sm text-slate-500">Chưa có dữ liệu đơn hàng</td>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</section>

	<div id="updateStatusModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/45 backdrop-blur-sm p-4">
		<div class="w-full max-w-md rounded-2xl border border-slate-100 bg-white p-5 shadow-2xl">
			<div class="mb-4 flex items-center justify-between">
				<h3 class="text-lg font-semibold text-slate-900">Cập nhật trạng thái đơn hàng</h3>
				<button type="button" data-close-modal="updateStatusModal" class="rounded-xl p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700">✕</button>
			</div>
			<form id="updateStatusForm" class="space-y-4">
				<div>
					<p class="text-sm text-slate-600">Đơn hàng ID: <span id="currentOrderId" class="font-semibold text-slate-900"></span></p>
				</div>
				<div>
					<label for="orderStatusSelect" class="mb-1 block text-sm font-medium text-slate-700">Chọn trạng thái</label>
					<select id="orderStatusSelect" class="w-full rounded-xl border border-slate-200 bg-white px-3 py-2 text-sm">
						<option value="1">1 - Chờ xử lý</option>
						<option value="2">2 - Đang xử lý</option>
						<option value="3">3 - Đã xử lý</option>
						<option value="4">4 - Hoàn thành</option>
					</select>
				</div>
				<div class="flex justify-end gap-2">
					<button type="button" data-close-modal="updateStatusModal" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-medium text-slate-700">Cancel</button>
					<button type="submit" class="rounded-xl bg-indigo-600 px-4 py-2 text-sm font-medium text-white">Xác nhận cập nhật</button>
				</div>
			</form>
		</div>
	</div>

    @section('script')
    <script>
		// const sidebar = document.getElementById('sidebar');
		// const overlay = document.getElementById('overlay');
		// const menuButton = document.getElementById('menuButton');
		const updateStatusModal = document.getElementById('updateStatusModal');
		const updateStatusForm = document.getElementById('updateStatusForm');
		const currentOrderId = document.getElementById('currentOrderId');
		const orderStatusSelect = document.getElementById('orderStatusSelect');
		let activeOrderRow = null;
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

		document.querySelectorAll('.update-status-btn').forEach((buttonElement) => {
			buttonElement.addEventListener('click', () => {
				activeOrderRow = buttonElement.closest('tr');
				if (!activeOrderRow) return;

				currentOrderId.textContent = activeOrderRow.dataset.orderId || '';
				orderStatusSelect.value = activeOrderRow.dataset.status || '1';
				openModal(updateStatusModal);
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

		updateStatusModal.addEventListener('click', (event) => {
			if (event.target === updateStatusModal) {
				closeModal(updateStatusModal);
			}
		});

		updateStatusForm.addEventListener('submit', (event) => {
			event.preventDefault();
			closeModal(updateStatusModal);
		});
	</script>
@endsection
@endsection
