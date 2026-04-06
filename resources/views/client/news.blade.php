@extends('client.layout')

@section('title', 'myLocal.vn - Tin tuc')
@section('meta_title', 'myLocal.vn - Tin tuc')
@section('meta_description', 'Cap nhat tin tuc, chuong trinh uu dai va thong tin moi nhat tu myLocal.vn.')
@section('meta_keywords', 'tin tuc myLocal, uu dai, sim data, sim so dep')

@section('content')
	<section class="relative overflow-hidden bg-[#0f172a] py-16 text-white md:py-24" aria-label="Tin tuc myLocal">
		<div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(245,49,75,0.26),_transparent_35%)]"></div>
		<div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,_rgba(56,189,248,0.18),_transparent_30%)]"></div>
		<div class="container-main relative mx-auto px-4">
			<div class="mx-auto grid max-w-6xl gap-8 lg:grid-cols-[1.2fr_0.8fr] lg:items-end">
				<div>
					<p class="text-sm font-bold uppercase tracking-[0.26em] text-rose-200">myLocal.vn newsroom</p>
					<h1 class="mt-4 max-w-3xl text-4xl font-extrabold uppercase tracking-wide md:text-5xl lg:text-6xl">Tin tuc va uu dai moi nhat</h1>
					<p class="mt-5 max-w-2xl text-base leading-8 text-slate-200 md:text-lg">
						Cap nhat bai viet moi nhat tu he thong noi dung, sap xep theo thu tu gan nhat de nguoi dung theo doi nhanh cac thong bao va chuong trinh uu dai.
					</p>
				</div>
				<div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-1">
					<div class="rounded-[28px] border border-white/10 bg-white/10 p-5 backdrop-blur-sm">
						<p class="text-xs font-bold uppercase tracking-[0.18em] text-sky-100">Che do hien thi</p>
						<p class="mt-3 text-3xl font-extrabold text-white">6 tin / lan tai</p>
						<p class="mt-2 text-sm leading-6 text-slate-200">Danh sach tiep tuc duoc noi vao block hien tai khi bam xem them.</p>
					</div>
					<div class="rounded-[28px] border border-white/10 bg-white/10 p-5 backdrop-blur-sm">
						<p class="text-xs font-bold uppercase tracking-[0.18em] text-sky-100">Sap xep</p>
						<p class="mt-3 text-3xl font-extrabold text-white">Moi nhat truoc</p>
						<p class="mt-2 text-sm leading-6 text-slate-200">Du lieu lay truc tiep tu bang news voi dieu kien da publish.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-[linear-gradient(180deg,#f8fafc_0%,#ffffff_20%,#f8fafc_100%)] py-14 md:py-20" aria-label="Danh sach tin tuc">
		<div class="container-main mx-auto px-4">
			<div class="mx-auto max-w-[1180px]">
				<div class="mb-8 flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
					<div>
						<p class="text-sm font-bold uppercase tracking-[0.16em] text-[#F5314B]">Cap nhat moi nhat</p>
						<h2 class="mt-2 text-3xl font-extrabold uppercase tracking-wide text-slate-900 md:text-4xl">Bai viet va thong bao</h2>
						<p class="mt-3 max-w-2xl text-sm leading-7 text-slate-600 md:text-base">
							Trang nay hien thi 6 bai moi nhat moi lan va cho phep tai them lien tuc ma khong phai chuyen sang bo cuc khac.
						</p>
					</div>
					<a href="{{ route('home') }}" class="inline-flex items-center justify-center rounded-full border border-slate-300 px-5 py-2.5 text-sm font-bold uppercase tracking-wide text-slate-700 transition hover:border-[#F5314B] hover:text-[#F5314B]">
						Ve trang chu
					</a>
				</div>

				<div id="news-list" class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-3">
					@include('client.partials.news-cards', ['newsItems' => $newsItems])
				</div>

				@if ($newsItems->hasMorePages())
					<div class="mt-10 flex justify-center">
						<button
							id="load-more-news"
							type="button"
							class="inline-flex items-center justify-center rounded-full bg-[#F5314B] px-8 py-3 text-sm font-extrabold uppercase tracking-[0.18em] text-white transition hover:bg-[#dc1e3c] disabled:cursor-not-allowed disabled:bg-slate-300"
							data-next-page="{{ $newsItems->currentPage() + 1 }}"
							data-base-url="{{ route('news') }}"
						>
							Xem them
						</button>
					</div>
				@endif
			</div>
		</div>
	</section>
@endsection

@push('scripts')
	<script>
		const loadMoreNewsButton = document.getElementById('load-more-news');
		const newsList = document.getElementById('news-list');

		if (loadMoreNewsButton && newsList) {
			loadMoreNewsButton.addEventListener('click', async () => {
				const nextPage = loadMoreNewsButton.dataset.nextPage;
				const baseUrl = loadMoreNewsButton.dataset.baseUrl;

				if (!nextPage || !baseUrl) {
					return;
				}

				loadMoreNewsButton.disabled = true;
				loadMoreNewsButton.textContent = 'Dang tai...';

				try {
					const response = await fetch(`${baseUrl}?page=${nextPage}&load_more=1`, {
						headers: {
							'X-Requested-With': 'XMLHttpRequest',
							'Accept': 'application/json'
						}
					});

					if (!response.ok) {
						throw new Error('Khong the tai them tin tuc');
					}

					const payload = await response.json();
					newsList.insertAdjacentHTML('beforeend', payload.html || '');

					if (payload.hasMorePages) {
						loadMoreNewsButton.dataset.nextPage = String(payload.nextPage);
						loadMoreNewsButton.disabled = false;
						loadMoreNewsButton.textContent = 'Xem them';
					} else {
						loadMoreNewsButton.remove();
					}
				} catch (error) {
					loadMoreNewsButton.disabled = false;
					loadMoreNewsButton.textContent = 'Thu lai';
				}
			});
		}
	</script>
@endpush