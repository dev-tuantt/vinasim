@extends('client.layout')

@section('title', 'myLocal.vn - SIM so dep')
@section('meta_title', 'myLocal.vn - SIM so dep')
@section('meta_description', 'Tong hop cac SIM so dep dang kinh doanh tai myLocal.vn, cap nhat gia va thong tin moi nhat tu database.')
@section('meta_keywords', 'sim so dep, sim vip, sim phong thuy, myLocal')

@section('content')
	<section class="relative overflow-hidden bg-[#F4F5F7] py-14 md:py-20" aria-label="Tong hop sim so dep">
		<div class="container-main mx-auto px-4">
			<div class="mx-auto grid max-w-6xl grid-cols-1 items-center gap-8 lg:grid-cols-[420px_1fr] lg:gap-10">
				<div class="relative mx-auto w-full max-w-[420px] overflow-hidden rounded-[20px] bg-[#F5314B] shadow-[0_20px_45px_rgba(0,0,0,0.12)]">
					<img
						src="{{ asset('images/home-sim-so-dep.jpg') }}"
						alt="Tong hop sim so dep myLocal"
						class="h-[420px] w-full object-cover object-center sm:h-[500px]"
						onerror="this.onerror=null;this.src='{{ asset('images/home-banner.jpg') }}';"
					>
				</div>

				<div class="text-center lg:text-left">
					<p class="text-sm font-bold uppercase tracking-[0.24em] text-[#F5314B]">myLocal.vn</p>
					<h1 class="mt-4 text-4xl font-extrabold leading-tight text-black sm:text-5xl">
						Kho <span class="text-[#F5314B]">SIM so dep</span><br>
						cap nhat tu database
					</h1>
					<p class="mt-6 max-w-xl text-lg leading-relaxed text-gray-700">
						Danh sach SIM so dep dang kinh doanh duoc lay truc tiep tu du lieu san pham, phu hop nhu cau hotline, kinh doanh va phong thuy ca nhan.
					</p>
					<a
						href="{{ url('/') }}"
						class="mt-8 inline-flex items-center justify-center rounded-full bg-[#0B4AA7] px-8 py-3 text-base font-extrabold uppercase tracking-wide text-white transition hover:bg-[#083a83]"
					>
						Ve trang chu
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-white py-14 md:py-20" aria-label="Danh sach sim so dep">
		<div class="container-main mx-auto px-4">
			<div class="mx-auto max-w-[1100px]">
				<div class="mb-8 flex items-end justify-between gap-4">
					<div>
						<p class="text-sm font-bold uppercase tracking-[0.16em] text-[#F5314B]">Tu database san pham</p>
						<h2 class="mt-2 text-3xl font-extrabold uppercase tracking-wide text-slate-900 md:text-4xl">Tat ca sim so dep</h2>
					</div>
					<a href="{{ route('data-packages') }}" class="hidden text-sm font-bold uppercase tracking-wide text-slate-600 hover:text-[#F5314B] md:inline-block">
						Xem goi cuoc data
					</a>
				</div>

				<div class="grid grid-cols-1 gap-5 md:grid-cols-2">
					@forelse ($simProducts as $sim)
						<article class="rounded-3xl border border-slate-200 bg-gradient-to-br from-white via-white to-slate-50 p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
							<div class="flex items-start justify-between gap-4">
								<div>
									<p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-500">{{ $sim['line_1'] }}</p>
									<h3 class="mt-3 text-3xl font-extrabold tracking-wide text-slate-900 sm:text-4xl">{{ $sim['number'] }}</h3>
									<p class="mt-2 text-sm font-semibold uppercase tracking-wide text-slate-500">{{ $sim['line_2'] }}</p>
								</div>
								@if (!empty($sim['image']))
									<img src="{{ $sim['image'] }}" alt="{{ $sim['name'] }}" class="hidden h-20 w-20 rounded-2xl object-cover object-center md:block">
								@endif
							</div>

							@if (!empty($sim['description']))
								<p class="mt-4 text-sm leading-relaxed text-slate-600">{{ $sim['description'] }}</p>
							@endif

							<div class="mt-5 flex items-end justify-between gap-4">
								<div>
									<p class="text-3xl font-extrabold text-[#F5314B]">{{ number_format($sim['price'], 0, ',', '.') }}d</p>
									@if (!empty($sim['old_price']))
										<p class="mt-1 text-base font-bold text-slate-400 line-through">{{ number_format($sim['old_price'], 0, ',', '.') }}d</p>
									@endif
								</div>
								<a href="#" class="inline-flex items-center rounded-full bg-[#F5314B] px-5 py-2.5 text-sm font-bold uppercase tracking-wide text-white transition hover:bg-[#dc1e3c]">
									Chon sim nay
								</a>
							</div>
						</article>
					@empty
						<div class="md:col-span-2 rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-10 text-center text-slate-600">
							Chua co du lieu SIM so dep. Vui long them san pham category "Sim so dep" trong trang quan tri.
						</div>
					@endforelse
				</div>
			</div>
		</div>
	</section>
@endsection