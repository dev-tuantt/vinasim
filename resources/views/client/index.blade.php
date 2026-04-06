@extends('client.layout')

@section('title', 'myLocal.vn - Trang chu')

@section('home_banner')
	<section class="relative overflow-hidden bg-[#0B4AA7]" aria-label="Banner trang chu">
		<img
			src="{{ $homeBannerUrl ?: asset('images/home-banner.jpg') }}"
			alt="Banner myLocal doi qua san sang"
			class="h-[240px] w-full object-cover object-center md:h-[360px] lg:h-[520px]"
			onerror="this.remove()"
		>
		<div class="absolute inset-0 bg-gradient-to-r from-[#0B4AA7]/75 via-[#0B4AA7]/30 to-transparent"></div>
		<div class="container-main relative mx-auto px-4">
			<div class="absolute left-4 top-1/2 max-w-xl -translate-y-1/2 text-white md:left-8">
				<p class="mb-2 text-sm font-semibold uppercase tracking-wide text-sky-100 md:text-base">myLocal.vn</p>
				<h1 class="text-2xl font-extrabold leading-tight md:text-4xl lg:text-5xl">Doi qua de dang, san sang vi vu</h1>
				<p class="mt-3 text-sm text-sky-100 md:text-base">Kham pha uu dai eSIM, SIM data va cac chuong trinh khuyen mai moi nhat.</p>
			</div>
		</div>
	</section>
@endsection

@section('content')
	<section class="bg-[#E5E7EB] py-12 md:py-16" aria-label="Khoi sim so dep">
		<div class="container-main mx-auto px-4">
			<div class="mx-auto grid max-w-5xl grid-cols-1 items-center gap-8 lg:grid-cols-[420px_1fr] lg:gap-10">
				<div class="relative mx-auto w-full max-w-[420px] overflow-hidden rounded-[20px] bg-[#F5314B] shadow-[0_20px_45px_rgba(0,0,0,0.12)]">
					<img
						src="{{ asset('images/home-sim-so-dep.jpg') }}"
						alt="Sim so dep gia sieu me danh rieng ban"
						class="h-[420px] w-full object-cover object-center sm:h-[500px]"
						onerror="this.onerror=null;this.src='{{ asset('images/home-banner.jpg') }}';"
					>
				</div>

				<div class="text-center lg:text-left">
					<h2 class="text-4xl font-extrabold leading-tight text-black sm:text-5xl">
						Sim so dep<br>
						<span class="text-[#F5314B]">Gia sieu me</span><br>
						<span class="text-gray-500">Danh rieng ban</span>
					</h2>
					<p class="mt-6 max-w-xl text-lg leading-relaxed text-gray-900">
						O day co SIM so dep phat tai phat loc! Chon so doc ban cho rieng minh voi he thong phan tich than so hoc
						va phong thuy giup ban but pha moi gioi han - thang hang cuoc song!
					</p>
					<a
						href="{{ route('sim-numbers') }}"
						class="mt-8 inline-flex items-center justify-center rounded-full bg-[#F5314B] px-8 py-3 text-base font-extrabold uppercase tracking-wide text-white transition hover:bg-[#dc1e3c]"
					>
						Chon so dep
					</a>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-[#E5E7EB] pb-14 md:pb-20" aria-label="Kho sim so dep">
		<div class="container-main mx-auto px-4">
			<div class="mx-auto grid max-w-6xl grid-cols-1 items-center gap-8 lg:grid-cols-[360px_1fr] lg:gap-10 xl:max-w-[1100px]">
				<div class="relative mx-auto w-full max-w-[360px]">
					<img
						src="{{ asset('images/home-kho-sim-so-dep.png') }}"
						alt="Kho sim so dep"
						class="w-full object-contain"
						onerror="this.onerror=null;this.src='{{ asset('images/home-sim-so-dep.jpg') }}';"
					>
				</div>

				<div>
					<h2 class="text-center text-3xl font-extrabold uppercase tracking-wide text-slate-900 md:text-5xl">Kho sim so dep</h2>

					<div class="mt-7 grid grid-cols-1 gap-4 md:grid-cols-2">
						@forelse ($simProducts as $sim)
							<article class="rounded-2xl border border-slate-200 bg-white px-5 py-4 shadow-sm">
								<div class="flex items-start justify-between gap-3">
									<div>
										<h3 class="text-[36px] leading-none font-extrabold tracking-wide text-slate-900">{{ $sim['number'] }}</h3>
										<p class="mt-2 text-sm font-medium text-slate-600">{{ $sim['line_1'] }}</p>
										<p class="text-sm font-semibold text-slate-500">{{ $sim['line_2'] }}</p>
									</div>
									<div class="pt-1 text-right">
										<p class="text-4xl font-extrabold text-[#F5314B]">{{ number_format($sim['price'], 0, ',', '.') }}d</p>
										@if (!empty($sim['old_price']))
											<p class="mt-1 text-lg font-bold text-slate-400 line-through">{{ number_format($sim['old_price'], 0, ',', '.') }}d</p>
										@endif
									</div>
								</div>
							</article>
						@empty
							<div class="md:col-span-2 rounded-2xl border border-dashed border-slate-300 bg-white/70 px-5 py-10 text-center text-base text-slate-600">
								Chua co du lieu SIM so dep. Vui long them san pham category "Sim so dep" trong trang quan tri.
							</div>
						@endforelse
					</div>

					<div class="mt-8 text-center">
						<a
							href="{{ route('sim-numbers') }}"
							class="inline-flex items-center justify-center rounded-full bg-[#F5314B] px-10 py-3 text-lg font-extrabold uppercase tracking-wide text-white transition hover:bg-[#dc1e3c]"
						>
							Tim so dep
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-white py-14 md:py-20" aria-label="Thong tin goi cuoc">
		<div class="container-main mx-auto px-4">
			<div class="mx-auto max-w-[1100px]">
				<div class="mb-8 flex items-end justify-between gap-4">
					<div>
						<p class="text-sm font-bold uppercase tracking-[0.16em] text-[#F5314B]">myLocal.vn</p>
						<h2 class="mt-2 text-3xl font-extrabold uppercase tracking-wide text-slate-900 md:text-4xl">Thong tin goi cuoc</h2>
					</div>
					<a href="{{ route('data-packages') }}" class="hidden text-sm font-bold uppercase tracking-wide text-slate-600 hover:text-[#F5314B] md:inline-block">
						Xem tat ca goi cuoc
					</a>
				</div>

				<div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
					@forelse ($homePackages as $package)
						<article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
							<div class="relative h-48 w-full bg-slate-100">
								@if (!empty($package['image']))
									<img src="{{ $package['image'] }}" alt="{{ $package['name'] }}" class="h-full w-full object-cover object-center">
								@else
									<img src="{{ asset('images/home-banner.jpg') }}" alt="{{ $package['name'] }}" class="h-full w-full object-cover object-center">
								@endif
							</div>

							<div class="p-5">
								<p class="text-xs font-bold uppercase tracking-wide text-slate-500">
									{{ !empty($package['data']) ? $package['data'] : 'Goi cuoc uu dai' }}
								</p>
								<h3 class="mt-2 line-clamp-2 text-xl font-extrabold leading-tight text-slate-900">{{ $package['name'] }}</h3>
								<p class="mt-3 text-sm font-semibold uppercase tracking-wide text-slate-500">{{ !empty($package['duration']) ? $package['duration'] : 'Ky han linh hoat' }}</p>
								<p class="mt-3 line-clamp-3 text-sm leading-relaxed text-slate-600">{{ !empty($package['description']) ? $package['description'] : 'Goi cuoc data toc do cao, phu hop cho nhu cau su dung hang ngay.' }}</p>
								<p class="mt-4 text-2xl font-extrabold text-[#F5314B]">{{ number_format($package['price'], 0, ',', '.') }}d</p>
								<a href="#" class="mt-4 inline-flex items-center text-sm font-bold uppercase tracking-wide text-[#F5314B] hover:text-[#dc1e3c]">
									Dang ky ngay
								</a>
							</div>
						</article>
					@empty
						<div class="md:col-span-2 lg:col-span-3 rounded-2xl border border-dashed border-slate-300 bg-slate-50 px-6 py-10 text-center text-slate-600">
							Chua co du lieu goi cuoc 4G/5G. Vui long them san pham category "Goi cuoc 4G/5G" trong trang quan tri.
						</div>
					@endforelse
				</div>
			</div>
		</div>
	</section>
@endsection
