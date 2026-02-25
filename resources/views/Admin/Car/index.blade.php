@extends("Admin.Layouts.main")

@section("title", "Daftar Koleksi Mobil")

@section("content")
    <div class="animate-[fadeIn_0.4s_ease-out] space-y-6">

        <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
            <div>
                <div class="mb-1 flex items-center gap-2">
                    <span class="h-2 w-8 rounded-full bg-indigo-600"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600/60">Inventory
                        Management</span>
                </div>
                <h2 class="text-3xl font-black uppercase italic tracking-tight text-slate-800">Koleksi <span
                        class="text-indigo-600">Unit</span></h2>
                <p class="text-sm font-medium text-slate-500">Kelola stok unit kendaraan, harga, dan spesifikasi unit
                    showroom.</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ url("admin/cars/create") }}"
                    class="btn btn-primary group rounded-2xl border-none bg-indigo-600 px-6 normal-case text-white shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Tambah Unit Mobil
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <div class="card rounded-[2rem] border border-slate-100 bg-white p-6 shadow-sm">
                <span class="text-[10px] font-black uppercase tracking-widest text-slate-400">Total Stok</span>
                <h3 class="text-2xl font-black text-slate-800">{{ $cars->count() }} <span
                        class="text-sm font-medium text-slate-400">Unit</span></h3>
            </div>
        </div>

        @if (session("success"))
            <div
                class="alert rounded-[2rem] border-none bg-emerald-50 py-4 text-emerald-700 shadow-sm ring-1 ring-emerald-100">
                <div class="flex items-center gap-3">
                    <div class="rounded-full bg-emerald-500 p-1 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 stroke-current" fill="none"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-wider">{{ session("success") }}</span>
                </div>
            </div>
        @endif

        <div class="card overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-sm">
            <div class="overflow-x-auto">
                <table class="table-lg table w-full border-separate border-spacing-0">
                    <thead>
                        <tr class="bg-slate-50/50 text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                            <th class="py-6 pl-10 text-center">No</th>
                            <th>Unit</th>
                            <th>Info Detail</th>
                            <th>Harga & Status</th>
                            <th class="pr-10 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody class="text-slate-600">
                        @forelse ($cars as $item)
                            <tr class="group border-b border-slate-50 transition-all hover:bg-slate-50/30">
                                <td class="py-5 pl-10 text-center">
                                    <span class="text-xs font-black text-slate-300">{{ $loop->iteration }}</span>
                                </td>

                                <td class="py-5">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="h-16 w-24 overflow-hidden rounded-2xl border border-slate-100 bg-slate-100">
                                            @if ($item->thumbnail)
                                                <img src="{{ asset("uploads/thumbnails/" . $item->thumbnail) }}"
                                                    class="h-full w-full object-cover" alt="{{ $item->name }}">
                                            @else
                                                <div
                                                    class="flex h-full items-center justify-center text-[10px] font-bold text-slate-400">
                                                    NO IMG</div>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="font-black uppercase tracking-tight text-slate-700">{{ $item->name }}</span>
                                            <div
                                                class="badge border-none bg-indigo-50 px-2 py-2 text-[9px] font-black uppercase tracking-tighter text-indigo-600">
                                                {{ $item->category->name ?? "No Brand" }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-5">
                                    <div class="flex flex-col gap-1">
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-bold uppercase text-slate-400">Thn:</span>
                                            <span class="text-xs font-black text-slate-600">{{ $item->year }}</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="text-[10px] font-bold uppercase text-slate-400">KM:</span>
                                            <span
                                                class="text-xs font-black text-slate-600">{{ number_format($item->mileage, 0, ",", ".") }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="py-5">
                                    <div class="flex flex-col gap-1">
                                        <span class="font-black text-slate-700">Rp
                                            {{ number_format($item->price, 0, ",", ".") }}</span>
                                        @php
                                            $statusColor =
                                                [
                                                    "Available" => "bg-emerald-100 text-emerald-600",
                                                    "Sold" => "bg-rose-100 text-rose-600",
                                                    "Booked" => "bg-amber-100 text-amber-600"
                                                ][$item->status] ?? "bg-slate-100 text-slate-600";
                                        @endphp
                                        <span
                                            class="{{ $statusColor }} w-fit rounded-lg px-2 py-0.5 text-[9px] font-black uppercase tracking-widest">
                                            {{ $item->status }}
                                        </span>
                                    </div>
                                </td>

                                <td class="py-5 pr-10 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url("admin/cars/" . $item->slug . "/edit") }}"
                                            class="btn btn-ghost btn-sm btn-square rounded-xl text-slate-400 hover:bg-amber-50 hover:text-amber-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <button type="button"
                                            onclick="prepareDelete('{{ $item->slug }}', '{{ $item->name }}')"
                                            class="btn btn-ghost btn-sm btn-square rounded-xl text-slate-400 hover:bg-rose-50 hover:text-rose-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"
                                    class="py-24 text-center font-black uppercase tracking-widest text-slate-300">
                                    Data Mobil Belum Tersedia
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dialog id="delete_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box rounded-[2.5rem] bg-white p-10">
            <h3 class="text-xl font-black uppercase italic text-slate-800">Hapus <span class="text-rose-500">Unit</span>?
            </h3>
            <p class="py-4 text-sm font-medium text-slate-500">Anda akan menghapus unit <span id="delete_name_label"
                    class="font-black text-slate-800 underline"></span> secara permanen dari sistem.</p>
            <div class="modal-action flex justify-end gap-2">
                <form method="dialog">
                    <button class="btn btn-ghost rounded-2xl font-bold">Batal</button>
                </form>
                <form id="delete_form_actual" method="POST">
                    @csrf @method("DELETE")
                    <button type="submit"
                        class="btn btn-error rounded-2xl border-none bg-rose-500 px-8 font-black uppercase tracking-widest text-white">Hapus</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/40 backdrop-blur-sm"><button>close</button></form>
    </dialog>

    <script>
        function prepareDelete(id, name) {
            const modal = document.getElementById('delete_modal');
            const form = document.getElementById('delete_form_actual');
            const label = document.getElementById('delete_name_label');

            form.action = `/admin/cars/${id}`;
            label.innerText = name;
            modal.showModal();
        }
    </script>
@endsection
