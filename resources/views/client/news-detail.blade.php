@extends('client.layout')

@section('title', ($newsItem['title'] ?? 'Tin tuc myLocal') . ' - myLocal.vn')
@section('meta_title', ($newsItem['title'] ?? 'Tin tuc myLocal') . ' - myLocal.vn')
@section('meta_description', $newsItem['excerpt'] ?? 'Cap nhat thong tin moi nhat tu myLocal.vn.')
@section('meta_keywords', 'tin tuc myLocal, uu dai, sim data, sim so dep')

@section('content')
	<section class="relative overflow-hidden bg-[#0f172a] py-14 text-white md:py-20" aria-label="Chi tiet tin tuc">
		<div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(245,49,75,0.24),_transparent_32%)]"></div>
		<div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,_rgba(56,189,248,0.16),_transparent_28%)]"></div>
		<div class="container-main relative mx-auto px-4">
			<div class="mx-auto max-w-5xl">
				<div class="flex flex-wrap items-center gap-3 text-xs font-bold uppercase tracking-[0.18em] text-slate-200">
					<a href="{{ route('news') }}" class="transition hover:text-white">Tin tuc</a>
					<span>/</span>
					<span>{{ !empty($newsItem['published_at']) ? $newsItem['published_at'] : 'Moi cap nhat' }}</span>
				</div>
				<h1 class="mt-5 max-w-4xl text-4xl font-extrabold uppercase tracking-wide text-white md:text-5xl lg:text-6xl">{{ $newsItem['title'] }}</h1>
				<p class="mt-5 max-w-3xl text-base leading-8 text-slate-200 md:text-lg">
					{{ $newsItem['excerpt'] }}
				</p>
			</div>
		</div>
	</section>

	<section class="bg-[linear-gradient(180deg,#f8fafc_0%,#ffffff_18%,#f8fafc_100%)] py-14 md:py-20" aria-label="Noi dung bai viet">
		<div class="container-main mx-auto px-4">
			<div class="mx-auto grid max-w-6xl gap-10 lg:grid-cols-[minmax(0,1fr)_320px] lg:items-start">
				<article class="overflow-hidden rounded-[32px] border border-slate-200 bg-white shadow-[0_20px_50px_rgba(15,23,42,0.08)]">
					<div class="relative h-[260px] overflow-hidden bg-slate-100 md:h-[420px]">
						@if (!empty($newsItem['image']))
							<img src="{{ $newsItem['image'] }}" alt="{{ $newsItem['title'] }}" class="h-full w-full object-cover object-center">
						@else
							<img src="{{ asset('images/home-banner.jpg') }}" alt="{{ $newsItem['title'] }}" class="h-full w-full object-cover object-center">
						@endif
						<div class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-slate-950/55 via-slate-950/10 to-transparent"></div>
					</div>

					<div class="p-6 md:p-10">
						<div class="mb-8 flex flex-wrap items-center gap-3 border-b border-slate-200 pb-5 text-sm font-semibold uppercase tracking-[0.14em] text-slate-500">
							<span class="inline-flex rounded-full bg-rose-50 px-3 py-1 text-[#F5314B]">Tin da dang</span>
							@if (!empty($newsItem['published_at']))
								<span>{{ $newsItem['published_at'] }}</span>
							@endif
						</div>

						<div class="prose prose-slate max-w-none prose-headings:font-extrabold prose-headings:text-slate-900 prose-p:leading-8 prose-a:text-[#F5314B] prose-strong:text-slate-900">
							{!! $newsItem['content'] !== '' ? $newsItem['content'] : '<p>Noi dung dang duoc cap nhat.</p>' !!}
						</div>
					</div>
				</article>

				<aside class="space-y-5">
					<div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
						<p class="text-xs font-bold uppercase tracking-[0.18em] text-[#F5314B]">Dieu huong nhanh</p>
						<div class="mt-4 space-y-3">
						<a href="{{ route('home') }}" class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 text-sm font-bold text-slate-800 transition hover:bg-slate-100 hover:text-[#F5314B]">
                            <span>Ve trang chu</span>
                            <span>01</span>
                        </a>	
                        <a href="{{ route('news') }}" class="flex items-center justify-between rounded-2xl bg-slate-50 px-4 py-3 text-sm font-bold text-slate-800 transition hover:bg-slate-100 hover:text-[#F5314B]">
								<span>Quay lai danh sach tin</span>
								<span>02</span>
							</a>
							
						</div>
					</div>

					<div class="rounded-[28px] border border-slate-200 bg-white p-6 shadow-sm">
						<p class="text-xs font-bold uppercase tracking-[0.18em] text-[#F5314B]">Tin lien quan</p>
						<div class="mt-5 space-y-5">
							@forelse ($relatedNews as $relatedItem)
								<a href="{{ route('news.show', $relatedItem['slug']) }}" class="group block rounded-2xl bg-slate-50 p-4 transition hover:bg-slate-100">
									<p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">{{ !empty($relatedItem['published_at']) ? $relatedItem['published_at'] : 'Tin moi' }}</p>
									<h2 class="mt-2 text-base font-extrabold leading-6 text-slate-900 transition group-hover:text-[#F5314B]">{{ $relatedItem['title'] }}</h2>
									<p class="mt-2 line-clamp-3 text-sm leading-6 text-slate-600">{{ $relatedItem['excerpt'] }}</p>
								</a>
							@empty
								<div class="rounded-2xl border border-dashed border-slate-300 px-4 py-5 text-sm leading-6 text-slate-600">
									Chua co them bai viet lien quan nao.
								</div>
							@endforelse
						</div>
					</div>
				</aside>
			</div>
		</div>
	</section>
@endsection