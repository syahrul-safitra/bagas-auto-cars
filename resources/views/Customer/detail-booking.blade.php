@extends('Customer.Layouts.main')

@section('container')
    <div class="mx-auto max-w-4xl px-6 pt-24 pb-12 md:pt-32 animate-[fadeIn_0.5s_ease-out]">

        @if (session('success'))
            <div
                class="mb-6 flex items-center gap-4 rounded-[2rem] border border-emerald-100 bg-emerald-50 p-4 text-emerald-700 animate-[fadeIn_0.5s_ease-out]">
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-500 text-white shadow-lg shadow-emerald-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-emerald-800">Berhasil!</p>
                    <p class="text-xs font-bold opacity-80 uppercase tracking-tight">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()"
                    class="btn btn-ghost btn-xs btn-circle opacity-50 hover:opacity-100">✕</button>
            </div>
        @endif

        {{-- ALERT ERROR (Jika ada validasi gagal) --}}
        @if ($errors->any())
            <div
                class="mb-6 flex items-center gap-4 rounded-[2rem] border border-rose-100 bg-rose-50 p-4 text-rose-700 animate-[fadeIn_0.5s_ease-out]">
                <div
                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-rose-500 text-white shadow-lg shadow-rose-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="flex-1">
                    <p class="text-[10px] font-black uppercase tracking-widest text-rose-800">Gagal!</p>
                    @foreach ($errors->all() as $error)
                        <p class="text-xs font-bold opacity-80 uppercase tracking-tight">{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="mb-8 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <nav class="mb-4 text-[10px] font-black uppercase tracking-widest text-slate-400">
                    <a href="/" class="hover:text-indigo-600">Home</a> /
                    <a href="/my-bookings" class="hover:text-indigo-600">My Bookings</a> /
                    <span class="text-slate-800">Detail</span>
                </nav>
                <h2 class="text-3xl font-black uppercase italic tracking-tighter text-slate-800">
                    Booking <span class="text-indigo-600">Detail</span>
                </h2>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-tight">ID Transaksi:
                    {{ $booking->booking_code }}</p>
            </div>

            <div class="flex flex-wrap gap-2">
                {{-- BADGE PAYMENT STATUS --}}
                @php
                    $payStatus = [
                        'Pending' => [
                            'bg' => 'bg-amber-50',
                            'text' => 'text-amber-600',
                            'ring' => 'ring-amber-200',
                            'label' => 'Payment Pending',
                        ],
                        'Waiting_Verification' => [
                            'bg' => 'bg-blue-50',
                            'text' => 'text-blue-600',
                            'ring' => 'ring-blue-200',
                            'label' => 'Waiting Verification',
                        ],
                        'Success' => [
                            'bg' => 'bg-emerald-50',
                            'text' => 'text-emerald-600',
                            'ring' => 'ring-emerald-200',
                            'label' => 'DP Success',
                        ],
                        'Paid_Off' => [
                            'bg' => 'bg-indigo-50',
                            'text' => 'text-indigo-600',
                            'ring' => 'ring-indigo-200',
                            'label' => 'Full Paid Off',
                        ],
                        'Cancelled' => [
                            'bg' => 'bg-rose-50',
                            'text' => 'text-rose-600',
                            'ring' => 'ring-rose-200',
                            'label' => 'Payment Cancelled',
                        ],
                    ];
                    $p = $payStatus[$booking->payment_status] ?? [
                        'bg' => 'bg-slate-50',
                        'text' => 'text-slate-600',
                        'ring' => 'ring-slate-200',
                        'label' => 'Unknown',
                    ];
                @endphp

                <span
                    class="rounded-full {{ $p['bg'] }} px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ $p['text'] }} ring-1 {{ $p['ring'] }}">
                    {{ $p['label'] }}
                </span>

                {{-- BADGE BOOKING STATUS --}}
                @php
                    $bookStatus = [
                        'Process' => ['bg' => 'bg-slate-800', 'text' => 'text-white', 'label' => 'In Process'],
                        'Deal' => ['bg' => 'bg-indigo-600', 'text' => 'text-white', 'label' => 'Unit Deal'],
                        'Failed' => ['bg' => 'bg-rose-600', 'text' => 'text-white', 'label' => 'Deal Failed'],
                    ];
                    $b = $bookStatus[$booking->booking_status] ?? [
                        'bg' => 'bg-slate-400',
                        'text' => 'text-white',
                        'label' => 'Unknown',
                    ];
                @endphp

                <span
                    class="rounded-full {{ $b['bg'] }} px-4 py-2 text-[10px] font-black uppercase tracking-widest {{ $b['text'] }} shadow-sm">
                    {{ $b['label'] }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">
                <div class="card rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-xl shadow-slate-200/50">
                    <div class="flex flex-col md:flex-row gap-6">
                        <img src="{{ asset('uploads/thumbnails/' . $booking->car->thumbnail) }}"
                            class="h-32 w-full md:w-48 rounded-[1.5rem] object-cover shadow-md">
                        <div class="space-y-2">
                            <span
                                class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600">{{ $booking->car->category->name }}</span>
                            <h3 class="text-xl font-black uppercase italic text-slate-800">{{ $booking->car->name }}</h3>
                            <div class="flex flex-wrap gap-3 text-[10px] font-bold uppercase text-slate-400">
                                <span>{{ $booking->car->year }}</span> •
                                <span>{{ $booking->car->transmission }}</span> •
                                <span>{{ $booking->car->color }}</span>
                            </div>
                            <p class="text-lg font-black text-slate-800 mt-2">Rp
                                {{ number_format($booking->car->price, 0, ',', '.') }}</p>
                        </div>
                    </div>

                    <div class="divider opacity-50 my-6"></div>

                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Tanggal Booking</p>
                            <p class="text-sm font-bold text-slate-800">{{ $booking->created_at->format('d M Y, H:i') }}
                                WIB
                            </p>
                        </div>
                        {{-- Cari bagian grid yang menampilkan Booking Status, lalu ganti menjadi: --}}
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Booking Status</p>
                            <div class="flex items-center gap-2 mt-1">
                                <div
                                    class="h-2 w-2 rounded-full {{ $booking->booking_status == 'Deal' ? 'bg-emerald-500' : ($booking->booking_status == 'Failed' ? 'bg-rose-500' : 'bg-amber-500 animate-pulse') }}">
                                </div>
                                <p class="text-sm font-bold text-slate-800 uppercase italic">{{ $booking->booking_status }}
                                </p>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Catatan Anda</p>
                            <p class="text-sm font-medium text-slate-600 italic">
                                "{{ $booking->notes ?? 'Tidak ada catatan.' }}"</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Ganti bagian Kolom Kanan (space-y-6) dengan ini --}}
            <div class="space-y-6">
                {{-- Card Bank tetap sama --}}
                <div class="card rounded-[2.5rem] border-none bg-slate-900 p-8 shadow-2xl text-white">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Total Tanda Jadi (DP)</p>
                    <h2 class="mt-2 text-3xl font-black tracking-tighter text-indigo-400">
                        Rp {{ number_format($booking->booking_fee, 0, ',', '.') }}
                    </h2>

                    <div class="mt-8 space-y-4">
                        <p class="text-[10px] font-black uppercase tracking-widest text-slate-500">Transfer Ke:</p>
                        <div class="rounded-2xl bg-white/5 p-4 border border-white/10">
                            <p class="text-[10px] font-bold text-slate-400 uppercase text-[9px]">Bank Central Asia (BCA)</p>
                            <p class="text-lg font-black tracking-widest mt-1">8829 0122 33</p>
                            <p class="text-[10px] font-bold text-indigo-300 uppercase mt-1">A/N SHOWROOM MOBIL</p>
                        </div>
                    </div>
                </div>

                <div class="card rounded-[2.5rem] border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="card rounded-[2.5rem] border border-slate-200 bg-white p-6 shadow-sm">
                        @if ($booking->payment_status == 'Pending')
                            {{-- Hanya tampilkan Form Upload jika yang melihat adalah Customer --}}
                            <h4 class="text-[11px] font-black uppercase tracking-widest text-slate-800 mb-4">
                                Upload Bukti Transfer
                            </h4>
                            <form action="{{ url('booking-upload', $booking->booking_code) }}" method="POST"
                                enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div class="form-control">
                                    <input type="file" name="bukti_dp" required
                                        class="file-input file-input-bordered w-full rounded-xl text-[10px] font-bold bg-slate-50 border-slate-200" />
                                    <label class="label">
                                        <span class="label-text-alt text-slate-400 font-medium italic uppercase text-[9px]">
                                            *Format: JPG, PNG (Max 2MB)
                                        </span>
                                    </label>
                                </div>
                                <button type="submit"
                                    class="btn btn-indigo-600 w-full rounded-xl bg-indigo-600 border-none text-white font-black uppercase text-[10px] tracking-widest hover:bg-indigo-700 shadow-lg shadow-indigo-100">
                                    Kirim Bukti Pembayaran
                                </button>
                            </form>
                        @elseif ($booking->payment_status == 'Waiting_Verification')
                            {{-- Kondisi Menunggu Verifikasi (Tampil baik bagi Admin maupun Customer) --}}
                            <div class="text-center py-4">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 text-blue-600 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <p class="text-[11px] font-black uppercase text-slate-800 tracking-tighter">Menunggu
                                    Verifikasi</p>
                                <p class="text-[9px] font-bold text-slate-400 mt-1 uppercase">Admin sedang mengecek bukti
                                    transfer Anda.</p>

                                {{-- Link Lihat Bukti (Penting untuk Admin memverifikasi) --}}
                                @if ($booking->bukti_dp)
                                    <div class="mt-4 pt-4 border-t border-dashed border-slate-100">
                                        <a href="{{ asset('uploads/bukti_pembayaran/' . $booking->bukti_dp) }}"
                                            target="_blank"
                                            class="text-[10px] font-black text-indigo-600 uppercase underline decoration-2 underline-offset-4">Lihat
                                            Bukti Transfer</a>
                                    </div>
                                @endif
                            </div>
                        @elseif(in_array($booking->payment_status, ['Success', 'Paid_Off']))
                            {{-- Jika status Success atau Paid_Off --}}
                            <div class="text-center py-4">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-emerald-100 text-emerald-600 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                                <p class="text-[11px] font-black uppercase text-slate-800">Pembayaran Diterima</p>
                                @if ($booking->payment_status == 'Paid_Off')
                                    <p class="text-[9px] font-bold text-emerald-600 mt-1 uppercase">Lunas (Full Payment)
                                    </p>
                                @endif
                            </div>
                        @elseif($booking->payment_status == 'Cancelled')
                            {{-- Status Dibatalkan --}}
                            <div class="text-center py-4">
                                <div
                                    class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-rose-100 text-rose-600 mb-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </div>
                                <p class="text-[11px] font-black uppercase text-rose-600">Booking Dibatalkan</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tombol WA & Print tetap ada di bawahnya --}}
                <div class="flex flex-col gap-3">
                    <a href="https://wa.me/628123456789?text=Halo Admin, saya ingin konfirmasi booking {{ $booking->booking_code }}"
                        target="_blank"
                        class="btn h-12 w-full rounded-2xl border border-slate-200 bg-white font-black uppercase tracking-widest text-slate-600 text-[10px] hover:bg-slate-50">
                        Hubungi Admin WA
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
