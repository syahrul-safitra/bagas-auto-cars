@extends("Admin.Layouts.main")

@section("content")
    {{-- Container utama dibuat flex agar bisa center --}}
    <div class="flex min-h-[80vh] animate-[fadeIn_0.5s_ease-out] flex-col items-center justify-center p-8">

        <div class="w-full max-w-5xl">
            {{-- Header Section --}}
            <div class="mb-8 flex items-end justify-between">
                <div>
                    <a href="{{ url("/admin/users") }}"
                        class="group flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 transition-colors hover:text-indigo-600">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 transition-transform group-hover:-translate-x-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Daftar
                    </a>
                    <h2 class="mt-4 text-4xl font-black uppercase italic tracking-tighter text-slate-800">
                        Registrasi <span class="text-indigo-600">User Baru</span>
                    </h2>
                </div>
                <div class="hidden text-right md:block">
                    <p class="text-[10px] font-black uppercase italic tracking-[0.2em] text-slate-300">Bagas Auto Management
                    </p>
                </div>
            </div>

            {{-- Form Card --}}
            <form action="{{ url("/admin/users") }}" method="POST"
                class="card rounded-[3rem] border border-slate-100 bg-white p-12 shadow-2xl shadow-slate-200/60">
                @csrf

                {{-- Hidden Input untuk default role sebagai Administrator (0) --}}
                <input type="hidden" name="is_owner" value="0">

                <div class="grid gap-8">
                    <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                        {{-- Nama Lengkap --}}
                        <div class="form-control w-full">
                            <label class="label mb-2 px-4 italic">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Nama
                                    Lengkap</span>
                            </label>
                            <input type="text" name="name" value="{{ old("name") }}" required
                                placeholder="Masukkan nama staf..."
                                class="input input-bordered @error("name") border-rose-500 @enderror h-16 w-full rounded-2xl border-slate-200 bg-slate-50 px-6 font-bold text-slate-700 focus:border-indigo-500 focus:bg-white">
                            @error("name")
                                <p class="mt-2 px-4 text-right text-[10px] font-bold uppercase italic text-rose-500">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div class="form-control w-full">
                            <label class="label mb-2 px-4 italic">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Alamat
                                    Email</span>
                            </label>
                            <input type="email" name="email" value="{{ old("email") }}" required
                                placeholder="staf@bagasauto.com"
                                class="input input-bordered @error("email") border-rose-500 @enderror h-16 w-full rounded-2xl border-slate-200 bg-slate-50 px-6 font-bold text-slate-700 focus:border-indigo-500 focus:bg-white">
                            @error("email")
                                <p class="mt-2 px-4 text-right text-[10px] font-bold uppercase italic text-rose-500">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-2 grid grid-cols-1 gap-8 border-t border-slate-50 pt-8 md:grid-cols-2">
                        {{-- Password --}}
                        <div class="form-control w-full">
                            <label class="label mb-2 px-4 italic">
                                <span
                                    class="text-[10px] font-black uppercase tracking-widest text-slate-400">Password</span>
                            </label>
                            <input type="password" name="password" required placeholder="••••••••"
                                class="input input-bordered @error("password") border-rose-500 @enderror h-16 w-full rounded-2xl border-slate-200 bg-slate-50 px-6 font-bold text-slate-700 focus:border-indigo-500 focus:bg-white">
                        </div>

                        {{-- Confirm Password --}}
                        <div class="form-control w-full">
                            <label class="label mb-2 px-4 italic">
                                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Konfirmasi
                                    Password</span>
                            </label>
                            <input type="password" name="password_confirmation" required placeholder="••••••••"
                                class="input input-bordered h-16 w-full rounded-2xl border-slate-200 bg-slate-50 px-6 font-bold text-slate-700 focus:border-indigo-500 focus:bg-white">
                        </div>
                    </div>

                    {{-- Action Button --}}
                    <div class="mt-10 flex flex-col items-center">
                        <button type="submit"
                            class="btn h-20 w-full rounded-3xl border-none bg-indigo-600 text-lg font-black uppercase italic tracking-[0.2em] text-white shadow-2xl shadow-indigo-200 transition-all hover:scale-[1.02] hover:bg-indigo-700 active:scale-95">
                            Simpan & Daftarkan Akun
                        </button>
                        <p class="mt-6 text-center text-[9px] font-bold uppercase italic tracking-widest text-slate-400">
                            *Akun baru akan secara otomatis memiliki hak akses sebagai Administrator sistem.
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
