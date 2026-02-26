@extends("Admin.Layouts.main")

@section("content")
    <div class="animate-[fadeIn_0.5s_ease-out] p-8">

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

        {{-- HEADER --}}
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h2 class="text-3xl font-black uppercase italic tracking-tighter text-slate-800">
                    Booking <span class="text-indigo-600">Management</span>
                </h2>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Total Transaksi Masuk:
                    {{ $bookings->total() }}</p>
            </div>

            <div class="flex gap-2">
                <form action="" method="GET" class="flex gap-2">
                    <select name="status" onchange="this.form.submit()"
                        class="select select-bordered rounded-xl border-slate-200 bg-white text-[10px] font-black uppercase">
                        <option value="">Semua Status</option>
                        <option value="Pending" {{ request("status") == "Pending" ? "selected" : "" }}>Pending</option>
                        <option value="Waiting_Verification"
                            {{ request("status") == "Waiting_Verification" ? "selected" : "" }}>Waiting Verification
                        </option>
                        <option value="Success" {{ request("status") == "Success" ? "selected" : "" }}>Success (DP)</option>
                    </select>
                </form>

                {{-- Tombol Pemicu Modal --}}
                <button onclick="export_pdf_modal.showModal()"
                    class="btn btn-error rounded-xl border-none bg-rose-500 text-[10px] font-black uppercase text-white hover:bg-rose-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-1 h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Export PDF
                </button>

                {{-- MODAL EXPORT PDF --}}
                <dialog id="export_pdf_modal" class="modal modal-bottom sm:modal-middle">
                    <div class="modal-box overflow-hidden rounded-[2.5rem] bg-white p-0 shadow-2xl">
                        <div class="bg-indigo-600 p-6 text-center text-white">
                            <h3 class="text-xl font-black uppercase italic tracking-tighter">Export Laporan <span
                                    class="text-indigo-200">PDF</span></h3>
                        </div>
                        <form action="{{ url("export-pdf") }}" method="GET" target="_blank" class="p-8">
                            <div class="grid grid-cols-1 gap-4">
                                {{-- Filter Status --}}
                                <div class="form-control w-full">
                                    <label class="label"><span
                                            class="label-text text-[10px] font-black uppercase tracking-widest text-slate-400">Filter
                                            Status</span></label>
                                    <select name="status"
                                        class="select select-bordered rounded-xl font-bold text-slate-600">
                                        <option value="">Semua Status</option>
                                        <option value="Success">Success (DP)</option>
                                        <option value="Paid_Off">Lunas (Paid Off)</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </div>

                                {{-- Filter Tanggal --}}
                                <div class="grid grid-cols-2 gap-4">
                                    <div class="form-control">
                                        <label class="label"><span
                                                class="label-text text-[10px] font-black uppercase tracking-widest text-slate-400">Dari
                                                Tanggal</span></label>
                                        <input type="date" name="start_date"
                                            class="input input-bordered rounded-xl font-bold text-slate-600" required>
                                    </div>
                                    <div class="form-control">
                                        <label class="label"><span
                                                class="label-text text-[10px] font-black uppercase tracking-widest text-slate-400">Sampai
                                                Tanggal</span></label>
                                        <input type="date" name="end_date"
                                            class="input input-bordered rounded-xl font-bold text-slate-600" required>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-8 grid grid-cols-2 gap-4">
                                <button type="button" onclick="export_pdf_modal.close()"
                                    class="btn btn-ghost rounded-2xl font-black uppercase tracking-widest text-slate-400">Batal</button>
                                <button type="submit"
                                    class="btn rounded-2xl border-none bg-indigo-600 font-black uppercase tracking-widest text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700">Cetak
                                    Sekarang</button>
                            </div>
                        </form>
                    </div>
                    <form method="dialog" class="modal-backdrop bg-slate-900/60 backdrop-blur-sm"><button>close</button>
                    </form>
                </dialog>
            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="card overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-xl shadow-slate-200/50">
            <div class="overflow-x-auto">
                <table class="table w-full border-separate border-spacing-0">
                    <thead class="bg-slate-50 text-[10px] font-black uppercase tracking-widest text-slate-500">
                        <tr>
                            <th class="p-6">Customer & Unit</th>
                            <th>ID Transaksi</th>
                            <th>Tanda Jadi (DP)</th>
                            <th>Payment Status</th>
                            <th>Booking Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs font-bold text-slate-600">
                        @foreach ($bookings as $item)
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="h-12 w-16 shrink-0 overflow-hidden rounded-xl bg-slate-100">
                                            <img src="{{ asset("uploads/thumbnails/" . $item->car->thumbnail) }}"
                                                class="h-full w-full object-cover">
                                        </div>
                                        <div>
                                            <p class="font-black uppercase italic text-slate-800">{{ $item->car->name }}
                                            </p>
                                            <p class="text-[9px] uppercase tracking-tighter text-slate-400">
                                                {{ $item->customer->name }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td><span
                                        class="font-black uppercase tracking-tighter text-indigo-600">{{ $item->booking_code }}</span>
                                </td>
                                <td><span class="text-slate-800">Rp
                                        {{ number_format($item->booking_fee, 0, ",", ".") }}</span></td>
                                <td>
                                    @php
                                        $payClasses = [
                                            "Pending" => "bg-amber-50 text-amber-600 ring-amber-100",
                                            "Waiting_Verification" => "bg-blue-50 text-blue-600 ring-blue-100",
                                            "Success" => "bg-emerald-50 text-emerald-600 ring-emerald-100",
                                            "Paid_Off" => "bg-indigo-50 text-indigo-600 ring-indigo-100",
                                            "Cancelled" => "bg-rose-50 text-rose-600 ring-rose-100"
                                        ];
                                    @endphp
                                    <span
                                        class="{{ $payClasses[$item->payment_status] ?? "bg-slate-50" }} rounded-full px-3 py-1 text-[9px] font-black uppercase tracking-widest ring-1">
                                        {{ str_replace("_", " ", $item->payment_status) }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $bookClasses = [
                                            "Process" => "bg-slate-800 text-white",
                                            "Deal" => "bg-indigo-600 text-white",
                                            "Failed" => "bg-rose-600 text-white"
                                        ];
                                    @endphp
                                    <span
                                        class="{{ $bookClasses[$item->booking_status] ?? "bg-slate-200" }} rounded-full px-3 py-1 text-[9px] font-black uppercase tracking-widest">
                                        {{ $item->booking_status }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="flex justify-center gap-2">
                                        <a href="{{ url("admin/booking/" . $item->booking_code) }}"
                                            class="btn btn-square btn-ghost btn-sm text-slate-400 transition-all hover:text-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>

                                        @if ($item->bukti_dp)
                                            <a href="{{ asset("uploads/bukti_pembayaran/" . $item->bukti_dp) }}"
                                                target="_blank"
                                                class="btn btn-square btn-ghost btn-sm text-blue-500 transition-all hover:bg-blue-50">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                            </a>
                                        @endif

                                        <button type="button" onclick="prepareDelete('{{ $item->booking_code }}')"
                                            class="btn btn-square btn-ghost btn-sm text-rose-400 transition-all hover:bg-rose-50 hover:text-rose-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- PAGINATION --}}
            <div class="border-t border-slate-50 bg-slate-50/30 p-6">
                {{ $bookings->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL DELETE GLOBAL (DI LUAR LOOPING) --}}
    <dialog id="delete_modal_global" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box overflow-hidden rounded-[2.5rem] bg-white p-0 shadow-2xl">
            <div class="bg-rose-500 p-6 text-center text-white">
                <h3 class="text-xl font-black uppercase italic tracking-tighter">Konfirmasi <span
                        class="text-rose-200">Hapus</span></h3>
            </div>
            <div class="p-8 text-center">
                <p class="text-sm font-bold text-slate-600">
                    Apakah Anda yakin ingin menghapus data booking <span id="display_booking_code"
                        class="font-black text-rose-600"></span>?
                </p>
                <p class="mt-2 text-[10px] font-black uppercase italic tracking-widest text-slate-400">*Unit mobil akan
                    otomatis tersedia kembali.</p>
                <div class="mt-8 grid grid-cols-2 gap-4">
                    <form method="dialog"><button
                            class="btn btn-ghost w-full rounded-2xl font-black uppercase tracking-widest text-slate-400">Batal</button>
                    </form>
                    <form id="form_delete_global" action="" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit"
                            class="btn w-full rounded-2xl border-none bg-rose-600 font-black uppercase tracking-widest text-white shadow-lg shadow-rose-100 hover:bg-rose-700">Ya,
                            Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/60 backdrop-blur-sm"><button>close</button></form>
    </dialog>

    {{-- JAVASCRIPT SECTION --}}
    <script>
        // Fungsi untuk menyiapkan Modal Delete
        function prepareDelete(bookingCode) {
            const form = document.getElementById('form_delete_global');
            const displayText = document.getElementById('display_booking_code');
            const modal = document.getElementById('delete_modal_global');

            if (form && displayText && modal) {
                // Set action form (Sesuaikan prefix URL jika perlu)
                form.action = '/admin/booking/' + bookingCode;
                // Set text kode booking
                displayText.innerText = bookingCode;
                // Munculkan modal
                modal.showModal();
            }
        }

        // Auto hide alert
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
