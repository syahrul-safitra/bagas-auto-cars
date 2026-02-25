<!DOCTYPE html>
<html lang="id" data-theme="light">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cari Mobil Impian | Bagas Auto Cars</title>
        <link href="https://cdn.jsdelivr.net/npm/daisyui@4.7.2/dist/full.min.css" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tailwindcss.com"></script>
        <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap"
            rel="stylesheet">
        <style>
            body {
                font-family: 'Plus Jakarta Sans', sans-serif;
            }
        </style>
    </head>

    <body class="bg-base-200">

        <nav class="navbar bg-base-100/90 border-base-200 sticky top-0 z-[100] border-b px-4 backdrop-blur-md lg:px-20">
            <div class="navbar-start">
                <a href="/"
                    class="text-primary text-xl font-extrabold uppercase italic tracking-tighter">BAGAS<span
                        class="text-neutral">AUTOCARS</span></a>
            </div>
            <div class="navbar-end">
                <button class="btn btn-ghost btn-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </div>
        </nav>

        <main class="mx-auto max-w-[1440px] p-4 lg:p-10">
            <div class="flex flex-col gap-8 lg:flex-row">

                <aside class="w-full space-y-6 lg:w-1/4">
                    <div class="card bg-base-100 border-base-300 sticky top-24 border p-6 shadow-sm">
                        <h2 class="mb-6 flex items-center gap-2 text-xl font-bold">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-primary h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                            </svg>
                            Filter Pencarian
                        </h2>

                        <div class="form-control mb-4">
                            <label class="label"><span class="label-text font-bold">Cari Model</span></label>
                            <input type="text" placeholder="Contoh: Civic, BMW..."
                                class="input input-bordered w-full" />
                        </div>

                        <div class="form-control mb-4">
                            <label class="label"><span class="label-text font-bold">Merek</span></label>
                            <select class="select select-bordered w-full text-gray-500">
                                <option disabled selected>Pilih Merek</option>
                                <option>BMW</option>
                                <option>Mercedes Benz</option>
                                <option>Porsche</option>
                                <option>Toyota</option>
                            </select>
                        </div>

                        <div class="form-control mb-4">
                            <label class="label">
                                <span class="label-text font-bold">Rentang Harga</span>
                            </label>
                            <input type="range" min="0" max="100" value="40"
                                class="range range-primary range-sm" />
                            <div class="mt-2 flex justify-between px-2 text-xs font-semibold">
                                <span>0</span>
                                <span>5M+</span>
                            </div>
                        </div>

                        <div class="form-control mb-6">
                            <label class="label"><span class="label-text font-bold">Tipe Body</span></label>
                            <div class="flex flex-wrap gap-2">
                                <button class="btn btn-outline btn-xs rounded-full">Sedan</button>
                                <button class="btn btn-primary btn-xs rounded-full text-white">SUV</button>
                                <button class="btn btn-outline btn-xs rounded-full">Coupe</button>
                                <button class="btn btn-outline btn-xs rounded-full">Sport</button>
                            </div>
                        </div>

                        <button class="btn btn-primary w-full font-bold uppercase italic">Terapkan Filter</button>
                    </div>
                </aside>

                <div class="w-full lg:w-3/4">
                    <div
                        class="bg-base-100 border-base-300 mb-8 flex flex-col items-center justify-between gap-4 rounded-2xl border p-4 shadow-sm md:flex-row">
                        <p class="font-medium">Menampilkan <span class="text-primary font-bold">12 Mobil</span> Terbaik
                        </p>
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-semibold">Urutkan:</span>
                            <select class="select select-sm select-ghost font-bold">
                                <option>Terbaru</option>
                                <option>Harga Terendah</option>
                                <option>Harga Tertinggi</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        <div class="card bg-base-100 border-base-300 group overflow-hidden border shadow-md">
                            <figure class="relative h-56 overflow-hidden">
                                <img src="https://images.pexels.com/photos/112460/pexels-photo-112460.jpeg?auto=compress&cs=tinysrgb&w=800"
                                    alt="Mobil"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                <div class="absolute left-4 top-4 flex gap-2">
                                    <span class="badge badge-primary font-bold">NEW</span>
                                    <span class="badge border-none bg-black/50 text-white backdrop-blur-md">SUV</span>
                                </div>
                            </figure>
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h2 class="card-title text-2xl font-bold uppercase italic tracking-tighter">
                                            Mercedes-AMG G63</h2>
                                        <p class="text-sm font-medium italic text-gray-400">NIK 2023 • 2.500 KM</p>
                                    </div>
                                </div>
                                <div
                                    class="bg-base-200 my-4 grid grid-cols-3 gap-2 rounded-xl p-3 text-center text-[10px] font-bold uppercase">
                                    <div>
                                        <p class="text-primary">Transmisi</p>
                                        <p>AT</p>
                                    </div>
                                    <div>
                                        <p class="text-primary">BBM</p>
                                        <p>Bensin</p>
                                    </div>
                                    <div>
                                        <p class="text-primary">Warna</p>
                                        <p>Black</p>
                                    </div>
                                </div>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="text-2xl font-black tracking-tighter">Rp 6.250M</span>
                                    <button class="btn btn-primary btn-sm rounded-lg font-bold italic">DETAIL</button>
                                </div>
                            </div>
                        </div>

                        <div class="card bg-base-100 border-base-300 group overflow-hidden border shadow-md">
                            <figure class="relative h-56 overflow-hidden">
                                <img src="https://images.pexels.com/photos/3311574/pexels-photo-3311574.jpeg?auto=compress&cs=tinysrgb&w=800"
                                    alt="Mobil"
                                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110" />
                                <div class="absolute left-4 top-4 flex gap-2">
                                    <span class="badge badge-secondary font-bold">USED</span>
                                    <span
                                        class="badge border-none bg-black/50 text-white backdrop-blur-md">Sedan</span>
                                </div>
                            </figure>
                            <div class="card-body">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h2 class="card-title text-2xl font-bold uppercase italic tracking-tighter">BMW
                                            530i Opulence</h2>
                                        <p class="text-sm font-medium italic text-gray-400">NIK 2021 • 15.000 KM</p>
                                    </div>
                                </div>
                                <div
                                    class="bg-base-200 my-4 grid grid-cols-3 gap-2 rounded-xl p-3 text-center text-[10px] font-bold uppercase">
                                    <div>
                                        <p class="text-primary">Transmisi</p>
                                        <p>AT</p>
                                    </div>
                                    <div>
                                        <p class="text-primary">BBM</p>
                                        <p>Bensin</p>
                                    </div>
                                    <div>
                                        <p class="text-primary">Warna</p>
                                        <p>White</p>
                                    </div>
                                </div>
                                <div class="mt-2 flex items-center justify-between">
                                    <span class="text-2xl font-black tracking-tighter">Rp 1.150M</span>
                                    <button class="btn btn-primary btn-sm rounded-lg font-bold italic">DETAIL</button>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="mt-12 flex justify-center">
                        <div class="join">
                            <button class="join-item btn">«</button>
                            <button class="join-item btn btn-primary">1</button>
                            <button class="join-item btn">2</button>
                            <button class="join-item btn">3</button>
                            <button class="join-item btn">»</button>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <footer class="bg-neutral text-neutral-content mt-20 p-10 text-center">
            <p class="font-bold uppercase italic">BAGAS AUTOCARS &copy; 2026 - All Rights Reserved</p>
        </footer>

    </body>

</html>
