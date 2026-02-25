@extends("Admin.Layouts.main")

@section("title", "Tambah Merek Mobil")

@section("content")
    <div class="mx-auto max-w-2xl animate-[fadeIn_0.5s_ease-out] space-y-8">

        <div class="flex items-center gap-4">
            <a href="{{ url("admin/categories") }}"
                class="btn btn-ghost btn-circle border border-slate-100 bg-white shadow-sm transition-all hover:bg-slate-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-slate-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-2xl font-black uppercase italic tracking-tight text-slate-800">Input <span
                        class="text-indigo-600">Merek</span></h2>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Tambahkan kategori pabrikan mobil
                    baru</p>
            </div>
        </div>

        <form action="{{ url("admin/categories") }}" method="POST" class="space-y-6">
            @csrf

            <div class="card overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-sm">
                <div class="p-10">
                    <div class="form-control w-full">
                        <label class="label mb-3">
                            <span class="label-text text-[11px] font-black uppercase tracking-[0.2em] text-slate-500">Nama
                                Merek Mobil</span>
                            <span class="badge badge-ghost rounded-lg text-[9px] font-black uppercase text-slate-400">Wajib
                                Diisi</span>
                        </label>

                        <div class="group relative">
                            <input type="text" name="name" value="{{ old("name") }}"
                                placeholder="Contoh: Mercedes-Benz atau BMW"
                                class="input input-bordered @error("name") input-error @enderror h-20 w-full rounded-3xl border-slate-200 bg-slate-50 px-8 text-xl font-black tracking-tight text-slate-800 transition-all focus:bg-white focus:ring-[6px] focus:ring-indigo-50"
                                autofocus required>

                            <div
                                class="absolute right-8 top-1/2 -translate-y-1/2 text-indigo-600 opacity-20 transition-opacity group-focus-within:opacity-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>

                        @error("name")
                            <label class="label mt-2">
                                <span class="label-text-alt flex items-center gap-1 font-bold text-rose-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ $message }}
                                </span>
                            </label>
                        @enderror
                    </div>

                    <div class="mt-10 rounded-2xl bg-slate-50 p-6">
                        <div class="flex gap-4">
                            <div
                                class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-white text-indigo-500 shadow-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div>
                                <h4 class="text-xs font-black uppercase tracking-wider text-slate-700">Informasi</h4>
                                <p class="mt-1 text-[11px] leading-relaxed text-slate-500">
                                    Nama merek harus bersifat unik. Sistem akan secara otomatis membuat URL (slug)
                                    berdasarkan nama yang Anda masukkan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div
                class="flex items-center justify-end gap-3 rounded-[2rem] border border-slate-100 bg-white/70 p-4 shadow-xl shadow-slate-200/40 backdrop-blur-md">
                <a href="{{ url("admin/categories") }}"
                    class="btn btn-ghost rounded-2xl px-8 font-bold text-slate-400 hover:bg-slate-100">
                    Batal
                </a>

                <button type="submit"
                    class="btn rounded-2xl border-none bg-indigo-600 px-10 font-black uppercase tracking-[0.15em] text-white shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 active:scale-95">
                    Simpan Merek
                </button>
            </div>
        </form>
    </div>
@endsection
