@forelse ($newsItems as $news)
	<article class="group overflow-hidden rounded-[28px] border border-slate-200 bg-white shadow-[0_18px_40px_rgba(15,23,42,0.08)] transition duration-300 hover:-translate-y-1.5 hover:shadow-[0_24px_55px_rgba(15,23,42,0.14)]">
		<a href="{{ route('news.show', $news['slug']) }}" class="block">
			<div class="relative h-56 overflow-hidden bg-slate-100">
				@if (!empty($news['image']))
					<img src="{{ $news['image'] }}" alt="{{ $news['title'] }}" class="h-full w-full object-cover object-center transition duration-500 group-hover:scale-105">
				@else
					<img src="{{ asset('images/home-banner.jpg') }}" alt="{{ $news['title'] }}" class="h-full w-full object-cover object-center transition duration-500 group-hover:scale-105">
				@endif
				<div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-slate-950/55 via-slate-950/15 to-transparent"></div>
				<p class="absolute left-5 top-5 inline-flex rounded-full bg-white/90 px-3 py-1 text-xs font-extrabold uppercase tracking-[0.18em] text-[#F5314B] shadow-sm backdrop-blur">
					{{ !empty($news['published_at']) ? $news['published_at'] : 'Tin moi cap nhat' }}
				</p>
			</div>
		</a>

		<div class="p-6">
			<h3 class="text-xl font-extrabold leading-tight text-slate-900 transition group-hover:text-[#F5314B]">
				<a href="{{ route('news.show', $news['slug']) }}">{{ $news['title'] }}</a>
			</h3>
			<p class="mt-4 line-clamp-4 text-sm leading-7 text-slate-600">{{ $news['excerpt'] }}</p>
			<a href="{{ route('news.show', $news['slug']) }}" class="mt-5 inline-flex items-center text-sm font-extrabold uppercase tracking-[0.16em] text-[#F5314B] transition hover:text-[#dc1e3c]">
				Xem chi tiet
			</a>
		</div>
	</article>
@empty
	<div class="col-span-full rounded-[28px] border border-dashed border-slate-300 bg-white px-6 py-12 text-center text-slate-600 shadow-sm">
		Chua co bai viet nao duoc xuat ban. Vui long them bai viet trong trang quan tri.
	</div>
@endforelse