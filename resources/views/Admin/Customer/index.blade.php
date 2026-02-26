@extends("Admin.Layouts.main")

@section("content")
    <div class="animate-[fadeIn_0.5s_ease-out] p-8">

        {{-- Alert Success --}}
        @if (session("success"))
            <div class="mb-6 animate-[slideDown_0.5s_ease-out]">
                <div
                    class="flex items-center gap-4 rounded-[2rem] border border-emerald-100 bg-emerald-50 p-4 shadow-lg shadow-emerald-100/50">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-emerald-500 text-white shadow-md shadow-emerald-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-[10px] font-black uppercase italic tracking-widest text-emerald-600">Success
                            Notification</p>
                        <p class="text-xs font-bold text-emerald-800">{{ session("success") }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="btn btn-ghost btn-xs btn-circle text-emerald-400">✕</button>
                </div>
            </div>
        @endif

        {{-- Alert Error --}}
        @if (session("error"))
            <div class="mb-6 animate-[slideDown_0.5s_ease-out]">
                <div
                    class="flex items-center gap-4 rounded-[2rem] border border-rose-100 bg-rose-50 p-4 shadow-lg shadow-rose-100/50">
                    <div
                        class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-rose-500 text-white shadow-md shadow-rose-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-[10px] font-black uppercase italic tracking-widest text-rose-600">Error Notification
                        </p>
                        <p class="text-xs font-bold text-rose-800">{{ session("error") }}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()"
                        class="btn btn-ghost btn-xs btn-circle text-rose-400">✕</button>
                </div>
            </div>
        @endif

        {{-- Header Section --}}
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h2 class="text-3xl font-black uppercase italic tracking-tighter text-slate-800">
                    Customer <span class="text-indigo-600">Database</span>
                </h2>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">
                    Total Pelanggan Terdaftar: {{ $customers->total() }}
                </p>
            </div>

            {{-- Search Bar --}}
            <div class="flex gap-2">
                <form action="" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request("search") }}"
                        placeholder="Cari Nama / Email / HP..."
                        class="input input-bordered rounded-xl border-slate-200 bg-white pl-10 text-[10px] font-black uppercase tracking-widest focus:border-indigo-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-3 h-4 w-4 text-slate-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>
            </div>
        </div>

        {{-- Table Card --}}
        <div class="card overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-xl shadow-slate-200/50">
            <div class="overflow-x-auto">
                <table class="table w-full border-separate border-spacing-0">
                    <thead class="bg-slate-50 text-[10px] font-black uppercase tracking-widest text-slate-500">
                        <tr>
                            <th class="p-6">Informasi Pelanggan</th>
                            <th>Kontak</th>
                            <th class="text-center">Total Booking</th>
                            <th>Terdaftar Pada</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs font-bold text-slate-600">
                        @forelse ($customers as $item)
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="flex h-10 w-10 items-center justify-center rounded-full bg-indigo-100 text-sm font-black uppercase text-indigo-600">
                                            {{ substr($item->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <p class="font-black uppercase italic text-slate-800">{{ $item->name }}</p>
                                            <p class="text-[9px] lowercase italic tracking-tighter text-slate-400">UID:
                                                #CUST-{{ $item->id }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="text-slate-700">{{ $item->email }}</p>
                                    <p class="text-[10px] font-black text-indigo-500">{{ $item->phone }}</p>
                                </td>
                                <td class="text-center">
                                    <span
                                        class="inline-flex h-7 w-7 items-center justify-center rounded-lg bg-slate-100 text-[10px] font-black text-slate-700">
                                        {{ $item->bookings_count }}
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="font-medium text-slate-400">{{ $item->created_at->format("d M Y") }}</span>
                                </td>
                                <td class="text-center">
                                    <div class="flex justify-center gap-2">
                                        {{-- WhatsApp Direct --}}
                                        <a href="https://wa.me/{{ preg_replace("/[^0-9]/", "", $item->phone) }}"
                                            target="_blank"
                                            class="btn btn-square btn-ghost btn-sm text-emerald-500 transition-all hover:bg-emerald-50">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                            </svg>
                                        </a>

                                        {{-- Delete --}}
                                        <button type="button"
                                            onclick="prepareDelete('{{ $item->id }}', '{{ $item->name }}')"
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
                        @empty
                            <tr>
                                <td colspan="5" class="p-20 text-center">
                                    <div class="flex flex-col items-center opacity-30">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mb-4 h-20 w-20" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <p class="text-xl font-black uppercase italic tracking-widest">Customer Tidak
                                            Ditemukan</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="border-t border-slate-50 bg-slate-50/30 p-6">
                {{ $customers->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL DELETE GLOBAL --}}
    <dialog id="delete_modal_global" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box overflow-hidden rounded-[2.5rem] bg-white p-0 shadow-2xl">
            <div class="bg-rose-500 p-6 text-center text-white">
                <h3 class="text-xl font-black uppercase italic tracking-tighter">Hapus <span
                        class="text-rose-200">Customer</span></h3>
            </div>
            <div class="p-8 text-center">
                <p class="text-sm font-bold text-slate-600">
                    Hapus data <span id="display_customer_name" class="font-black text-rose-600"></span>?
                </p>
                <p class="mt-2 text-[10px] font-black uppercase italic leading-relaxed tracking-widest text-slate-400">
                    *Menghapus customer akan berdampak pada riwayat booking mereka di sistem.
                </p>
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

    <script>
        function prepareDelete(id, name) {
            const form = document.getElementById('form_delete_global');
            const displayText = document.getElementById('display_customer_name');
            const modal = document.getElementById('delete_modal_global');

            form.action = '/admin/customers/' + id;
            displayText.innerText = name;
            modal.showModal();
        }
    </script>
@endsection
