@extends("Admin.Layouts.main")

@section("content")
    <div class="animate-[fadeIn_0.5s_ease-out] p-2 md:p-4">

        {{-- STATS SECTION --}}
        <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
            {{-- Stat 1 --}}
            <div
                class="group relative overflow-hidden rounded-[2rem] border border-slate-100 bg-white p-6 shadow-xl shadow-slate-200/50 transition-all hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black uppercase italic tracking-widest text-slate-400">Total Armada</p>
                        <h3 class="mt-1 text-3xl font-black tracking-tighter text-slate-800">
                            {{ $totalCars }} <span class="text-xs font-bold italic text-indigo-500">Unit</span>
                        </h3>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition-colors group-hover:bg-indigo-600 group-hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4 flex items-center gap-2">
                    <span
                        class="flex items-center rounded-full bg-emerald-50 px-2 py-0.5 text-[10px] font-bold text-emerald-500">
                        +{{ $newCarsToday }} Baru
                    </span>
                    <span class="text-[10px] font-bold font-medium italic text-slate-400">Ditambahkan hari ini</span>
                </div>
            </div>

            {{-- Stat 2 --}}
            <div
                class="group relative overflow-hidden rounded-[2rem] border border-slate-100 bg-white p-6 shadow-xl shadow-slate-200/50 transition-all hover:-translate-y-1">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black uppercase italic tracking-widest text-slate-400">Booking Aktif</p>
                        <h3 class="mt-1 text-3xl font-black tracking-tighter text-slate-800">
                            {{ $activeBookings }} <span class="text-xs font-bold italic text-rose-500">Antrean</span>
                        </h3>
                    </div>
                    <div
                        class="flex h-12 w-12 items-center justify-center rounded-2xl bg-rose-50 text-rose-600 transition-colors group-hover:bg-rose-600 group-hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="animate-pulse text-[10px] font-black uppercase tracking-tighter text-rose-500">● Perlu
                        Konfirmasi Segera</span>
                </div>
            </div>

            {{-- Stat 3 --}}
            <div
                class="group relative overflow-hidden rounded-[2rem] border border-slate-100 bg-indigo-600 p-6 shadow-xl shadow-indigo-200 transition-all hover:-translate-y-1">
                <div class="absolute -right-4 -top-4 text-white/10 transition-transform group-hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-32 w-32" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1.41 16.09V20h-2.67v-1.93c-1.71-.36-3.16-1.46-3.27-3.4h1.96c.1 1.05.82 1.87 2.65 1.87 1.96 0 2.4-.98 2.4-1.59 0-.83-.44-1.61-2.67-2.14-2.48-.6-4.18-1.62-4.18-3.63 0-1.88 1.47-3.05 3.11-3.41V4h2.67v1.91c1.39.3 2.58 1.09 2.95 2.86h-1.96c-.34-.94-.9-1.44-2.07-1.44-1.3 0-2.26.56-2.26 1.53 0 .88.76 1.33 2.72 1.81 2.54.63 4.12 1.76 4.12 3.73 0 2.26-1.88 3.39-3.85 3.69z" />
                    </svg>
                </div>
                <div class="relative z-10">
                    <p class="text-[10px] font-black uppercase italic tracking-widest text-indigo-200">Estimasi Penjualan
                    </p>
                    <h3 class="mt-1 text-3xl font-black tracking-tighter text-white">{{ $formattedSales }}</h3>
                    <p class="mt-4 text-[10px] font-bold uppercase italic text-indigo-100">Periode: Februari 2026</p>
                </div>
            </div>
        </div>

        {{-- TABLE SECTION --}}
        <div class="rounded-[2.5rem] border border-slate-100 bg-white p-4 shadow-xl shadow-slate-200/50">
            <div class="flex flex-col gap-4 p-6 md:flex-row md:items-center md:justify-between">
                <div>
                    <h2 class="text-2xl font-black uppercase italic tracking-tighter text-slate-800">
                        Armada <span class="text-indigo-600">Terbaru</span>
                    </h2>
                    <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Kelola stok unit mobil Bagas
                        Auto</p>
                </div>
            </div>

            <div class="overflow-x-auto px-4 pb-4">
                <table class="w-full border-separate border-spacing-y-3">
                    <thead>
                        <tr class="text-left text-[10px] font-black uppercase italic tracking-widest text-slate-400">
                            <th class="px-6 py-2">Unit Mobil</th>
                            <th class="px-6 py-2">Brand</th>
                            <th class="px-6 py-2">Harga Off-Road</th>
                            <th class="px-6 py-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($latestCars as $car)
                            <tr class="group transition-all hover:translate-x-1">
                                {{-- Kolom Unit Mobil --}}
                                <td class="rounded-l-2xl bg-slate-50 px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="relative h-14 w-14 shrink-0 overflow-hidden rounded-2xl border-2 border-white shadow-md">
                                            @if ($car->thumbnail)
                                                <img src="{{ asset("uploads/thumbnails/" . $car->thumbnail) }}"
                                                    class="h-full w-full object-cover" alt="{{ $car->name }}" />
                                            @else
                                                <div
                                                    class="flex h-full w-full items-center justify-center bg-slate-200 text-[10px] font-bold text-slate-400">
                                                    NO IMG</div>
                                            @endif
                                        </div>
                                        <div>
                                            <div class="text-xs font-black uppercase italic tracking-tight text-slate-800">
                                                {{ $car->name }}</div>
                                            <div class="text-[9px] font-bold uppercase italic text-slate-400">NIK
                                                {{ $car->year }} • {{ $car->color ?? "Standard" }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- Kolom Brand/Kategori --}}
                                <td class="bg-slate-50 px-6 py-4">
                                    <span class="text-[10px] font-black uppercase italic text-slate-600">
                                        {{ $car->category->name }}
                                    </span>
                                </td>

                                {{-- Kolom Harga --}}
                                <td class="bg-slate-50 px-6 py-4 font-black text-slate-800">

                                    <span class="text-xs text-indigo-600">Rp</span>
                                    {{ number_format($car->price / 1000000, 0, ",", ".") }}
                                    <span class="text-[10px] text-slate-400">Jt</span>
                                </td>

                                {{-- Kolom Status dengan Logika Warna --}}
                                <td class="bg-slate-50 px-6 py-4">
                                    @if ($car->status == "available")
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1 text-[9px] font-black uppercase italic text-emerald-700">
                                            <span class="h-1.5 w-1.5 animate-pulse rounded-full bg-emerald-500"></span>
                                            Available
                                        </span>
                                    @elseif($car->status == "sold")
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-slate-200 px-3 py-1 text-[9px] font-black uppercase italic text-slate-600">
                                            Terjual
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full bg-amber-100 px-3 py-1 text-[9px] font-black uppercase italic text-amber-700">
                                            Booked
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
