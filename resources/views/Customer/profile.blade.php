@extends('Customer.Layouts.main')

@section('container')
    <div class="mx-auto max-w-6xl px-6 pt-24 pb-12 md:pt-32 animate-[fadeIn_0.5s_ease-out]">

        {{-- Alert Success --}}
        @if (session('success'))
            <div
                class="mb-8 flex items-center gap-4 rounded-[2rem] border border-emerald-100 bg-emerald-50 p-4 text-emerald-700">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-emerald-500 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <p class="text-[10px] font-black uppercase tracking-widest">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-12">

            <div class="lg:col-span-1 space-y-6">
                <div
                    class="card rounded-[2.5rem] bg-white border border-slate-100 p-8 shadow-xl shadow-slate-200/50 text-center">
                    <div
                        class="mx-auto mb-4 flex h-20 w-20 items-center justify-center rounded-full bg-indigo-600 text-3xl font-black text-white italic">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <h3 class="text-xl font-black uppercase italic tracking-tighter text-slate-800">{{ $user->name }}</h3>
                    <p class="text-[10px] font-bold uppercase text-slate-400 tracking-widest">{{ $user->email }}</p>

                    <div class="divider opacity-50 my-6"></div>

                    <div class="text-left space-y-4 mb-8">
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">WhatsApp</p>
                            <p class="text-xs font-bold text-slate-800">{{ $user->phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Alamat</p>
                            <p class="text-xs font-bold text-slate-800">{{ $user->address ?? 'Belum diatur' }}</p>
                        </div>
                    </div>

                    <button onclick="edit_profile_modal.showModal()"
                        class="btn btn-outline btn-indigo-600 w-full rounded-2xl font-black uppercase text-[10px] tracking-widest hover:bg-indigo-600 hover:text-white border-2">
                        Edit Profile
                    </button>
                </div>
            </div>

            <div class="lg:col-span-3">
                <div class="mb-8">
                    <h2 class="text-3xl font-black uppercase italic tracking-tighter text-slate-800">
                        My <span class="text-indigo-600">Bookings</span>
                    </h2>
                    <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Riwayat transaksi pemesanan
                        unit Anda</p>
                </div>

                @if ($bookings->isEmpty())
                    <div class="rounded-[2.5rem] border-2 border-dashed border-slate-100 p-20 text-center bg-white/50">
                        <p class="text-xs font-black uppercase tracking-widest text-slate-400">Belum ada riwayat booking.
                        </p>
                        <a href="/"
                            class="mt-4 inline-block text-[10px] font-black uppercase text-indigo-600 underline underline-offset-4">Cari
                            Unit Sekarang</a>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach ($bookings as $item)
                            <div
                                class="group card rounded-[2rem] bg-white border border-slate-100 p-6 shadow-md transition-all hover:shadow-xl hover:-translate-y-1">
                                <div class="flex flex-col md:flex-row items-center gap-6">
                                    <img src="{{ asset('uploads/thumbnails/' . $item->car->thumbnail) }}"
                                        class="h-20 w-32 rounded-2xl object-cover shadow-sm">

                                    <div class="flex-1 text-center md:text-left">
                                        <p class="text-[9px] font-black text-indigo-600 uppercase tracking-widest">
                                            {{ $item->booking_code }}</p>
                                        <h4 class="text-lg font-black uppercase italic text-slate-800 leading-tight">
                                            {{ $item->car->name }}</h4>
                                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-tight">
                                            {{ $item->created_at->format('d M Y') }}</p>
                                    </div>

                                    <div class="flex flex-col items-center md:items-end gap-2">
                                        @php
                                            $statusClass = [
                                                'Pending' => 'bg-amber-50 text-amber-600 ring-amber-100',
                                                'Success' => 'bg-emerald-50 text-emerald-600 ring-emerald-100',
                                                'Cancelled' => 'bg-rose-50 text-rose-600 ring-rose-100',
                                            ];
                                        @endphp
                                        <span
                                            class="rounded-full px-4 py-1 text-[9px] font-black uppercase tracking-widest ring-1 {{ $statusClass[$item->payment_status] ?? 'bg-slate-50 text-slate-400 ring-slate-100' }}">
                                            {{ $item->payment_status }}
                                        </span>
                                        <a href="{{ url('booking/detail', $item->booking_code) }}"
                                            class="text-[10px] font-black uppercase text-indigo-600 hover:text-indigo-800 underline underline-offset-4">Detail
                                            Unit</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>

    <dialog id="edit_profile_modal" class="modal modal-bottom sm:modal-middle" {{ $errors->any() ? 'open' : '' }}>
        <div class="modal-box p-0 rounded-[2.5rem] bg-white overflow-hidden shadow-2xl flex flex-col max-h-[90vh]">

            <div class="bg-indigo-600 p-6 md:p-8 text-white shrink-0">
                <h3 class="text-2xl font-black uppercase italic tracking-tighter">Edit <span
                        class="text-indigo-200">Profile</span></h3>
                @if ($errors->any())
                    <p class="text-[10px] font-bold uppercase tracking-widest text-rose-300 mt-1">Terjadi kesalahan pada
                        input Anda</p>
                @else
                    <p class="text-[10px] font-bold uppercase tracking-widest opacity-70 mt-1">Perbarui data akun Anda</p>
                @endif
            </div>

            <form action="{{ 'profile/' . $user->id }}" method="POST" class="flex flex-col overflow-hidden">
                @csrf
                @method('PUT')

                <div class="p-6 md:p-8 space-y-5 overflow-y-auto custom-scrollbar" style="max-height: calc(90vh - 200px);">

                    <div class="form-control">
                        <label class="label pt-0"><span
                                class="label text-[10px] font-black uppercase text-slate-500 tracking-widest">Nama
                                Lengkap</span></label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="input input-bordered rounded-2xl bg-slate-50 font-bold focus:border-indigo-600 @error('name') border-rose-500 @enderror">
                        @error('name')
                            <span
                                class="text-[10px] font-bold text-rose-500 mt-1 uppercase italic tracking-tight">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="form-control">
                            <label class="label pt-0"><span
                                    class="label text-[10px] font-black uppercase text-slate-500 tracking-widest">Email
                                    Address</span></label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="input input-bordered rounded-2xl bg-slate-50 font-bold focus:border-indigo-600 @error('email') border-rose-500 @enderror">
                            @error('email')
                                <span
                                    class="text-[10px] font-bold text-rose-500 mt-1 uppercase italic tracking-tight">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label class="label pt-0"><span
                                    class="label text-[10px] font-black uppercase text-slate-500 tracking-widest">WhatsApp</span></label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="input input-bordered rounded-2xl bg-slate-50 font-bold focus:border-indigo-600 @error('phone') border-rose-500 @enderror">
                            @error('phone')
                                <span
                                    class="text-[10px] font-bold text-rose-500 mt-1 uppercase italic tracking-tight">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-control">
                        <label class="label pt-0"><span
                                class="label text-[10px] font-black uppercase text-slate-500 tracking-widest">Alamat
                                Lengkap</span></label>
                        <textarea name="address"
                            class="textarea textarea-bordered h-20 rounded-2xl bg-slate-50 font-bold focus:border-indigo-600 @error('address') border-rose-500 @enderror text-sm">{{ old('address', $user->address) }}</textarea>
                        @error('address')
                            <span
                                class="text-[10px] font-bold text-rose-500 mt-1 uppercase italic tracking-tight">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="divider opacity-50 my-2"></div>

                    <div class="form-control">
                        <label class="label pt-0"><span
                                class="label text-[10px] font-black uppercase text-slate-500 tracking-widest">Password
                                Baru</span></label>
                        <input type="password" name="password"
                            class="input input-bordered rounded-2xl bg-slate-50 font-bold focus:border-indigo-600 @error('password') border-rose-500 @enderror"
                            placeholder="Kosongkan jika tidak ingin diubah">
                        @error('password')
                            <span
                                class="text-[10px] font-bold text-rose-500 mt-1 uppercase italic tracking-tight">{{ $message }}</span>
                        @else
                            <p class="mt-2 text-[9px] font-bold text-slate-400 italic uppercase">*Minimal 8 karakter jika ingin
                                diubah</p>
                        @enderror
                    </div>
                </div>

                <div class="p-6 bg-slate-50 border-t border-slate-100 grid grid-cols-2 gap-4 shrink-0">
                    <button type="button" onclick="edit_profile_modal.close()"
                        class="btn btn-ghost rounded-2xl font-black uppercase text-slate-400 tracking-widest text-[10px]">Batal</button>
                    <button type="submit"
                        class="btn bg-indigo-600 hover:bg-indigo-700 border-none rounded-2xl font-black uppercase text-white tracking-widest text-[10px] shadow-lg shadow-indigo-100">Simpan</button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/60 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>
@endsection
