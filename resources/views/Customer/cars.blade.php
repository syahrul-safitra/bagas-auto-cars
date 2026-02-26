@extends('Customer.Layouts.main')

@section('container')
    <div class="mx-auto max-w-7xl px-6 pt-24 pb-12 md:pt-32 animate-[fadeIn_0.5s_ease-out]">

        <div class="mb-12">
            <h2 class="text-4xl font-black uppercase italic tracking-tighter text-slate-800">
                Find Your <span class="text-indigo-600">Dream Car</span>
            </h2>
            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Jelajahi koleksi unit terbaik kami
                dengan kondisi prima</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-1">
                <div
                    class="sticky top-28 card rounded-[2.5rem] bg-white border border-slate-100 p-8 shadow-xl shadow-slate-200/50">
                    <form action="{{ url('search-cars') }}" method="GET" class="space-y-6">
                        <div>
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-3">Cari
                                Unit</label>
                            <input type="text" name="search" value="{{ request('search') }}"
                                placeholder="Contoh: Honda Civic..."
                                class="input input-bordered w-full rounded-2xl bg-slate-50 font-bold focus:border-indigo-600 border-slate-200 text-sm">
                        </div>

                        <div>
                            <label
                                class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-3">Kategori</label>
                            <select name="category"
                                class="select select-bordered w-full rounded-2xl bg-slate-50 font-bold focus:border-indigo-600 border-slate-200 text-sm">
                                <option value="">Semua Kategori</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label
                                class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-3">Transmisi</label>
                            <div class="flex flex-wrap gap-2">
                                @foreach (['Automatic', 'Manual'] as $trans)
                                    <label class="cursor-pointer">
                                        <input type="radio" name="transmission" value="{{ $trans }}"
                                            class="peer hidden" {{ request('transmission') == $trans ? 'checked' : '' }}>
                                        <span
                                            class="block px-4 py-2 rounded-xl border-2 border-slate-100 bg-slate-50 text-[10px] font-black uppercase peer-checked:border-indigo-600 peer-checked:text-indigo-600 transition-all">
                                            {{ $trans }}
                                        </span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div>
                            <label
                                class="text-[10px] font-black uppercase tracking-widest text-slate-400 block mb-3">Rentang
                                Harga (Juta)</label>
                            <div class="space-y-3">
                                <input type="number" name="min_price" value="{{ request('min_price') }}" placeholder="Min"
                                    class="input input-bordered w-full rounded-2xl bg-slate-50 font-bold text-sm">
                                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Max"
                                    class="input input-bordered w-full rounded-2xl bg-slate-50 font-bold text-sm">
                            </div>
                        </div>

                        <button type="submit"
                            class="btn bg-indigo-600 hover:bg-indigo-700 border-none w-full rounded-2xl font-black uppercase text-white tracking-widest shadow-lg shadow-indigo-100">
                            Terapkan Filter
                        </button>

                        @if (request()->anyFilled(['search', 'category', 'transmission', 'min_price', 'max_price']))
                            <a href="{{ url('search-cars') }}"
                                class="btn btn-ghost w-full text-[10px] font-black uppercase text-rose-500">Reset Filter</a>
                        @endif
                    </form>
                </div>
            </div>

            <div class="lg:col-span-3">
                @if ($cars->isEmpty())
                    <div class="rounded-[3rem] border-2 border-dashed border-slate-100 p-20 text-center bg-white/50">
                        <p class="text-xs font-black uppercase tracking-widest text-slate-400">Maaf, unit yang Anda cari
                            tidak ditemukan.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach ($cars as $car)
                            <div
                                class="group card rounded-[2.5rem] bg-white border border-slate-100 overflow-hidden shadow-sm hover:shadow-2xl transition-all hover:-translate-y-2">
                                <figure class="relative h-56 overflow-hidden">
                                    <img src="{{ asset('uploads/thumbnails/' . $car->thumbnail) }}"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    <div class="absolute top-4 left-4">
                                        <span
                                            class="bg-white/90 backdrop-blur px-4 py-1 rounded-full text-[9px] font-black uppercase tracking-widest text-indigo-600 shadow-sm">
                                            {{ $car->category->name }}
                                        </span>
                                    </div>
                                </figure>

                                <div class="p-6">
                                    <h3 class="text-lg font-black uppercase italic text-slate-800 truncate">
                                        {{ $car->name }}</h3>
                                    <div
                                        class="flex gap-3 mt-1 text-[9px] font-bold text-slate-400 uppercase tracking-tight">
                                        <span>{{ $car->year }}</span> • <span>{{ $car->transmission }}</span> •
                                        <span>{{ $car->fuel_type }}</span>
                                    </div>

                                    <div class="divider opacity-50 my-4"></div>

                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p
                                                class="text-[9px] font-black uppercase text-slate-400 tracking-widest leading-none">
                                                Harga</p>
                                            <p class="text-lg font-black text-indigo-600">Rp
                                                {{ number_format($car->price, 0, ',', '.') }}</p>
                                        </div>
                                        <a href="{{ url('/detail-car/' . $car->slug) }}"
                                            class="btn btn-circle bg-slate-900 border-none hover:bg-indigo-600 transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-12">
                        {{ $cars->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
