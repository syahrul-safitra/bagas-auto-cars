@extends("Admin.Layouts.main")

@section("title", "Tambah Unit Mobil")

@section("content")
    <div class="mx-auto max-w-6xl animate-[fadeIn_0.5s_ease-out] space-y-8">
        <div class="flex items-center gap-4">
            <a href="{{ url("admin/cars") }}" class="btn btn-ghost btn-circle border border-slate-100 bg-white shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-black uppercase italic tracking-tight text-slate-800">Tambah <span
                        class="text-indigo-600">Unit</span></h2>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Input spesifikasi lengkap
                    kendaraan</p>
            </div>
        </div>

        <form action="{{ url("admin/cars") }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            @csrf

            <div class="space-y-6 lg:col-span-2">
                <div class="card space-y-6 rounded-[2.5rem] border border-slate-200 bg-white p-10 shadow-sm">
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="form-control">
                            <label class="label text-[11px] font-black uppercase text-slate-500">Nama/Model Mobil</label>
                            <input type="text" name="name" value="{{ old("name") }}"
                                class="input input-bordered @error("name") border-rose-500 @enderror rounded-2xl bg-slate-50 font-bold"
                                placeholder="M4 Competition">
                            @error("name")
                                <label class="label"><span
                                        class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label text-[11px] font-black uppercase text-slate-500">Merek (Brand)</label>
                            <select name="category_id"
                                class="select select-bordered @error("category_id") border-rose-500 @enderror rounded-2xl bg-slate-50 font-bold">
                                <option value="" disabled selected>Pilih Brand</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ old("category_id") == $cat->id ? "selected" : "" }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error("category_id")
                                <label class="label"><span
                                        class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                            @enderror
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label text-[11px] font-black uppercase tracking-widest text-slate-500">
                            Deskripsi Kendaraan
                        </label>
                        <input id="description" type="hidden" name="description" value="{{ old("description") }}">
                        <trix-editor input="description"
                            class="trix-content @error("description") border-rose-500 @enderror font-medium text-slate-700"></trix-editor>
                        @error("description")
                            <label class="label mt-1">
                                <span class="label-text-alt font-bold text-rose-500">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div class="form-control">
                            <label class="label text-[11px] font-black uppercase text-slate-500">Harga (IDR)</label>
                            <input type="number" name="price" value="{{ old("price") }}"
                                class="input input-bordered @error("price") border-rose-500 @enderror rounded-2xl bg-slate-50 font-bold"
                                placeholder="2500000000">
                            @error("price")
                                <label class="label"><span
                                        class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label class="label text-[11px] font-black uppercase text-slate-500">Tahun</label>
                            <input type="number" name="year" value="{{ old("year") }}"
                                class="input input-bordered @error("year") border-rose-500 @enderror rounded-2xl bg-slate-50 font-bold"
                                placeholder="2024">
                            @error("year")
                                <label class="label"><span
                                        class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label class="label text-[11px] font-black uppercase text-slate-500">Mileage (KM)</label>
                            <input type="number" name="mileage" value="{{ old("mileage") }}"
                                class="input input-bordered @error("mileage") border-rose-500 @enderror rounded-2xl bg-slate-50 font-bold"
                                placeholder="5000">
                            @error("mileage")
                                <label class="label"><span
                                        class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="card space-y-6 rounded-[2.5rem] border border-slate-200 bg-white p-10 shadow-sm">
                    <h3 class="text-xs font-black uppercase tracking-widest text-slate-800">Media & Galeri</h3>
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="form-control">
                            <label class="label text-[11px] font-black uppercase text-slate-500">Thumbnail (Utama)</label>
                            <input type="file" name="thumbnail"
                                class="file-input file-input-bordered @error("thumbnail") file-input-error @enderror w-full rounded-2xl">
                            @error("thumbnail")
                                <label class="label"><span
                                        class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label class="label text-[11px] font-black uppercase text-slate-500">Galeri Tambahan</label>
                            <input type="file" name="images[]" multiple
                                class="file-input file-input-bordered @error("images.*") file-input-error @enderror w-full rounded-2xl">
                            <label class="label"><span class="label-text-alt text-[9px] font-bold text-slate-400">Bisa
                                    pilih lebih dari 1 foto</span></label>
                            @error("images.*")
                                <label class="label"><span
                                        class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div class="card space-y-6 rounded-[2.5rem] border border-slate-200 bg-white p-8 shadow-sm">
                    <div class="form-control">
                        <label class="label text-[11px] font-black uppercase text-slate-500">Transmisi</label>
                        <select name="transmission" class="select select-bordered rounded-2xl bg-slate-50 font-bold">
                            @foreach (["Automatic", "Manual"] as $opt)
                                <option value="{{ $opt }}" {{ old("transmission") == $opt ? "selected" : "" }}>
                                    {{ $opt }}</option>
                            @endforeach
                        </select>
                        @error("transmission")
                            <label class="label"><span
                                    class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label text-[11px] font-black uppercase text-slate-500">Bahan Bakar</label>
                        <select name="fuel_type" class="select select-bordered rounded-2xl bg-slate-50 font-bold">
                            @foreach (["Bensin", "Diesel", "Electric", "Hybrid"] as $fuel)
                                <option value="{{ $fuel }}" {{ old("fuel_type") == $fuel ? "selected" : "" }}>
                                    {{ $fuel }}</option>
                            @endforeach
                        </select>
                        @error("fuel_type")
                            <label class="label"><span
                                    class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label text-[11px] font-black uppercase text-slate-500">Warna</label>
                        <input type="text" name="color" value="{{ old("color") }}"
                            class="input input-bordered @error("color") border-rose-500 @enderror rounded-2xl bg-slate-50 font-bold"
                            placeholder="Alpine White">
                        @error("color")
                            <label class="label"><span
                                    class="label-text-alt font-bold text-rose-500">{{ $message }}</span></label>
                        @enderror
                    </div>

                    <div class="form-control">
                        <label class="label text-[11px] font-black uppercase text-slate-500">Status Stok</label>
                        <select name="status"
                            class="select select-bordered rounded-2xl bg-slate-50 font-bold text-indigo-600">
                            @foreach (["Available", "Sold", "Booked"] as $st)
                                <option value="{{ $st }}" {{ old("status") == $st ? "selected" : "" }}>
                                    {{ $st }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <button type="submit" onclick="this.disabled=true;this.form.submit();"
                    class="btn h-16 w-full rounded-2xl border-none bg-indigo-600 font-black uppercase tracking-widest text-white shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 active:scale-95">
                    Posting Unit
                </button>
            </div>
        </form>
    </div>
@endsection
