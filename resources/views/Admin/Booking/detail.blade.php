@extends("Admin.Layouts.main")

<style>
    /* Menghilangkan panah input number agar tetap clean */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }
</style>

@section("content")
    <div class="mx-auto max-w-6xl animate-[fadeIn_0.5s_ease-out] p-8">

        {{-- ALERT SUCCESS --}}
        @if (session("success"))
            <div
                class="mb-6 flex items-center justify-between rounded-[1.5rem] border border-emerald-100 bg-emerald-50 px-6 py-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-emerald-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-[11px] font-black uppercase tracking-widest text-emerald-700">
                        {{ session("success") }}
                    </span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-emerald-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        {{-- ALERT ERROR --}}
        @if (session("error"))
            <div
                class="mb-6 flex items-center justify-between rounded-[1.5rem] border border-rose-100 bg-rose-50 px-6 py-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-rose-500 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <span class="text-[11px] font-black uppercase tracking-widest text-rose-700">
                        {{ session("error") }}
                    </span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-rose-400 hover:text-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        @endif

        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <nav class="mb-2 text-[9px] font-black uppercase tracking-widest text-slate-400">
                    <a href="/admin/bookings" class="transition-colors hover:text-indigo-600">Bookings</a> /
                    <span>Detail</span>
                </nav>
                <h2 class="text-3xl font-black uppercase italic tracking-tighter text-slate-800">
                    Booking <span class="text-indigo-600">Detail</span>
                </h2>
                <p class="text-[10px] font-bold uppercase tracking-tight text-slate-400">ID Transaksi:
                    {{ $booking->booking_code }}</p>
            </div>

            <button onclick="update_status_modal.showModal()"
                class="btn rounded-2xl border-none bg-slate-900 px-8 text-[10px] font-black uppercase tracking-widest text-white shadow-xl shadow-slate-200 hover:bg-indigo-600">
                Ubah Status
            </button>
        </div>

        <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
            <div class="space-y-6 lg:col-span-2">
                <div class="card rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
                    <div class="mb-8 flex gap-6">
                        <img src="{{ asset("uploads/thumbnails/" . $booking->car->thumbnail) }}"
                            class="h-32 w-48 rounded-[1.5rem] object-cover shadow-md">
                        <div>
                            <span
                                class="text-[10px] font-black uppercase tracking-widest text-indigo-600">{{ $booking->car->category->name }}</span>
                            <h3 class="text-2xl font-black uppercase italic text-slate-800">{{ $booking->car->name }}</h3>
                            <p class="text-sm font-bold uppercase tracking-tight text-slate-400">{{ $booking->car->year }} •
                                {{ $booking->car->transmission }}</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-8 border-t border-dashed border-slate-100 pt-8">
                        <div>
                            <p class="mb-1 text-[9px] font-black uppercase tracking-widest text-slate-400">Customer</p>
                            <p class="text-sm font-bold text-slate-800">{{ $booking->customer->name }}</p>
                            <p class="text-[10px] font-medium text-slate-500">{{ $booking->customer->email }}</p>
                        </div>
                        <div>
                            <p class="mb-1 text-[9px] font-black uppercase tracking-widest text-slate-400">WhatsApp</p>
                            <p class="text-sm font-bold text-slate-800">{{ $booking->customer->phone }}</p>
                        </div>
                        <div class="col-span-2">
                            <p class="mb-1 text-[9px] font-black uppercase tracking-widest text-slate-400">Customer Notes
                            </p>
                            <p class="text-sm font-medium italic text-slate-600">
                                "{{ $booking->notes ?? "Tidak ada catatan." }}"</p>
                        </div>
                    </div>
                </div>

                <div class="card rounded-[2.5rem] border border-slate-100 bg-white p-8 shadow-sm">
                    <h4 class="mb-6 text-[11px] font-black uppercase tracking-widest text-slate-800">Bukti Pembayaran DP
                    </h4>
                    @if ($booking->bukti_dp)
                        <div
                            class="group relative cursor-pointer overflow-hidden rounded-[1.5rem] border border-slate-100 shadow-inner">
                            <img src="{{ asset("uploads/bukti_pembayaran/" . $booking->bukti_dp) }}"
                                class="max-h-[400px] w-full object-contain">
                            <a href="{{ asset("uploads/bukti_pembayaran/" . $booking->bukti_dp) }}" target="_blank"
                                class="absolute inset-0 flex items-center justify-center bg-slate-900/40 opacity-0 transition-opacity group-hover:opacity-100">
                                <span
                                    class="rounded-full bg-slate-900 px-6 py-3 text-[10px] font-black uppercase text-white">Buka
                                    Gambar Penuh</span>
                            </a>
                        </div>
                    @else
                        <div class="rounded-[2rem] border-2 border-dashed border-slate-100 py-12 text-center">
                            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Belum ada bukti
                                transfer diunggah.</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="space-y-6">
                <div class="card rounded-[2.5rem] bg-slate-900 p-8 text-white shadow-2xl">
                    <p class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Booking Fee</p>
                    <h2 class="mt-2 text-3xl font-black italic tracking-tighter text-indigo-400">Rp
                        {{ number_format($booking->booking_fee, 0, ",", ".") }}</h2>

                    <div class="divider opacity-10"></div>

                    <div class="space-y-4">
                        <div>
                            <p class="text-[9px] font-black uppercase text-slate-500">Payment Status</p>
                            <p class="mt-1 text-xs font-black uppercase italic tracking-widest text-white">
                                {{ str_replace("_", " ", $booking->payment_status) }}</p>
                        </div>
                        <div>
                            <p class="text-[9px] font-black uppercase text-slate-500">Booking Status</p>
                            <p class="mt-1 text-xs font-black uppercase italic tracking-widest text-indigo-400">
                                {{ $booking->booking_status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <dialog id="update_status_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box overflow-hidden rounded-[2.5rem] bg-white p-0 shadow-2xl">
            <div class="bg-indigo-600 p-8 text-white">
                <h3 class="text-2xl font-black uppercase italic tracking-tighter">Update <span
                        class="text-indigo-200">Status</span></h3>
            </div>

            <form action="{{ url("admin/booking/update", $booking->booking_code) }}" method="POST"
                class="space-y-6 p-8">
                @csrf
                @method("PUT")

                {{-- Input Edit Booking Fee --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label text-[10px] font-black uppercase tracking-widest text-slate-500">Booking Fee
                            (Rp)</span>
                    </label>
                    <input type="number" name="booking_fee" value="{{ $booking->booking_fee }}"
                        class="input input-bordered w-full rounded-2xl border-slate-200 bg-slate-50 font-bold focus:border-indigo-600"
                        placeholder="Masukkan nominal...">
                </div>

                {{-- Input Payment Status --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label text-[10px] font-black uppercase tracking-widest text-slate-500">Payment
                            Status</span>
                    </label>
                    <select name="payment_status"
                        class="select select-bordered w-full rounded-2xl border-slate-200 bg-slate-50 font-bold focus:border-indigo-600">
                        @foreach (["Pending", "Waiting_Verification", "Success", "Paid_Off", "Cancelled"] as $ps)
                            <option value="{{ $ps }}" {{ $booking->payment_status == $ps ? "selected" : "" }}>
                                {{ str_replace("_", " ", $ps) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Input Booking Status --}}
                <div class="form-control">
                    <label class="label">
                        <span class="label text-[10px] font-black uppercase tracking-widest text-slate-500">Booking
                            Status</span>
                    </label>
                    <select name="booking_status"
                        class="select select-bordered w-full rounded-2xl border-slate-200 bg-slate-50 font-bold focus:border-indigo-600">
                        @foreach (["Process", "Deal", "Failed"] as $bs)
                            <option value="{{ $bs }}" {{ $booking->booking_status == $bs ? "selected" : "" }}>
                                {{ $bs }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="modal-action mt-8 grid grid-cols-2 gap-4">
                    <button type="button" onclick="update_status_modal.close()"
                        class="btn btn-ghost rounded-2xl font-black uppercase tracking-widest text-slate-400">Batal</button>
                    <button type="submit"
                        class="btn rounded-2xl border-none bg-indigo-600 font-black uppercase tracking-widest text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/60 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>

    <script>
        setTimeout(function() {
            const alerts = document.querySelectorAll('.mb-6.flex.items-center');
            alerts.forEach(alert => {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
@endsection
