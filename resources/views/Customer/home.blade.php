@extends('Customer.Layouts.main')

@section('container')
    <div id="home" class="hero relative min-h-screen"
        style="background-image: url('https://images.pexels.com/photos/112460/pexels-photo-112460.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'); background-size: cover; background-position: center;">
        <div class="hero-overlay bg-black/60"></div>
        <div class="hero-content text-neutral-content flex w-full justify-start px-4 pt-20 text-left lg:px-20">
            <div class="max-w-2xl">
                <h1 class="mb-5 text-6xl font-extrabold uppercase italic leading-none tracking-tighter md:text-8xl">
                    Drive Your <br> <span class="text-primary italic">Legacy.</span>
                </h1>
                <p class="mb-10 max-w-lg text-lg font-light opacity-90 md:text-xl">
                    Showroom mobil mewah terpercaya di Indonesia. Kami menghadirkan unit eksklusif dengan kondisi
                    sempurna untuk gaya hidup Anda.
                </p>
                <div class="flex gap-4">
                    <a href="#koleksi"
                        class="btn btn-primary btn-lg rounded-xl border-none px-10 font-bold uppercase italic">Lihat
                        Stok</a>
                    <a href="#about"
                        class="btn btn-outline btn-lg rounded-xl border-white font-bold uppercase italic text-white">Tentang</a>
                </div>
            </div>
        </div>
    </div>

    <section id="about" class="bg-white px-4 py-24 lg:px-20">
        <div class="flex flex-col items-center gap-16 lg:flex-row">
            <div class="relative lg:w-1/2">
                <img src="https://images.pexels.com/photos/3802510/pexels-photo-3802510.jpeg?auto=compress&cs=tinysrgb&w=800"
                    class="h-[500px] w-full rounded-[3rem] object-cover shadow-2xl" alt="Showroom" />
                <div class="bg-primary absolute -bottom-6 -right-6 hidden rounded-3xl p-8 text-white shadow-xl md:block">
                    <p class="text-4xl font-black italic tracking-tighter">EST. 2024</p>
                    <p class="text-xs font-bold uppercase tracking-[0.2em]">Bagas Auto Cars</p>
                </div>
            </div>
            <div class="lg:w-1/2">
                <h2 class="text-primary mb-4 text-sm font-bold uppercase tracking-[0.4em]">Our Story</h2>
                <h3 class="text-neutral mb-8 text-5xl font-extrabold uppercase italic leading-tight tracking-tighter">
                    Bagas Auto Cars:<br>Definisi <span class="text-primary">Kemewahan.</span></h3>
                <p class="border-primary mb-8 border-l-4 pl-6 text-lg italic leading-relaxed text-gray-600">
                    "Kualitas bukan sekadar kata-kata bagi kami, melainkan standar hidup yang kami berikan pada
                    setiap kendaraan di showroom kami."
                </p>
                <p class="mb-8 leading-relaxed text-gray-500">
                    Kami memahami bahwa mobil mewah adalah representasi diri. Itulah mengapa Bagas Auto Cars hanya
                    memilih unit dengan riwayat terbaik, jarak tempuh rendah, dan kondisi layaknya baru keluar dari
                    pabrik.
                </p>
            </div>
        </div>
    </section>

    <section id="koleksi" class="bg-base-200 px-4 py-24 lg:px-20">
        <div class="mb-16 text-center">
            <h2 class="mb-4 text-4xl font-extrabold uppercase italic tracking-tighter">Unit Ready Stock</h2>
            <div class="bg-primary mx-auto h-1.5 w-20 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 gap-10 md:grid-cols-3">

            @foreach ($cars as $item)
                <div
                    class="card bg-base-100 border-base-300 overflow-hidden border shadow-xl transition-all duration-300 hover:-translate-y-2">
                    <figure>
                        <img src="{{ asset('uploads/thumbnails/' . $item->thumbnail) }}" alt="Supercar"
                            class="h-64 w-full object-cover" />
                    </figure>
                    <div class="card-body">
                        <h2 class="card-title font-black uppercase italic italic tracking-tighter">{{ $item->name }}</h2>
                        <p class="text-xs font-bold uppercase text-gray-400">{{ $item->year }} • {{ $item->mileage }} KM •
                            {{ $item->color }}</p>
                        <div class="divider my-2"></div>
                        <p class="text-primary text-2xl font-black tracking-tighter">Rp
                            {{ number_format($item->price, 0, ',', '.') }}</span></p>
                        <div class="card-actions mt-4">
                            <a href="{{ url('/detail-car/' . $item->slug) }}"
                                class="btn btn-primary w-full rounded-xl font-bold uppercase italic">Cek
                                Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>

    <section id="lokasi" class="bg-white px-4 py-24 lg:px-20">
        <div class="flex flex-col items-center gap-16 lg:flex-row">
            <div class="text-center lg:w-1/3 lg:text-left">
                <h3 class="mb-6 text-5xl font-extrabold uppercase italic tracking-tighter">Visit Our <br>Showroom
                </h3>
                <p class="mb-8 italic text-gray-500">Mampir dan rasakan langsung kemewahan armada kami. Kami siap
                    melayani test drive dengan perjanjian.</p>
                <div class="space-y-6">
                    <div class="flex items-center justify-center gap-4 italic lg:justify-start">
                        <div class="badge badge-primary p-4 font-bold">ALAMAT</div>
                        <p class="text-neutral font-bold">Gading Serpong, Tangerang</p>
                    </div>
                    <div class="flex items-center justify-center gap-4 italic lg:justify-start">
                        <div class="badge badge-primary p-4 font-bold">WHATSAPP</div>
                        <p class="text-neutral font-bold">0812-3456-7890</p>
                    </div>
                </div>
            </div>
            <div class="border-base-200 h-[450px] w-full overflow-hidden rounded-[3rem] border-[12px] shadow-2xl lg:w-2/3">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.666427139178!2d106.8245840758444!3d-6.175392360514108!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2db40393d%3A0x62660706246e45!2sMonumen%20Nasional!5e0!3m2!1sid!2sid!4v1708845000000!5m2!1sid!2sid"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>
    </section>
@endsection
