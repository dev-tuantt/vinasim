<!doctype html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="@yield('meta_description', 'myLocal.vn - eSIM du lich quoc te, SIM so dep, SIM Sieu Data va uu dai hap dan.')">
	<meta name="keywords" content="@yield('meta_keywords', 'eSIM, SIM du lich, SIM so dep, SIM data, myLocal')">
	<meta name="robots" content="index,follow">
	<meta property="og:type" content="website">
	<meta property="og:title" content="@yield('meta_title', 'myLocal.vn - eSIM va SIM uu dai')">
	<meta property="og:description" content="@yield('meta_description', 'myLocal.vn - eSIM du lich quoc te, SIM so dep, SIM Sieu Data va uu dai hap dan.')">
	<meta property="og:image" content="@yield('meta_image', asset('images/home-banner.jpg'))">
	<meta property="og:url" content="{{ url()->current() }}">
	<meta name="twitter:card" content="summary_large_image">
	<link rel="canonical" href="{{ url()->current() }}">
	<title>@yield('title', 'myLocal.vn - eSIM va SIM uu dai')</title>

	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					colors: {
						brandBlue: '#154AA8',
						brandRed: '#EE2737',
						brandText: '#1F2937'
					},
					boxShadow: {
						nav: '0 4px 18px rgba(0, 0, 0, 0.06)'
					}
				}
			}
		}
	</script>
	<style>
		.container-main {
			max-width: 1280px;
		}
	</style>
	@stack('head')
</head>
<body class="bg-white text-brandText antialiased">
	<a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-50 focus:rounded focus:bg-black focus:px-3 focus:py-2 focus:text-white">
		Bo qua den noi dung chinh
	</a>

	<header class="sticky top-0 z-40 bg-white">
		<div class="bg-brandBlue text-white text-xs md:text-sm">
			<div class="container-main mx-auto flex items-center justify-center px-4 py-2 text-center">
				<span class="font-medium">Tan huong nhieu uu dai - </span>
				<a href="#" class="ml-1 font-semibold text-yellow-300 underline underline-offset-2">Tai app myLocal.vn ngay</a>
				<span class="ml-1">!</span>
			</div>
		</div>

		<div class="border-b border-gray-100 bg-white shadow-nav">
			<div class="container-main mx-auto flex items-center justify-between gap-3 px-4 py-3 md:py-4">
				<a href="{{ url('/') }}" class="inline-flex items-center" aria-label="Trang chu myLocal.vn">
					<img src="{{ asset('images/logo-local.svg') }}" alt="myLocal logo" class="h-8 w-auto md:h-9" onerror="this.style.display='none'">
					<span class="text-brandRed text-2xl font-extrabold tracking-tight">Local</span>
				</a>

				<button
					id="mobile-menu-button"
					type="button"
					class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-gray-200 text-gray-700 md:hidden"
					aria-controls="mobile-menu"
					aria-expanded="false"
				>
					<span class="sr-only">Mo menu</span>
					<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
						<path d="M4 7h16M4 12h16M4 17h16" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</button>

				<nav class="hidden items-center gap-8 md:flex" aria-label="Dieu huong chinh">
					<a href="{{ route('home') }}" class="text-sm font-semibold text-gray-800 transition hover:text-brandBlue">Trang chu</a>
					<a href="{{ route('data-packages') }}" class="text-sm font-semibold text-gray-800 transition hover:text-brandBlue">Goi cuoc data 4G-5G</a>
					<a href="{{ route('sim-numbers') }}" class="text-sm font-semibold text-gray-800 transition hover:text-brandBlue">Sim so dep</a>
					<a href="{{ route('order-tracking') }}" class="text-sm font-semibold text-gray-800 transition hover:text-brandBlue">Tra cuu don hang</a>
					<a href="{{ route('news') }}" class="text-sm font-semibold text-gray-800 transition hover:text-brandBlue">Tin tuc</a>
					<a href="{{ route('about') }}" class="text-sm font-semibold text-gray-800 transition hover:text-brandBlue">Ve chung toi</a>
				</nav>
			</div>

			<div id="mobile-menu" class="hidden border-t border-gray-100 bg-white px-4 py-3 md:hidden">
				<nav class="flex flex-col gap-3" aria-label="Dieu huong mobile">
					<a href="{{ route('home') }}" class="text-sm font-semibold text-gray-800">Trang chu</a>
					<a href="{{ route('data-packages') }}" class="text-sm font-semibold text-gray-800">Goi cuoc data 4G-5G</a>
					<a href="{{ route('sim-numbers') }}" class="text-sm font-semibold text-gray-800">Sim so dep</a>
					<a href="{{ route('order-tracking') }}" class="text-sm font-semibold text-gray-800">Tra cuu don hang</a>
					<a href="{{ route('news') }}" class="text-sm font-semibold text-gray-800">Tin tuc</a>
					<a href="{{ route('about') }}" class="text-sm font-semibold text-gray-800">Ve chung toi</a>
				</nav>
			</div>
		</div>
	</header>

	@yield('home_banner')

	<main id="main-content" class="min-h-[50vh]">
		@yield('content')
	</main>

	<footer class="mt-16 overflow-hidden bg-slate-950 text-slate-200">
		<div class="border-b border-white/10 bg-[linear-gradient(135deg,_rgba(21,74,168,0.28),_rgba(238,39,55,0.14))]">
			<div class="container-main mx-auto grid gap-6 px-4 py-8 md:grid-cols-[1.3fr_0.7fr] md:items-center">
				<div>
					<p class="text-xs font-bold uppercase tracking-[0.28em] text-sky-200">myLocal.vn</p>
					<h2 class="mt-3 text-2xl font-extrabold uppercase tracking-wide text-white md:text-3xl">Ket noi linh hoat cho moi nhu cau su dung</h2>
					<p class="mt-3 max-w-2xl text-sm leading-6 text-slate-200/85 md:text-base">
						Cung cap goi cuoc data, sim so dep va noi dung huu ich de nguoi dung de dang lua chon giai phap phu hop cho cong viec, kinh doanh va ket noi hang ngay.
					</p>
				</div>
				<div class="grid gap-3 sm:grid-cols-2 md:justify-self-end">
					<a href="{{ route('data-packages') }}" class="inline-flex items-center justify-center rounded-2xl bg-white px-5 py-3 text-sm font-bold uppercase tracking-wide text-brandBlue transition hover:bg-slate-100">
						Xem goi cuoc
					</a>
					<a href="{{ route('order-tracking') }}" class="inline-flex items-center justify-center rounded-2xl border border-white/20 px-5 py-3 text-sm font-bold uppercase tracking-wide text-white transition hover:border-white/40 hover:bg-white/5">
						Tra cuu don hang
					</a>
				</div>
			</div>
		</div>

		<div class="container-main mx-auto px-4 py-12">
			<div class="grid gap-10 lg:grid-cols-[1.15fr_0.85fr]">
				<div class="grid gap-10 md:grid-cols-2 xl:grid-cols-[1.15fr_0.85fr_0.85fr]">
					<div>
						<a href="{{ url('/') }}" class="inline-flex items-center gap-3" aria-label="myLocal">
							<img src="{{ asset('images/logo-local-footer.png') }}" alt="myLocal" class="h-14 w-auto" onerror="this.style.display='none'">
							<span class="text-2xl font-extrabold tracking-tight text-white">myLocal</span>
						</a>
						<p class="mt-4 max-w-md text-sm leading-6 text-slate-300">
							Nen tang ket noi va phan phoi san pham vien thong huong den su don gian, minh bach va de tiep can cho nguoi dung tai Viet Nam.
						</p>
						<div class="mt-5 flex flex-wrap gap-3 text-slate-300">
							<a href="#" aria-label="Facebook" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 transition hover:border-sky-300/40 hover:text-sky-200">
								<svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M22 12.07C22 6.5 17.52 2 12 2S2 6.5 2 12.07C2 17.1 5.66 21.27 10.44 22v-7.03H7.9V12.1h2.54V9.91c0-2.52 1.49-3.91 3.78-3.91 1.1 0 2.25.2 2.25.2v2.47h-1.27c-1.25 0-1.64.78-1.64 1.58v1.89h2.79l-.45 2.87h-2.34V22C18.34 21.27 22 17.1 22 12.07Z"/></svg>
							</a>
							<a href="#" aria-label="Youtube" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 transition hover:border-sky-300/40 hover:text-sky-200">
								<svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.2a2.95 2.95 0 0 0-2.07-2.1C19.57 3.6 12 3.6 12 3.6s-7.57 0-9.43.5A2.95 2.95 0 0 0 .5 6.2 30.9 30.9 0 0 0 0 12a30.9 30.9 0 0 0 .5 5.8 2.95 2.95 0 0 0 2.07 2.1c1.86.5 9.43.5 9.43.5s7.57 0 9.43-.5a2.95 2.95 0 0 0 2.07-2.1A30.9 30.9 0 0 0 24 12a30.9 30.9 0 0 0-.5-5.8ZM9.6 15.7V8.3l6.3 3.7-6.3 3.7Z"/></svg>
							</a>
							<a href="#" aria-label="Tiktok" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 transition hover:border-sky-300/40 hover:text-sky-200">
								<svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M16.6 3a5.3 5.3 0 0 0 1.6 3.6A5.4 5.4 0 0 0 21 8.1v3.3a8.7 8.7 0 0 1-4.4-1.2v6.5c0 3.2-2.6 5.8-5.8 5.8S5 19.9 5 16.7c0-3.2 2.6-5.8 5.8-5.8.3 0 .6 0 .9.1v3.4a2.7 2.7 0 0 0-.9-.1 2.4 2.4 0 1 0 2.4 2.4V3h3.4Z"/></svg>
							</a>
							<a href="#" aria-label="LinkedIn" class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-white/10 bg-white/5 transition hover:border-sky-300/40 hover:text-sky-200">
								<svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.94 8.5H3.56V20h3.38V8.5ZM5.25 3A1.96 1.96 0 1 0 5.3 6.9 1.96 1.96 0 0 0 5.25 3ZM20.44 13.67c0-3.48-1.86-5.1-4.34-5.1-2 0-2.9 1.1-3.4 1.87V8.5H9.34V20h3.37v-5.7c0-1.5.28-2.95 2.13-2.95 1.82 0 1.85 1.7 1.85 3.05V20h3.38v-6.33Z"/></svg>
							</a>
						</div>

						<div class="mt-6 rounded-3xl border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
							<p class="text-xs font-bold uppercase tracking-[0.2em] text-sky-200">Tai app myLocal</p>
							<p class="mt-2 text-sm leading-6 text-slate-300">
								Quet QR de cai dat ung dung, quan ly sim va dang ky goi cuoc nhanh hon tren dien thoai.
							</p>
							<div class="mt-4 flex items-start gap-3">
								<img src="{{ asset('images/qr-mylocal.png') }}" alt="QR myLocal" class="h-20 w-20 rounded-2xl bg-white p-1.5" onerror="this.style.display='none'">
								<div class="flex flex-col gap-2">
									<img src="{{ asset('images/app-store.png') }}" alt="Download on App Store" class="h-10 w-auto rounded-lg" onerror="this.style.display='none'">
									<img src="{{ asset('images/google-play.png') }}" alt="Get it on Google Play" class="h-10 w-auto rounded-lg" onerror="this.style.display='none'">
								</div>
							</div>
						</div>
					</div>

					<div>
						<h3 class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400">Dieu huong</h3>
						<ul class="mt-4 space-y-3 text-sm text-slate-300">
							<li><a href="{{ route('home') }}" class="transition hover:text-white">Trang chu</a></li>
							<li><a href="{{ route('data-packages') }}" class="transition hover:text-white">Goi cuoc data 4G-5G</a></li>
							<li><a href="{{ route('sim-numbers') }}" class="transition hover:text-white">Sim so dep</a></li>
							<li><a href="{{ route('order-tracking') }}" class="transition hover:text-white">Tra cuu don hang</a></li>
							<li><a href="{{ route('news') }}" class="transition hover:text-white">Tin tuc</a></li>
							<li><a href="{{ route('about') }}" class="transition hover:text-white">Ve chung toi</a></li>
						</ul>
					</div>

					<div>
						<h3 class="text-sm font-bold uppercase tracking-[0.2em] text-slate-400">Ho tro</h3>
						<ul class="mt-4 space-y-3 text-sm text-slate-300">
							<li><a href="#" class="transition hover:text-white">Huong dan dang ky thong tin</a></li>
							<li><a href="#" class="transition hover:text-white">Cau hoi thuong gap</a></li>
							<li><a href="#" class="transition hover:text-white">Phan hoi va gop y</a></li>
							<li><a href="#" class="transition hover:text-white">Chinh sach bao mat</a></li>
						</ul>
					</div>
				</div>

				<div class="space-y-6">
					<div class="rounded-[28px] border border-white/10 bg-white/[0.04] p-6 shadow-2xl shadow-black/10">
						<p class="text-xs font-bold uppercase tracking-[0.22em] text-sky-200">Thong tin doanh nghiep</p>
						<h3 class="mt-3 text-2xl font-extrabold uppercase leading-tight text-white">Cong ty Co phan Vien thong ASIM</h3>
						<div class="mt-5 space-y-4 text-sm leading-6 text-slate-300">
							<p>
								<strong class="block text-white">Tru so chinh</strong>
								So 18 Nguyen Van Mai, Quan Tan Binh, TP Ho Chi Minh
							</p>
							<p>
								<strong class="block text-white">Van phong Ha Noi</strong>
								Toa nha VPBank, So 05 Dien Bien Phu, Quan Ba Dinh, TP Ha Noi
							</p>
							<p>
								<strong class="block text-white">Nguoi phu trach noi dung</strong>
								Ong Tran Viet Hung, Pho Tong Giam Doc
							</p>
						</div>
					</div>

					<div class="grid gap-4 sm:grid-cols-2">
						<div class="rounded-3xl border border-white/10 bg-white/[0.04] p-5">
							<p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Lien he</p>
							<p class="mt-3 text-lg font-bold text-white">1900 1900</p>
							<p class="mt-1 text-sm text-slate-300">Nhanh 01 de gap bo phan cham soc khach hang</p>
						</div>
						<div class="rounded-3xl border border-white/10 bg-white/[0.04] p-5">
							<p class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400">Email</p>
							<p class="mt-3 break-all text-lg font-bold text-white">cskh@asimtelecom.vn</p>
							<p class="mt-1 text-sm text-slate-300">Ho tro thong tin san pham va dich vu</p>
						</div>
					</div>
				</div>
			</div>

			<div class="mt-10 flex flex-col gap-5 border-t border-white/10 pt-6 md:flex-row md:items-end md:justify-between">
				<div class="max-w-3xl">
					<p class="text-sm leading-6 text-slate-400">
						Giay phep thiet lap Trang Thong tin dien tu tong hop so 1211/GP-TTDT do So Van hoa va The thao TP Ho Chi Minh cap ngay 24/01/2026. Giay chung nhan dang ky kinh doanh so 0315981331 do So Ke hoach va Dau tu TP Ho Chi Minh cap lan dau ngay 24/10/2019, dang ky thay doi lan thu 11 ngay 03/06/2025.
					</p>
					<p class="mt-3 text-xs uppercase tracking-[0.16em] text-slate-500">&copy; {{ date('Y') }} ASIM Group. All rights reserved.</p>
				</div>
				<a href="#" class="inline-flex shrink-0 rounded-2xl border border-white/10 bg-white/5 px-4 py-3 transition hover:bg-white/10">
					<img src="{{ asset('images/bo-cong-thuong.png') }}" alt="Da thong bao Bo Cong Thuong" class="h-12 w-auto" onerror="this.style.display='none'">
				</a>
			</div>
		</div>
	</footer>

	<script>
		const menuButton = document.getElementById('mobile-menu-button');
		const mobileMenu = document.getElementById('mobile-menu');

		if (menuButton && mobileMenu) {
			menuButton.addEventListener('click', () => {
				const isHidden = mobileMenu.classList.toggle('hidden');
				menuButton.setAttribute('aria-expanded', String(!isHidden));
			});
		}
	</script>
	@stack('scripts')
</body>
</html>
