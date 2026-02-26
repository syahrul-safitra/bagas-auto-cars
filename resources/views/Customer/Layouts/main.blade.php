<!DOCTYPE html>
<html lang="id" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bagas Auto Cars | Premium Car Showroom</title>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            scroll-behavior: smooth;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>

<body class="bg-base-100 text-neutral">

    <nav class="fixed top-0 z-[100] w-full border-b border-slate-100 bg-white/80 backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-6">
            <div class="flex h-20 items-center justify-between">

                <div class="flex shrink-0 items-center">
                    <a href="/" class="text-2xl font-black italic tracking-tighter text-slate-800">
                        BAGAS AUTO<span class="text-indigo-600">CAR</span>
                    </a>
                </div>

                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ url('search-cars') }}"
                        class="text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-indigo-600 transition-colors">
                        Cari Mobil
                    </a>
                    {{-- Tambahkan menu lain jika perlu --}}
                </div>

                <div class="flex items-center gap-4">

                    @if (auth()->guard('customer')->check())

                        @php
                            $user = auth()->guard('customer')->user();
                        @endphp

                        <div class="dropdown dropdown-end">
                            <label tabindex="0"
                                class="btn btn-ghost flex items-center gap-3 rounded-2xl px-4 hover:bg-slate-50">
                                <div class="text-right hidden sm:block">
                                    <p
                                        class="text-[10px] font-black uppercase tracking-tight text-slate-800 leading-none">
                                        {{ $user->name }}
                                    </p>
                                    <p class="text-[8px] font-bold uppercase text-indigo-500 tracking-widest mt-1">
                                        {{ 'Customer' }}
                                    </p>
                                </div>
                                <div
                                    class="h-10 w-10 overflow-hidden rounded-full bg-indigo-600 ring-2 ring-indigo-50 flex items-center justify-center">
                                    <span class="font-black text-white italic">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            </label>
                            <ul tabindex="0"
                                class="dropdown-content menu mt-4 w-52 rounded-[1.5rem] border border-slate-100 bg-white p-2 shadow-2xl shadow-slate-200/50">

                                <li>
                                    <a href="{{ url('profile') }}"
                                        class="rounded-xl py-3 text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">
                                        Profile Saya
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="/my-bookings"
                                        class="rounded-xl py-3 text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-indigo-50 hover:text-indigo-600">
                                        Booking Saya
                                    </a>
                                </li> --}}

                                <div class="divider my-1 opacity-50"></div>
                                <li>
                                    <form action="{{ url('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left rounded-xl py-3 text-[10px] font-black uppercase tracking-widest text-rose-500 hover:bg-rose-50">
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="flex items-center gap-2">
                            <a href="{{ url('login') }}"
                                class="btn btn-ghost rounded-2xl px-6 text-[10px] font-black uppercase tracking-widest text-slate-600 hover:bg-slate-50">
                                Login
                            </a>
                            <a href="{{ url('register') }}"
                                class="btn bg-indigo-600 hover:bg-indigo-700 border-none rounded-2xl px-6 text-[10px] font-black uppercase tracking-widest text-white shadow-lg shadow-indigo-100">
                                Register
                            </a>
                        </div>
                    @endauth
            </div>
        </div>
    </div>
</nav>

@yield('container')

<footer class="footer bg-neutral text-neutral-content rounded-t-[4rem] p-20">
    <aside>
        <a class="text-primary mb-4 text-4xl font-extrabold uppercase italic tracking-tighter">BAGAS
            AUTOCARS</a>
        <p>The Most Trusted Luxury Car Showroom in Jakarta.<br />Bringing You the Best Selection of Vehicles.
        </p>
    </aside>
    <nav>
        <h6 class="footer-title mb-4 font-bold text-white opacity-100">Layanan</h6>
        <a class="link link-hover italic">Katalog Mobil</a>
        <a class="link link-hover italic">Inspeksi Unit</a>
        <a class="link link-hover italic">Bantuan Kredit</a>
    </nav>
    <nav>
        <h6 class="footer-title mb-4 font-bold text-white opacity-100">Ikuti Kami</h6>
        <a class="link link-hover italic">Instagram</a>
        <a class="link link-hover italic">YouTube</a>
    </nav>
</footer>

</body>

</html>
