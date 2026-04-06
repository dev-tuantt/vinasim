@extends('client.layout')

@section('title', 'myLocal.vn - Tra cuu don hang')
@section('meta_title', 'myLocal.vn - Tra cuu don hang')
@section('meta_description', 'Tra cuu thong tin va trang thai don hang theo so dien thoai khach hang tai myLocal.vn.')
@section('meta_keywords', 'tra cuu don hang, don hang myLocal, tinh trang don hang')

@section('content')
	<section class="relative overflow-hidden bg-[linear-gradient(135deg,#0b1f4d_0%,#154AA8_52%,#2f82ff_100%)] py-16 text-white md:py-24" aria-label="Tra cuu don hang">
		<div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(255,255,255,0.18),_transparent_38%)]"></div>
		<div class="container-main relative mx-auto px-4">
			<div class="mx-auto max-w-5xl">
				<p class="text-sm font-bold uppercase tracking-[0.24em] text-sky-100">myLocal.vn</p>
				<div class="mt-6 grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
					<div>
						<h1 class="text-4xl font-extrabold uppercase tracking-wide md:text-5xl">Tra cuu don hang</h1>
						<p class="mt-4 max-w-2xl text-base leading-7 text-sky-100 md:text-lg">
							Nhap so dien thoai da dat hang de xem tinh trang xu ly, san pham da dang ky va thoi gian cap nhat moi nhat tu he thong.
						</p>
						<div class="mt-8 flex flex-wrap gap-3 text-sm text-sky-100">
							<span class="rounded-full border border-white/20 bg-white/10 px-4 py-2">Cap nhat trang thai theo database</span>
							<span class="rounded-full border border-white/20 bg-white/10 px-4 py-2">Tim kiem theo so dien thoai</span>
							<span class="rounded-full border border-white/20 bg-white/10 px-4 py-2">Hien thi lich su don hang</span>
						</div>
					</div>

					<div class="rounded-[32px] border border-white/15 bg-white/10 p-6 shadow-2xl shadow-slate-950/20 backdrop-blur-sm md:p-7">
						<p class="text-xs font-bold uppercase tracking-[0.22em] text-sky-100">Tim don hang</p>
						<form method="GET" action="{{ route('order-tracking') }}" class="mt-5 space-y-4">
							<div>
								<label for="phone" class="text-sm font-semibold text-white">So dien thoai khach hang</label>
								<input
									id="phone"
									name="phone"
									type="text"
									value="{{ $phone }}"
									placeholder="VD: 0901234567"
									class="mt-2 h-14 w-full rounded-2xl border border-white/15 bg-white px-4 text-base font-semibold text-slate-900 outline-none ring-0 placeholder:text-slate-400 focus:border-sky-300"
								>
							</div>
							<button type="submit" class="inline-flex w-full items-center justify-center rounded-2xl bg-brandRed px-5 py-4 text-sm font-bold uppercase tracking-wide text-white transition hover:bg-[#d61f33]">
								Tra cuu ngay
							</button>
						</form>
						<p class="mt-4 text-sm leading-6 text-sky-100">
							Neu can ho tro them, lien he tong dai 1900 1900 hoac email cskh@asimtelecom.vn.
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-[#F7F9FC] py-14 md:py-20" aria-label="Ket qua tra cuu don hang">
		<div class="container-main mx-auto px-4">
			<div class="mx-auto max-w-6xl">
				<div class="grid gap-6 lg:grid-cols-[0.72fr_1.28fr]">
					<div class="space-y-5">
						<div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
							<p class="text-xs font-bold uppercase tracking-[0.22em] text-[#F5314B]">Huong dan nhanh</p>
							<h2 class="mt-3 text-2xl font-extrabold uppercase tracking-wide text-brandBlue">Cach tra cuu</h2>
							<div class="mt-5 space-y-4 text-sm leading-7 text-slate-600">
								<p><strong class="text-slate-900">1.</strong> Nhap dung so dien thoai da dung khi dat hang hoac de lai thong tin.</p>
								<p><strong class="text-slate-900">2.</strong> He thong se hien thi tat ca don hang khop voi so dien thoai do, sap xep tu moi nhat den cu nhat.</p>
								<p><strong class="text-slate-900">3.</strong> Ban co the xem tinh trang xu ly, san pham da dang ky va lan cap nhat gan nhat cho tung don.</p>
							</div>
						</div>

						<div class="rounded-[28px] border border-slate-200 bg-white p-6 text-slate-200 shadow-sm">
							<p class="text-xs font-bold uppercase tracking-[0.22em] text-[#F5314B]">Trang thai don hang</p>
							<div class="mt-5 space-y-3 text-sm">
								<div class="flex items-center justify-between gap-3 rounded-2xl border border-white/10 bg-brandBlue px-4 py-3">
									<span>Cho xu ly</span>
									<span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-700">1</span>
								</div>
								<div class="flex items-center justify-between gap-3 rounded-2xl border border-white/10 bg-brandBlue px-4 py-3">
									<span>Dang xu ly</span>
									<span class="rounded-full bg-amber-100 px-3 py-1 text-xs font-bold text-amber-800">2</span>
								</div>
								<div class="flex items-center justify-between gap-3 rounded-2xl border border-white/10 bg-brandBlue px-4 py-3">
									<span>Da xu ly</span>
									<span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-bold text-indigo-800">3</span>
								</div>
								<div class="flex items-center justify-between gap-3 rounded-2xl border border-white/10 bg-brandBlue px-4 py-3">
									<span>Hoan thanh</span>
									<span class="rounded-full bg-emerald-100 px-3 py-1 text-xs font-bold text-emerald-800">4</span>
								</div>
							</div>
						</div>
					</div>

					<div>
						<div class="rounded-[32px] border border-slate-200 bg-white p-6 shadow-sm md:p-8">
							<div class="flex flex-col gap-3 border-b border-slate-200 pb-5 md:flex-row md:items-end md:justify-between">
								<div>
									<p class="text-xs font-bold uppercase tracking-[0.22em] text-[#F5314B]">Ket qua tra cuu</p>
									<h2 class="mt-2 text-3xl font-extrabold uppercase tracking-wide text-brandBlue">Thong tin don hang</h2>
								</div>
								@if ($searched && $phone !== '')
									<p class="text-sm font-semibold text-slate-500">So dien thoai: <span class="text-slate-900">{{ $phone }}</span></p>
								@endif
							</div>

							@if (! $searched)
								<div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-6 py-12 text-center">
									<p class="text-lg font-bold text-slate-900">Nhap so dien thoai de bat dau tra cuu</p>
									<p class="mt-3 text-sm leading-7 text-slate-600">
										He thong se lay danh sach don hang khop voi thong tin khach hang tu database va hien thi tinh trang xu ly moi nhat.
									</p>
								</div>
							@elseif (empty($orders))
								<div class="rounded-3xl border border-dashed border-slate-300 bg-slate-50 px-6 py-12 text-center">
									<p class="text-lg font-bold text-slate-900">Khong tim thay don hang phu hop</p>
									<p class="mt-3 text-sm leading-7 text-slate-600">
										Vui long kiem tra lai so dien thoai da dat hang, hoac lien he bo phan cham soc khach hang de duoc ho tro nhanh hon.
									</p>
								</div>
							@else
								<div class="mt-6 space-y-5">
									@foreach ($orders as $order)
										<article class="overflow-hidden rounded-[28px] border border-slate-200 bg-slate-50/60">
											<div class="flex flex-col gap-4 border-b border-slate-200 bg-white px-5 py-5 md:flex-row md:items-start md:justify-between md:px-6">
												<div>
													<p class="text-xs font-bold uppercase tracking-[0.18em] text-slate-500">Don hang #{{ $order['id'] }}</p>
													<h3 class="mt-2 text-xl font-extrabold text-brandBlue">{{ $order['product_name'] }}</h3>
													<p class="mt-2 text-sm leading-6 text-slate-600">Khach hang: <span class="font-semibold text-slate-900">{{ $order['customer_name'] }}</span></p>
												</div>
												<div class="flex flex-col items-start gap-3 md:items-end">
													<span class="inline-flex rounded-full px-3 py-1 text-xs font-bold uppercase tracking-wide {{ $order['status_class'] }}">{{ $order['status_label'] }}</span>
													<p class="text-sm text-slate-500">Cap nhat lan cuoi: <span class="font-semibold text-slate-900">{{ $order['updated_at'] }}</span></p>
												</div>
											</div>

											<div class="grid gap-5 px-5 py-5 md:grid-cols-[0.9fr_1.1fr] md:px-6">
												<div class="space-y-3 text-sm leading-7 text-slate-600">
													<p><strong class="text-slate-900">So dien thoai:</strong> {{ $order['customer_phone'] }}</p>
													@if ($order['customer_email'] !== '')
														<p><strong class="text-slate-900">Email:</strong> {{ $order['customer_email'] }}</p>
													@endif
													<p><strong class="text-slate-900">Ngay tao don:</strong> {{ $order['created_at'] }}</p>
												</div>

												<div>
													<p class="text-sm font-bold uppercase tracking-[0.18em] text-slate-500">Chi tiet don hang</p>
													@if (!empty($order['details']))
														<div class="mt-3 grid gap-3 sm:grid-cols-2">
															@foreach ($order['details'] as $label => $value)
																<div class="rounded-2xl border border-slate-200 bg-white px-4 py-3">
																	<p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-400">{{ str_replace('_', ' ', (string) $label) }}</p>
																	<p class="mt-2 text-sm font-semibold text-slate-900">{{ is_scalar($value) ? $value : json_encode($value, JSON_UNESCAPED_UNICODE) }}</p>
																</div>
															@endforeach
														</div>
													@else
														<div class="mt-3 rounded-2xl border border-dashed border-slate-300 bg-white px-4 py-4 text-sm leading-6 text-slate-600">
															Don hang chua co thong tin chi tiet bo sung. He thong hien dang luu san pham va trang thai xu ly don.
														</div>
													@endif
												</div>
											</div>
										</article>
									@endforeach
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection