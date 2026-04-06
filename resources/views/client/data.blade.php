@extends('client.layout')

@section('title', 'myLocal.vn - Goi cuoc data 4G/5G')
@section('meta_title', 'myLocal.vn - Goi cuoc data 4G/5G')
@section('meta_description', 'Tong hop cac goi cuoc data 4G/5G dang kinh doanh tai myLocal.vn, cap nhat gia va uu dai moi nhat.')
@section('meta_keywords', 'goi cuoc data 4G, goi cuoc 5G, sim sieu data, myLocal')

@section('content')
	<section class="relative overflow-hidden bg-[#0B4AA7] py-14 text-white md:py-20" aria-label="Tong hop goi cuoc data 4G 5G">
		<div class="absolute inset-0 bg-[radial-gradient(circle_at_top_right,_rgba(255,255,255,0.2),_transparent_40%)]"></div>
		<div class="container-main relative mx-auto px-4">
			<div class="mx-auto max-w-4xl text-center">
				<p class="text-sm font-bold uppercase tracking-[0.24em] text-sky-100">myLocal.vn</p>
				<h1 class="mt-4 text-4xl font-extrabold uppercase tracking-wide md:text-5xl">Goi cuoc data 4G/5G</h1>
				<p class="mt-4 text-base leading-relaxed text-sky-100 md:text-lg">
					Danh sach goi cuoc dang duoc cap nhat tu database, phu hop cho nhu cau hoc tap, lam viec va giai tri moi ngay.
				</p>
			</div>
		</div>
	</section>

	<section class="bg-white py-14 md:py-20" aria-label="Danh sach goi cuoc data">
		<div class="container-main mx-auto px-4">
			<div class="mx-auto max-w-[1100px]">
				<div class="mb-8 flex items-end justify-between gap-4">
					<div>
						<p class="text-sm font-bold uppercase tracking-[0.16em] text-[#F5314B]">Tu database san pham</p>
						<h2 class="mt-2 text-3xl font-extrabold uppercase tracking-wide text-slate-900 md:text-4xl">Tat ca goi cuoc data 4G/5G</h2>
					</div>
					<a href="{{ url('/') }}" class="hidden text-sm font-bold uppercase tracking-wide text-slate-600 hover:text-[#F5314B] md:inline-block">
						Ve trang chu
					</a>
				</div>

				<div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-3">
					@forelse ($packages as $package)
						<article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md">
							<div class="relative h-52 w-full bg-slate-100">
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