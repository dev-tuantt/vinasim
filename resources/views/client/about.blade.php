@extends('client.layout')

@section('title', 'myLocal.vn - Ve chung toi')
@section('meta_title', 'myLocal.vn - Ve chung toi')
@section('meta_description', 'Thong tin gioi thieu ve myLocal.vn va dinh huong cung cap san pham SIM, data va dich vu vien thong.')
@section('meta_keywords', 've chung toi, myLocal, SIM data, vien thong')

@section('content')
	<section class="relative overflow-hidden bg-[linear-gradient(135deg,#0b1f4d_0%,#154AA8_52%,#2f82ff_100%)] py-16 text-white md:py-24" aria-label="Ve chung toi">
		<div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.18),_transparent_30%)]"></div>
		<div class="absolute inset-0 bg-[radial-gradient(circle_at_bottom_right,_rgba(245,49,75,0.22),_transparent_28%)]"></div>
		<div class="container-main relative mx-auto px-4">
			<div class="mx-auto grid max-w-[1160px] gap-10 lg:grid-cols-[minmax(0,1fr)_360px] lg:items-end">
				<div>
					<p class="text-sm font-bold uppercase tracking-[0.24em] text-sky-100">About myLocal.vn</p>
					<h1 class="mt-4 max-w-4xl text-4xl font-extrabold uppercase tracking-wide md:text-5xl xl:text-6xl">Nen tang vien thong duoc xay de ban chon nhanh va dung nhu cau</h1>
					<p class="mt-6 max-w-3xl text-base leading-8 text-sky-100 md:text-lg">
						myLocal la khong gian ket noi giua san pham vien thong va trai nghiem mua hang ro rang. Chung toi xay dung he thong tap trung vao goi cuoc data 4G/5G, sim so dep va noi dung huong dan giup nguoi dung de dang ra quyet dinh hon.
					</p>
					<div class="mt-8 flex flex-wrap gap-4">
						<a href="{{ route('data-packages') }}" class="inline-flex items-center rounded-full bg-white px-6 py-3 text-sm font-bold uppercase tracking-[0.14em] text-[#154AA8] transition hover:bg-slate-100">
							Kham pha goi cuoc
						</a>
						<a href="{{ route('sim-numbers') }}" class="inline-flex items-center rounded-full border border-white/30 px-6 py-3 text-sm font-bold uppercase tracking-[0.14em] text-white transition hover:bg-white/10">
							Xem kho sim so dep
						</a>
					</div>
				</div>

				<div class="grid gap-4 rounded-[32px] border border-white/15 bg-white/10 p-5 backdrop-blur-sm md:grid-cols-3 lg:grid-cols-1">
					<div class="rounded-3xl bg-white/10 p-5">
						<p class="text-xs font-bold uppercase tracking-[0.18em] text-sky-100">Thanh lap</p>
						<p class="mt-3 text-3xl font-extrabold">2019</p>
						<p class="mt-2 text-sm leading-6 text-sky-100">Khoi dau voi dinh huong xay dung he sinh thai vien thong linh hoat cho nguoi dung so.</p>
					</div>
					<div class="rounded-3xl bg-white/10 p-5">
						<p class="text-xs font-bold uppercase tracking-[0.18em] text-sky-100">Trong tam</p>
						<p class="mt-3 text-3xl font-extrabold">02</p>
						<p class="mt-2 text-sm leading-6 text-sky-100">Hai nhom san pham chinh hien tai la goi data 4G/5G va sim so dep.</p>
					</div>
					<div class="rounded-3xl bg-white/10 p-5">
						<p class="text-xs font-bold uppercase tracking-[0.18em] text-sky-100">Muc tieu</p>
						<p class="mt-3 text-3xl font-extrabold">24/7</p>
						<p class="mt-2 text-sm leading-6 text-sky-100">Cap nhat noi dung, thong tin gia va san pham theo huong nhanh, ro va de theo doi.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-[linear-gradient(180deg,#f8fafc_0%,#ffffff_24%,#f8fafc_100%)] py-14 md:py-20" aria-label="Tam nhin va gia tri">
		<div class="container-main mx-auto px-4">
			<div class="mx-auto max-w-[1160px]">
				<div class="grid gap-6 lg:grid-cols-3">
					<article class="rounded-[32px] border border-slate-200 bg-white p-7 shadow-[0_18px_40px_rgba(15,23,42,0.06)]">
						<p class="text-sm font-bold uppercase tracking-[0.16em] text-[#F5314B]">Tam nhin</p>
						<h2 class="mt-4 text-2xl font-extrabold leading-tight text-slate-900">Bien vien thong thanh trai nghiem de hieu va de mua hon</h2>
						<p class="mt-4 text-sm leading-7 text-slate-600">
							Khach hang khong can doc qua nhieu lop thong tin. Moi goi cuoc, moi so sim va moi bai viet deu duoc trinh bay theo huong ro tinh nang, ro chi phi va ro gia tri su dung.
						</p>
					</article>

					<article class="rounded-[32px] border border-slate-200 bg-white p-7 shadow-[0_18px_40px_rgba(15,23,42,0.06)]">
						<p class="text-sm font-bold uppercase tracking-[0.16em] text-[#F5314B]">Su menh</p>
						<h2 class="mt-4 text-2xl font-extrabold leading-tight text-slate-900">Xay dung mot kenh ban hang va noi dung co the cap nhat nhanh tu du lieu</h2>
						<p class="mt-4 text-sm leading-7 text-slate-600">
							myLocal uu tien nen tang co the dong bo san pham, tin tuc va noi dung marketing tu he thong quan tri, giup van hanh gon va kiem soat thong tin de dang hon.
						</p>
					</article>

					<article class="rounded-[32px] border border-slate-200 bg-white p-7 shadow-[0_18px_40px_rgba(15,23,42,0.06)]">
						<p class="text-sm font-bold uppercase tracking-[0.16em] text-[#F5314B]">Gia tri cot loi</p>
						<h2 class="mt-4 text-2xl font-extrabold leading-tight text-slate-900">Minh bach, huu ich, co the hanh dong ngay</h2>
						<p class="mt-4 text-sm leading-7 text-slate-600">
							Thong tin tren he thong khong chi de xem. Chung toi thiet ke moi trang theo muc tieu giup nguoi dung nhanh chong tim thay thu phu hop va di tiep den hanh dong dang ky hoac lien he.
						</p>
					</article>
				</div>

				<div class="mt-8 grid gap-6 lg:grid-cols-[1.1fr_0.9fr]">
					<div class="rounded-[36px] bg-slate-900 px-7 py-8 text-white md:px-10 md:py-10">
						<p class="text-sm font-bold uppercase tracking-[0.18em] text-rose-200">Cau chuyen thuong hieu</p>
						<h2 class="mt-4 max-w-2xl text-3xl font-extrabold leading-tight md:text-4xl">Chung toi muon nguoi dung cam thay vien thong la mot lua chon de chu dong, khong phai mot quy trinh phuc tap</h2>
						<div class="mt-6 grid gap-5 md:grid-cols-2">
							<p class="text-sm leading-7 text-slate-200">
								Tu cach dat ten goi cuoc, cach mo ta san pham den cach xay dung noi dung, myLocal theo duoi tinh ro rang va de tiep can. Day la noi dung fake tam thoi, ban co the thay the bang thong tin thuong hieu that sau.
							</p>
							<p class="text-sm leading-7 text-slate-200">
								Trang Ve chung toi duoc xay de lam nen thong tin cho thuong hieu, dong thoi tao diem tin cay cho nguoi dung truoc khi chon mua sim, goi data hoac doc cac bai viet huong dan moi nhat.
							</p>
						</div>
					</div>

					<div class="rounded-[36px] border border-slate-200 bg-white p-7 md:p-8">
						<p class="text-sm font-bold uppercase tracking-[0.18em] text-[#F5314B]">Cot moc phat trien</p>
						<div class="mt-6 space-y-5">
							<div class="border-l-2 border-slate-200 pl-5">
								<p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">2019</p>
								<h3 class="mt-2 text-xl font-extrabold text-slate-900">Khoi dong nen tang</h3>
								<p class="mt-2 text-sm leading-7 text-slate-600">Hoan thien dinh huong thuong hieu va xay dung bo san pham vien thong tap trung vao nhu cau thuc te.</p>
							</div>
							<div class="border-l-2 border-slate-200 pl-5">
								<p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">2023</p>
								<h3 class="mt-2 text-xl font-extrabold text-slate-900">Mo rong he thong noi dung</h3>
								<p class="mt-2 text-sm leading-7 text-slate-600">Tang cuong cac bai viet huong dan, thong tin uu dai va noi dung giai thich san pham cho nguoi dung moi.</p>
							</div>
							<div class="border-l-2 border-[#F5314B] pl-5">
								<p class="text-xs font-bold uppercase tracking-[0.16em] text-[#F5314B]">2026</p>
								<h3 class="mt-2 text-xl font-extrabold text-slate-900">Dong bo giao dien client moi</h3>
								<p class="mt-2 text-sm leading-7 text-slate-600">Tap trung vao trang san pham, tin tuc va page gioi thieu de ho tro chuyen doi tot hon tren ca desktop va mobile.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="bg-white py-14 md:py-20" aria-label="Thong tin doanh nghiep va lien he">
		<div class="container-main mx-auto px-4">
			<div class="mx-auto grid max-w-[1160px] gap-6 lg:grid-cols-[0.95fr_1.05fr]">
				<div class="rounded-[36px] border border-slate-200 bg-slate-50 p-7 md:p-8">
					<p class="text-sm font-bold uppercase tracking-[0.18em] text-[#F5314B]">Thong tin doanh nghiep</p>
					<h2 class="mt-4 text-3xl font-extrabold text-slate-900">ASIM Group</h2>
					<p class="mt-4 text-sm leading-7 text-slate-600">
						Noi dung ben duoi dang la du lieu fake de ban co mot bo cuc page hoan chinh. Ban co the thay toan bo thong tin bang profile cong ty that, tam nhin, doi ngu hoac nang luc van hanh sau.
					</p>

					<div class="mt-6 space-y-4 text-sm leading-7 text-slate-700">
						<p><strong class="text-slate-900">Tru so:</strong> So 18 Nguyen Van Mai, Quan Tan Binh, TP Ho Chi Minh</p>
						<p><strong class="text-slate-900">Van phong HN:</strong> Toa nha VPBank, So 05 Dien Bien Phu, Quan Ba Dinh, TP Ha Noi</p>
						<p><strong class="text-slate-900">Hotline:</strong> 1900 1900 (Nhanh 01)</p>
						<p><strong class="text-slate-900">Email:</strong> cskh@asimtelecom.vn</p>
					</div>

					<div class="mt-8 grid grid-cols-2 gap-4">
						<div class="rounded-3xl bg-white p-5 shadow-sm">
							<p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">San pham</p>
							<p class="mt-2 text-3xl font-extrabold text-slate-900">120+</p>
							<p class="mt-2 text-sm leading-6 text-slate-600">Mau sim va goi cuoc dang duoc quan ly trong he thong.</p>
						</div>
						<div class="rounded-3xl bg-white p-5 shadow-sm">
							<p class="text-xs font-bold uppercase tracking-[0.16em] text-slate-500">Noi dung</p>
							<p class="mt-2 text-3xl font-extrabold text-slate-900">50+</p>
							<p class="mt-2 text-sm leading-6 text-slate-600">Bai viet huong dan va tin tuc ho tro nhan dien thuong hieu.</p>
						</div>
					</div>
				</div>

				<div class="rounded-[36px] bg-[linear-gradient(160deg,#fff1f2_0%,#ffffff_48%,#eff6ff_100%)] p-7 shadow-[0_18px_40px_rgba(15,23,42,0.05)] md:p-8">
					<p class="text-sm font-bold uppercase tracking-[0.18em] text-[#F5314B]">Nhan manh thuong hieu</p>
					<h2 class="mt-4 max-w-xl text-3xl font-extrabold leading-tight text-slate-900 md:text-4xl">Mot page gioi thieu khong chi noi ve cong ty, ma con giup nguoi dung hieu vi sao ho nen tin va chon ban</h2>
					<div class="mt-8 grid gap-4 md:grid-cols-2">
						<div class="rounded-3xl border border-white/70 bg-white/80 p-5 backdrop-blur-sm">
							<p class="text-base font-extrabold text-slate-900">01. Nen tang ro rang</p>
							<p class="mt-2 text-sm leading-7 text-slate-600">Uu tien bo cuc de doc, thiet ke sach va cac block noi dung co the chinh sua nhanh theo thong diep thuong hieu that.</p>
						</div>
						<div class="rounded-3xl border border-white/70 bg-white/80 p-5 backdrop-blur-sm">
							<p class="text-base font-extrabold text-slate-900">02. Co kha nang mo rong</p>
							<p class="mt-2 text-sm leading-7 text-slate-600">Ban co the them doi ngu, thanh tuu, doi tac, hinh anh van phong hoac cac chung nhan vao bo cuc nay sau ma khong phai lam lai tu dau.</p>
						</div>
						<div class="rounded-3xl border border-white/70 bg-white/80 p-5 backdrop-blur-sm">
							<p class="text-base font-extrabold text-slate-900">03. Dan duong tu nhien</p>
							<p class="mt-2 text-sm leading-7 text-slate-600">Nguoi dung co the di tiep sang trang goi cuoc, kho sim hoac tin tuc tu page nay ma khong bi dut mach hanh trinh.</p>
						</div>
						<div class="rounded-3xl border border-white/70 bg-white/80 p-5 backdrop-blur-sm">
							<p class="text-base font-extrabold text-slate-900">04. Thay noi dung de</p>
							<p class="mt-2 text-sm leading-7 text-slate-600">Toan bo noi dung hien tai la fake text, nen ban co the doi thanh profile cong ty, tam nhin, su menh va thong tin phap ly that ngay sau do.</p>
						</div>
					</div>

					<div class="mt-8 flex flex-wrap gap-4">
						<a href="{{ route('news') }}" class="inline-flex items-center rounded-full bg-[#F5314B] px-6 py-3 text-sm font-bold uppercase tracking-[0.14em] text-white transition hover:bg-[#dc1e3c]">
							Xem tin tuc moi nhat
						</a>
						<a href="{{ route('home') }}" class="inline-flex items-center rounded-full border border-slate-300 px-6 py-3 text-sm font-bold uppercase tracking-[0.14em] text-slate-800 transition hover:border-slate-400 hover:bg-white">
							Quay ve trang chu
						</a>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection