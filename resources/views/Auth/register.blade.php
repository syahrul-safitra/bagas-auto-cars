@extends("Auth.main")

@section("content")
    <div class="w-full max-w-lg animate-[fadeIn_0.5s_ease-out]">
        <div
            class="card rounded-[3rem] border border-slate-200 bg-white/80 p-8 shadow-2xl shadow-slate-200/60 backdrop-blur-xl md:p-12">
            <div class="mb-10 text-center">
                <div
                    class="mb-4 inline-flex h-16 w-16 rotate-3 items-center justify-center rounded-2xl bg-indigo-600 shadow-lg shadow-indigo-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h2 class="text-4xl font-black uppercase italic tracking-tighter text-slate-800">
                    Get <span class="text-indigo-600">Started</span>
                </h2>
                <p class="mt-2 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Daftar untuk akses booking
                    eksklusif</p>
            </div>

            @if ($errors->any())
                <div
                    class="alert alert-error mb-6 rounded-2xl py-3 text-xs font-bold uppercase text-white shadow-lg shadow-rose-100">
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form action="{{ url("/register") }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="form-control">
                        <label class="label text-[10px] font-black uppercase text-slate-500">Full Name</label>
                        <div class="relative">
                            <input type="text" name="name" value="{{ old("name") }}"
                                class="input input-bordered w-full rounded-2xl bg-slate-50 pl-11 font-bold transition-all focus:border-indigo-600"
                                placeholder="John Doe" required>
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-3.5 h-5 w-5 text-slate-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                    <div class="form-control">
                        <label class="label text-[10px] font-black uppercase text-slate-500">WhatsApp</label>
                        <div class="relative">
                            <input type="text" name="phone" value="{{ old("phone") }}"
                                class="input input-bordered w-full rounded-2xl bg-slate-50 pl-11 font-bold focus:border-indigo-600"
                                placeholder="0812..." required>
                            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-3.5 h-5 w-5 text-slate-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label text-[10px] font-black uppercase text-slate-500">Email Address</label>
                    <div class="relative">
                        <input type="email" name="email" value="{{ old("email") }}"
                            class="input input-bordered w-full rounded-2xl bg-slate-50 pl-11 font-bold focus:border-indigo-600"
                            placeholder="mail@example.com" required>
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-3.5 h-5 w-5 text-slate-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                </div>

                <div class="form-control">
                    <label class="label text-[10px] font-black uppercase text-slate-500">Home Address</label>
                    <div class="relative">
                        <textarea name="address"
                            class="textarea textarea-bordered h-24 w-full rounded-2xl bg-slate-50 pl-11 pt-3 font-bold focus:border-indigo-600"
                            placeholder="Jl. Raya No. 123, Jakarta..." required>{{ old("address") }}</textarea>
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-4 top-3.5 h-5 w-5 text-slate-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                </div>

                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="form-control">
                        <label class="label text-[10px] font-black uppercase text-slate-500">Password</label>
                        <input type="password" name="password"
                            class="input input-bordered rounded-2xl bg-slate-50 font-bold focus:border-indigo-600" required>
                    </div>
                    <div class="form-control">
                        <label class="label text-[10px] font-black uppercase text-slate-500">Confirm</label>
                        <input type="password" name="password_confirmation"
                            class="input input-bordered rounded-2xl bg-slate-50 font-bold focus:border-indigo-600" required>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit"
                        class="btn h-16 w-full rounded-2xl border-none bg-indigo-600 font-black uppercase tracking-widest text-white shadow-xl shadow-indigo-200 transition-all hover:scale-[1.02] hover:bg-indigo-700 active:scale-95">
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-10 text-center">
                <p class="text-xs font-bold uppercase tracking-tight text-slate-400">
                    Sudah punya akun? <a href="{{ url("/login") }}" class="ml-1 text-indigo-600 hover:underline">Login
                        Sekarang</a>
                </p>
            </div>
        </div>
    </div>
@endsection
