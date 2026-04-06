<!doctype html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-slate-100 text-slate-800 antialiased">
    <div class="mx-auto flex min-h-screen w-full max-w-6xl items-center justify-center p-4">
        <div class="grid w-full max-w-4xl overflow-hidden rounded-2xl bg-white shadow-xl md:grid-cols-2">
            <div class="hidden bg-indigo-600 p-10 text-white md:block">
                <h1 class="text-3xl font-bold">Admin Panel</h1>
                <p class="mt-4 text-sm text-indigo-100">Đăng nhập để truy cập khu vực quản trị hệ thống.</p>
            </div>

            <div class="p-6 sm:p-10">
                <h2 class="text-2xl font-semibold text-slate-900">Đăng nhập</h2>
                <p class="mt-2 text-sm text-slate-500">Sử dụng tài khoản quản trị của bạn.</p>

                @if ($errors->any())
                    <div class="mt-4 rounded-lg border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.submit') }}" method="POST" class="mt-6 space-y-4">
                    @csrf

                    <div>
                        <label for="email" class="mb-1 block text-sm font-medium text-slate-700">Email</label>
                        <input
                            id="email"
                            name="email"
                            type="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100"
                            placeholder="admin@example.com"
                        />
                    </div>

                    <div>
                        <label for="password" class="mb-1 block text-sm font-medium text-slate-700">Mật khẩu</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            required
                            class="w-full rounded-xl border border-slate-300 px-3 py-2.5 text-sm focus:border-indigo-400 focus:outline-none focus:ring-2 focus:ring-indigo-100"
                            placeholder="Nhập mật khẩu"
                        />
                    </div>

                    <label class="inline-flex items-center gap-2 text-sm text-slate-600">
                        <input type="checkbox" name="remember" value="1" class="h-4 w-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500" />
                        Ghi nhớ đăng nhập
                    </label>

                    <button
                        type="submit"
                        class="w-full rounded-xl bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-indigo-700"
                    >
                        Đăng nhập
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
