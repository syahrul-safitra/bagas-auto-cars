<!DOCTYPE html>
<html lang="en" class="bg-slate-50">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | BagasAutoCar</title>
    @vite('resources/css/app.css')
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,700;0,800;1,800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="antialiased">
    <div class="flex min-h-screen items-center justify-center p-4">
        {{-- Container utama dengan lebar tetap --}}
        <div class="w-full max-w-[400px] animate-[fadeIn_0.5s_ease-out]">

            <div class="mb-10 text-center">
                <a href="/" class="text-3xl font-black italic tracking-tighter text-slate-800">
                    BAGASAUTO<span class="text-indigo-600">CAR</span>
                </a>
            </div>

            <div class="rounded-[3rem] bg-white p-8 md:p-10 shadow-2xl shadow-slate-200/60 border border-slate-100">
                <div class="mb-8">
                    <h2 class="text-2xl font-black uppercase italic tracking-tighter text-slate-800">
                        Login <span class="text-indigo-600">Account</span>
                    </h2>
                    <p class="text-[9px] font-bold uppercase tracking-widest text-slate-400 mt-1">Gunakan akun member
                        Anda</p>
                </div>

                <form action="{{ url('login') }}" method="POST" class="w-full space-y-5">
                    @csrf

                    <div class="w-full">
                        <label class="block px-1 mb-2">
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-500">Email
                                Address</span>
                        </label>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="w-full h-14 px-6 rounded-2xl bg-slate-50 font-bold focus:outline-none focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 border border-slate-200 transition-all @error('email') border-rose-500 @enderror"
                            placeholder="name@gmail.com">
                        @error('email')
                            <p class="px-1 mt-2 text-[10px] font-bold uppercase italic text-rose-500">{{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label class="block px-1 mb-2">
                            <span
                                class="text-[10px] font-black uppercase tracking-widest text-slate-500">Password</span>
                        </label>
                        <input type="password" name="password" required
                            class="w-full h-14 px-6 rounded-2xl bg-slate-50 font-bold focus:outline-none focus:ring-2 focus:ring-indigo-600/20 focus:border-indigo-600 border border-slate-200 transition-all"
                            placeholder="••••••••">
                    </div>

                    {{-- Spasi tambahan untuk estetika --}}
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full h-16 rounded-2xl bg-indigo-600 font-black uppercase tracking-widest text-white shadow-xl shadow-indigo-200 transition-all hover:bg-indigo-700 active:scale-[0.98]">
                            Masuk Sekarang
                        </button>
                    </div>
                </form>

                <div class="divider my-8 text-[10px] font-bold uppercase text-slate-200 px-4">Atau</div>

                <div class="text-center">
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                        Belum punya akun?
                        <a href="{{ url('register') }}"
                            class="text-indigo-600 hover:text-indigo-800 font-black ml-1">Daftar Member</a>
                    </p>
                </div>
            </div>

            <p class="mt-8 text-center text-[9px] font-bold uppercase tracking-widest text-slate-400">
                &copy; 2026 BagasAutoCar. High Quality Units Only.
            </p>
        </div>
    </div>
</body>

</html>
