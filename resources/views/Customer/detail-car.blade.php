@extends('Customer.Layouts.main')

@section('container')
    <div class="mx-auto max-w-7xl px-6 pt-24 pb-12 md:pt-32 animate-[fadeIn_0.5s_ease-out]">
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">

            <div class="lg:col-span-2 space-y-8">
                <div class="group relative overflow-hidden rounded-[3rem] bg-white shadow-2xl shadow-slate-200">
                    <img src="{{ asset('uploads/thumbnails/' . $car->thumbnail) }}"
                        class="h-[400px] w-full object-cover md:h-[500px]" id="mainImage">

                    <div class="absolute left-8 top-8">
                        <span
                            class="rounded-full bg-white/90 px-6 py-2 text-[10px] font-black uppercase tracking-widest text-indigo-600 backdrop-blur shadow-sm">
                            {{ $car->status }}
                        </span>
                    </div>
                </div>

                <div class="flex flex-wrap gap-4">
                    @php
                        $gallery = is_array($car->images) ? $car->images : json_decode($car->images, true);
                    @endphp
                    @foreach ($gallery ?? [] as $img)
                        <div class="h-20 w-28 cursor-pointer overflow-hidden rounded-2xl border-2 border-transparent transition-all hover:border-indigo-600 active:scale-90"
                            onclick="document.getElementById('mainImage').src='{{ asset('uploads/gallery/' . $img) }}'">
                            <img src="{{ asset('uploads/gallery/' . $img) }}" class="h-full w-full object-cover">
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                    @php
                        $specs = [
                            [
                                'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                'label' => 'Tahun',
                                'value' => $car->year,
                            ],
                            [
                                'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                                'label' => 'Transmisi',
                                'value' => $car->transmission,
                            ],
                            [
                                'icon' =>
                                    'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1',
                                'label' => 'Bahan Bakar',
                                'value' => $car->fuel_type,
                            ],
                            [
                                'icon' =>
                                    'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                                'label' => 'Kilometer',
                                'value' => number_format($car->mileage) . ' KM',
                            ],
                        ];
                    @endphp
                    @foreach ($specs as $spec)
                        <div class="rounded-[2rem] border border-slate-100 bg-white p-6 text-center shadow-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto mb-3 h-6 w-6 text-indigo-600"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $spec['icon'] }}" />
                            </svg>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">{{ $spec['label'] }}
                            </p>
                            <p class="text-sm font-bold text-slate-800">{{ $spec['value'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="rounded-[2.5rem] bg-white p-10 shadow-sm border border-slate-100">
                    <h3
                        class="mb-6 text-xl font-black uppercase italic tracking-tighter text-slate-800 underline decoration-indigo-500 decoration-4 underline-offset-8">
                        Deskripsi <span class="text-indigo-600">Unit</span></h3>
                    <article class="prose max-w-none font-medium text-slate-600">
                        {!! $car->description !!}
                    </article>
                </div>
            </div>

            <div class="lg:sticky lg:top-28 h-fit space-y-6">
                <div class="card rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-2xl shadow-slate-200/50">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Harga Penawaran</p>
                    <h2 class="mt-2 text-4xl font-black italic tracking-tighter text-indigo-600">
                        Rp {{ number_format($car->price, 0, ',', '.') }}
                    </h2>

                    <hr class="my-8 border-slate-100">

                    @if ($car->status == 'Available')
                        <div class="space-y-4">
                            <p class="text-xs font-medium text-slate-500 italic">Unit tersedia untuk inspeksi langsung.</p>
                            <button onclick="booking_modal.showModal()"
                                class="btn h-16 w-full rounded-2xl border-none bg-indigo-600 font-black uppercase tracking-widest text-white shadow-xl shadow-indigo-200 transition-all hover:bg-indigo-700 active:scale-95">
                                Booking Unit Sekarang
                            </button>
                        </div>
                    @else
                        <div class="rounded-2xl bg-slate-50 p-6 text-center border-2 border-dashed border-slate-200">
                            <p class="text-xs font-black uppercase tracking-widest text-slate-400">Unit Tidak Tersedia</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <dialog id="booking_modal" class="modal modal-bottom sm:modal-middle">
        {{-- Tambahkan max-h-[90vh] agar modal tidak lebih tinggi dari layar, dan flex-col --}}
        <div class="modal-box p-0 rounded-[2.5rem] bg-white max-w-2xl max-h-[90vh] flex flex-col shadow-2xl">

            <div class="bg-indigo-600 p-6 md:p-8 text-white shrink-0">
                <h3 class="text-2xl font-black uppercase italic tracking-tighter">Konfirmasi <span
                        class="text-indigo-200">Booking</span></h3>
                <p class="text-[10px] font-bold uppercase tracking-widest opacity-80 mt-1">Mohon tinjau kembali data pesanan
                    Anda</p>
            </div>

            <form action="{{ url('booking-car/' . $car->slug) }}" method="POST" class="flex flex-col overflow-hidden">
                @csrf

                <input type="hidden" name="customer_id" value="1">

                <div class="p-6 md:p-8 space-y-6 overflow-y-auto custom-scrollbar" style="max-height: calc(90vh - 200px);">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Detail
                                Unit</label>
                            <div class="flex items-center gap-4">
                                <img src="{{ asset('uploads/thumbnails/' . $car->thumbnail) }}"
                                    class="h-16 w-16 rounded-xl object-cover shadow-md">
                                <div>
                                    <h4 class="font-black text-slate-800 leading-tight uppercase italic text-sm">
                                        {{ $car->name }}</h4>
                                    <p class="text-xs font-bold text-indigo-600">Rp
                                        {{ number_format($car->price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Data
                                Pemesan</label>
                            <div class="space-y-1">
                                {{-- <p class="text-sm font-black text-slate-800">{{ auth()->user()->name ?? 'Guest User' }}</p>
                                <p class="text-[11px] font-bold text-slate-500">{{ auth()->user()->phone ?? '-' }}</p> --}}
                            </div>
                        </div>
                    </div>

                    <div class="divider opacity-50 my-2"></div>

                    <div class="form-control">
                        <label class="label pt-0">
                            <span class="label text-[10px] font-black uppercase text-slate-500">Pesan untuk Penjual
                                (Opsional)</span>
                        </label>
                        <textarea name="message"
                            class="textarea textarea-bordered h-24 rounded-2xl bg-slate-50 font-medium focus:border-indigo-600 border-slate-200"
                            placeholder="Contoh: Saya ingin cek unit besok sore jam 4..."></textarea>
                    </div>

                    <div class="bg-indigo-50 p-4 rounded-2xl border border-indigo-100">
                        <p
                            class="text-[9px] md:text-[10px] font-bold text-indigo-700 leading-relaxed uppercase tracking-tight">
                            📢 Verifikasi: Dengan menekan konfirmasi, saya menyatakan berminat serius pada unit ini dan
                            bersedia dihubungi oleh tim showroom.
                        </p>
                    </div>
                </div>

                <div class="p-6 bg-slate-50/50 border-t border-slate-100 grid grid-cols-2 gap-4 shrink-0">
                    <button type="button" onclick="booking_modal.close()"
                        class="btn btn-ghost rounded-2xl font-black uppercase text-slate-400 tracking-widest">Batal</button>
                    <button type="submit"
                        class="btn bg-indigo-600 hover:bg-indigo-700 border-none rounded-2xl font-black uppercase text-white tracking-widest shadow-lg shadow-indigo-200">Konfirmasi</button>
                </div>
            </form>
        </div>

        <form method="dialog" class="modal-backdrop bg-slate-900/60 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>

    <style>
        /* Styling agar scrollbar terlihat lebih modern di dalam modal */
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>
@endsection
