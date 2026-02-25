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

        <div class="navbar bg-base-100/90 border-base-200 fixed top-0 z-[100] border-b px-4 backdrop-blur-md lg:px-20">
            <div class="navbar-start">
                <div class="dropdown">
                    <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </div>
                    <ul tabindex="0"
                        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 font-bold uppercase shadow">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">Tentang Kami</a></li>
                        <li><a href="#koleksi">Koleksi</a></li>
                        <li><a href="#lokasi">Lokasi</a></li>
                    </ul>
                </div>
                <a class="text-primary text-xl font-extrabold uppercase italic tracking-tighter">BAGAS<span
                        class="text-neutral">AUTOCARS</span></a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <ul class="menu menu-horizontal gap-4 px-1 text-xs font-semibold uppercase tracking-widest">
                    <li><a href="#home" class="hover:text-primary">Home</a></li>
                    <li><a href="#about" class="hover:text-primary">Tentang Kami</a></li>
                    <li><a href="#koleksi" class="hover:text-primary">Koleksi</a></li>
                    <li><a href="#lokasi" class="hover:text-primary">Lokasi</a></li>
                </ul>
            </div>
            <div class="navbar-end">
                <button
                    class="btn btn-primary btn-sm md:btn-md shadow-primary/20 rounded-full px-4 font-bold uppercase italic shadow-lg md:px-8">Hubungi
                    Kami</button>
            </div>
        </div>

        @yield("container")

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
