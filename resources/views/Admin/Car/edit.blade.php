@extends('Admin.Layouts.main')

@section('title', 'Edit Unit Mobil')

@section('content')
    <div class="mx-auto max-w-6xl animate-[fadeIn_0.5s_ease-out] space-y-6 md:space-y-8 px-4 md:px-0">

        <div class="flex items-center gap-4">
            <a href="{{ url('admin/cars') }}"
                class="btn btn-ghost btn-circle border border-slate-100 bg-white shadow-sm shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-xl md:text-2xl font-black uppercase italic tracking-tight text-slate-800">Edit <span
                        class="text-indigo-600">Unit</span></h2>
                <p class="text-[9px] md:text-[10px] font-bold uppercase tracking-widest text-slate-400">Update spesifikasi
                    kendaraan</p>
            </div>
        </div>

        <form action="{{ url('admin/cars/' . $car->slug) }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 gap-6 lg:grid-cols-3">
            @csrf @method('PUT')

            <div class="space-y-6 lg:col-span-2">
                <div
                    class="card rounded-[2rem] md:rounded-[2.5rem] border border-slate-200 bg-white p-6 md:p-10 shadow-sm space-y-6">
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div class="form-control">
                            <label class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">Nama
                                Mobil</label>
                            <input type="text" name="name" value="{{ old('name', $car->name) }}"
                                class="input input-bordered rounded-xl md:rounded-2xl bg-slate-50 font-bold focus:border-indigo-600">
                        </div>
                        <div class="form-control">
                            <label
                                class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">Brand</label>
                            <select name="category_id"
                                class="select select-bordered rounded-xl md:rounded-2xl bg-slate-50 font-bold focus:border-indigo-600">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ $car->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-control">
                        <label
                            class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">Deskripsi</label>
                        <input id="description" type="hidden" name="description"
                            value="{{ old('description', $car->description) }}">
                        <div class="min-h-[200px] rounded-xl border border-slate-200 bg-slate-50 overflow-hidden">
                            <trix-editor input="description"
                                class="trix-content font-medium text-slate-700 border-none"></trix-editor>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div class="form-control">
                            <label
                                class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">Harga</label>
                            <input type="number" name="price" value="{{ old('price', $car->price) }}"
                                class="input input-bordered rounded-xl md:rounded-2xl bg-slate-50 font-bold focus:border-indigo-600">
                        </div>
                        <div class="form-control">
                            <label
                                class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">Tahun</label>
                            <input type="number" name="year" value="{{ old('year', $car->year) }}"
                                class="input input-bordered rounded-xl md:rounded-2xl bg-slate-50 font-bold focus:border-indigo-600">
                        </div>
                        <div class="form-control">
                            <label class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">KM</label>
                            <input type="number" name="mileage" value="{{ old('mileage', $car->mileage) }}"
                                class="input input-bordered rounded-xl md:rounded-2xl bg-slate-50 font-bold focus:border-indigo-600">
                        </div>
                    </div>
                </div>

                <div
                    class="card rounded-[2rem] md:rounded-[2.5rem] border border-slate-200 bg-white p-6 md:p-10 shadow-sm space-y-6">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        <div class="space-y-3">
                            <label class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">Thumbnail
                                Baru</label>
                            <input type="file" name="thumbnail"
                                class="file-input file-input-bordered w-full rounded-xl md:rounded-2xl">
                            <div class="pt-2">
                                <p class="mb-2 text-[9px] font-black uppercase text-slate-400">Preview Saat Ini:</p>
                                <img src="{{ asset('uploads/thumbnails/' . $car->thumbnail) }}"
                                    class="h-28 w-full md:w-44 rounded-xl border object-cover shadow-sm">
                            </div>
                        </div>

                        <div class="space-y-3">
                            <label class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">Galeri
                                Foto</label>
                            <input type="file" name="images[]" multiple
                                class="file-input file-input-bordered w-full rounded-xl md:rounded-2xl">

                            <div class="mt-4 flex flex-wrap gap-2 md:gap-3">
                                @php $gallery = is_array($car->images) ? $car->images : json_decode($car->images, true); @endphp
                                @forelse ($gallery ?? [] as $img)
                                    <div
                                        class="group relative h-16 w-20 md:h-20 md:w-28 overflow-hidden rounded-lg md:rounded-xl border-2 border-slate-100">
                                        <img src="{{ asset('uploads/gallery/' . $img) }}"
                                            class="h-full w-full object-cover">
                                        <div
                                            class="absolute inset-0 flex items-center justify-center bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <button type="button" onclick="confirmDeleteImage('{{ $img }}')"
                                                class="rounded-lg bg-rose-500 p-1.5 text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-[10px] font-bold italic text-slate-400">Belum ada foto galeri.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div
                    class="card rounded-[2rem] md:rounded-[2.5rem] border border-slate-200 bg-white p-6 md:p-8 shadow-sm space-y-4 md:space-y-6">
                    <div class="form-control">
                        <label
                            class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">Transmisi</label>
                        <select name="transmission"
                            class="select select-bordered rounded-xl md:rounded-2xl bg-slate-50 font-bold focus:border-indigo-600">
                            <option value="Automatic"
                                {{ old('transmission', $car->transmission) == 'Automatic' ? 'selected' : '' }}>Automatic
                            </option>
                            <option value="Manual"
                                {{ old('transmission', $car->transmission) == 'Manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">Status
                            Stok</label>
                        <select name="status"
                            class="select select-bordered rounded-xl md:rounded-2xl bg-slate-50 font-bold text-indigo-600 focus:border-indigo-600">
                            @foreach (['Available', 'Sold', 'Booked'] as $st)
                                <option value="{{ $st }}" {{ $car->status == $st ? 'selected' : '' }}>
                                    {{ $st }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">Bahan
                            Bakar</label>
                        <select name="fuel_type"
                            class="select select-bordered rounded-xl md:rounded-2xl bg-slate-50 font-bold focus:border-indigo-600">
                            @foreach (['Bensin', 'Diesel', 'Electric', 'Hybrid'] as $fuel)
                                <option value="{{ $fuel }}"
                                    {{ old('fuel_type', $car->fuel_type) == $fuel ? 'selected' : '' }}>{{ $fuel }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-control">
                        <label class="label text-[10px] md:text-[11px] font-black uppercase text-slate-500">Warna</label>
                        <input type="text" name="color" value="{{ old('color', $car->color) }}"
                            placeholder="Hitam Metalik"
                            class="input input-bordered rounded-xl md:rounded-2xl bg-slate-50 font-bold focus:border-indigo-600">
                    </div>
                </div>

                <button type="submit"
                    class="btn h-14 md:h-16 w-full rounded-xl md:rounded-2xl border-none bg-indigo-600 font-black uppercase tracking-widest text-white shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all active:scale-95">
                    Update Unit
                </button>
            </div>
        </form>
    </div>

    <form id="delete-image-form" method="POST" class="hidden">
        @csrf @method('DELETE')
    </form>

    <script>
        function confirmDeleteImage(imageName) {
            if (confirm('Hapus foto ini dari galeri?')) {
                const form = document.getElementById('delete-image-form');
                form.action = `/admin/cars/{{ $car->slug }}/delete-image/${imageName}`;
                form.submit();
            }
        }
    </script>
@endsection
