@extends("Admin.Layouts.main")

@section("content")
    <div class="flex animate-[fadeIn_0.5s_ease-out] flex-col items-center p-8">

        <div class="w-full max-w-5xl">
            {{-- Header --}}
            <div class="mb-6">
                <a href="{{ url("/admin/users") }}"
                    class="group flex items-center gap-2 text-[10px] font-black uppercase tracking-widest text-slate-400 transition-colors hover:text-indigo-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform group-hover:-translate-x-1"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
                <h2 class="mt-2 text-2xl font-black uppercase italic tracking-tighter text-slate-800">
                    Edit Profil <span class="text-indigo-600">Admin</span>
                </h2>
            </div>

            {{-- Form Card --}}
            <form action="{{ url("/admin/users/" . $user->id) }}" method="POST"
                class="card rounded-[2rem] border border-slate-100 bg-white p-8 shadow-xl shadow-slate-200/50">
                @csrf
                @method("PUT")

                <div class="grid gap-6">
                    {{-- Row 1: Nama & Email --}}
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="form-control">
                            {{-- h-8 memastikan label nama sejajar dengan label password yang punya sub-text --}}
                            <label class="label h-8 items-end px-1 pb-2 pt-0">
                                <span class="text-[10px] font-black uppercase italic tracking-widest text-slate-400">Nama
                                    Lengkap</span>
                            </label>
                            <input type="text" name="name" value="{{ old("name", $user->name) }}" required
                                class="input input-bordered @error("name") border-rose-500 @enderror h-11 rounded-xl border-slate-200 bg-slate-50 text-xs font-bold focus:border-indigo-500 focus:bg-white">
                            @error("name")
                                <p class="mt-1 px-1 text-[9px] font-bold italic text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label h-8 items-end px-1 pb-2 pt-0">
                                <span class="text-[10px] font-black uppercase italic tracking-widest text-slate-400">Alamat
                                    Email</span>
                            </label>
                            <input type="email" name="email" value="{{ old("email", $user->email) }}" required
                                class="input input-bordered @error("email") border-rose-500 @enderror h-11 rounded-xl border-slate-200 bg-slate-50 text-xs font-bold focus:border-indigo-500 focus:bg-white">
                            @error("email")
                                <p class="mt-1 px-1 text-[9px] font-bold italic text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-2 border-slate-50">

                    {{-- Row 2: Passwords --}}
                    {{-- Row 2: Passwords --}}
                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="form-control">
                            <label class="label h-8 items-end px-1 pb-2 pt-0">
                                <span
                                    class="text-[10px] font-black uppercase italic leading-tight tracking-widest text-slate-400">
                                    Password Baru <br><span class="text-[7px] normal-case opacity-60">(Kosongkan jika
                                        tetap)</span>
                                </span>
                            </label>
                            <input type="password" name="password" placeholder="••••••••"
                                class="input input-bordered @error("password") border-rose-500 @enderror h-11 rounded-xl border-slate-200 bg-slate-50 text-xs font-bold focus:border-indigo-500 focus:bg-white">
                            @error("password")
                                <p class="mt-1 px-1 text-[9px] font-bold italic text-rose-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-control">
                            <label class="label h-8 items-end px-1 pb-2 pt-0">
                                <span class="text-[10px] font-black uppercase italic tracking-widest text-slate-400">Ulangi
                                    Password Baru</span>
                            </label>
                            {{-- Kita tambahkan class border-rose jika ada error pada 'password' yang tipenya konfirmasi --}}
                            <input type="password" name="password_confirmation" placeholder="••••••••"
                                class="input input-bordered @error("password") border-rose-500 @enderror h-11 rounded-xl border-slate-200 bg-slate-50 text-xs font-bold focus:border-indigo-500 focus:bg-white">

                            {{-- Menampilkan pesan khusus jika password tidak cocok --}}
                            @if ($errors->has("password") && str_contains($errors->first("password"), "confirmation"))
                                <p class="mt-1 px-1 text-[9px] font-bold italic text-rose-500">Konfirmasi password tidak
                                    cocok.</p>
                            @endif
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="mt-4 flex justify-end gap-3 border-t border-slate-50 pt-6">
                        <a href="{{ url("/admin/users") }}"
                            class="btn btn-ghost h-11 rounded-xl px-6 text-[10px] font-black uppercase tracking-widest text-slate-400">Batal</a>
                        <button type="submit"
                            class="btn h-11 min-w-[180px] rounded-xl border-none bg-indigo-600 text-[10px] font-black uppercase italic tracking-widest text-white shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 active:scale-95">
                            Update Data Admin
                        </button>
                    </div>
                </div>
            </form>

            {{-- Info Alert --}}
            <div class="mt-6 rounded-2xl border border-amber-100 bg-amber-50/50 p-4">
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 shrink-0 items-center justify-center rounded-full bg-amber-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-amber-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-[9px] font-bold uppercase leading-relaxed tracking-tight text-amber-700/80">
                        Keamanan: Password tidak wajib diubah. Pastikan email unik dan valid untuk menghindari error sistem.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
