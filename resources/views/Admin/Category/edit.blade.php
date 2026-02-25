@extends("Admin.Layouts.main")

@section("title", "Edit Merek Mobil")

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
                <h2 class="text-2xl font-black uppercase italic tracking-tight text-slate-800">Edit <span
                        class="text-amber-500">Merek</span></h2>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Perbarui informasi pabrikan mobil
                </p>
            </div>
        </div>

        <form action="{{ url("admin/categories/" . $category->slug) }}" method="POST" class="space-y-6">
            @csrf
            @method("PUT")

            <div class="card overflow-hidden rounded-[2.5rem] border border-slate-200 bg-white shadow-sm">
                <div class="h-2 bg-amber-400"></div>

                <div class="p-10">
                    <div class="form-control w-full">
                        <label class="label mb-3">
                            <span class="label-text text-[11px] font-black uppercase tracking-[0.2em] text-slate-500">Nama
                                Merek Mobil</span>
                            <span class="text-[9px] font-black uppercase text-amber-500">Mode Penyuntingan</span>
                        </label>

                        <div class="group relative">
                            <input type="text" name="name" value="{{ old("name", $category->name) }}"
                                placeholder="Misal: Mercedes-Benz"
                                class="input input-bordered @error("name") input-error @enderror h-20 w-full rounded-3xl border-slate-200 bg-slate-50 px-8 text-xl font-black tracking-tight text-slate-800 transition-all focus:bg-white focus:ring-[6px] focus:ring-amber-50"
                                autofocus required>

                            <div class="absolute right-8 top-1/2 -translate-y-1/2 text-amber-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
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

                    <div class="mt-8 rounded-2xl border border-slate-100 bg-slate-50/50 p-6">
                        <div class="flex items-center justify-between">
                            <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">ID
                                Referensi</span>
                            <span
                                class="font-mono text-xs font-bold text-slate-400">#BRD-{{ str_pad($category->id, 4, "0", STR_PAD_LEFT) }}</span>
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
                    class="btn rounded-2xl border-none bg-amber-500 px-10 font-black uppercase tracking-[0.15em] text-white shadow-lg shadow-amber-100 transition-all hover:bg-amber-600 active:scale-95">
                    Perbarui Merek
                </button>
            </div>
        </form>
    </div>
@endsection
