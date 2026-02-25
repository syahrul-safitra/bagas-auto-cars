@extends("Admin.Layouts.main")

@section("title", "Daftar Merek Mobil")

@section("content")
    <div class="animate-[fadeIn_0.4s_ease-out] space-y-6">

        <div class="flex flex-col justify-between gap-6 md:flex-row md:items-end">
            <div>
                <div class="mb-1 flex items-center gap-2">
                    <span class="h-2 w-8 rounded-full bg-indigo-600"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600/60">Automotive
                        Brands</span>
                </div>
                <h2 class="text-3xl font-black uppercase italic tracking-tight text-slate-800">Daftar <span
                        class="text-indigo-600">Merek</span></h2>
                <p class="text-sm font-medium text-slate-500">Kelola kategori pabrikan mobil yang tersedia di katalog
                    showroom.</p>
            </div>

            <a href="{{ url("admin/categories/create") }}"
                class="btn btn-primary group rounded-2xl border-none bg-indigo-600 px-6 normal-case text-white shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700 hover:shadow-indigo-200">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5 transition-transform group-hover:rotate-90"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Merek Baru
            </a>
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
                            <th>Nama Pabrikan</th>
                            <th class="text-center">Total Unit</th>
                            <th class="pr-10 text-center">Opsi</th>
                        </tr>
                    </thead>

                    <tbody class="text-slate-600">
                        @forelse ($categories as $item)
                            <tr class="group border-b border-slate-50 transition-all hover:bg-slate-50/30">
                                <td class="py-5 pl-10 text-center">
                                    <span
                                        class="text-xs font-black text-slate-300 group-hover:text-indigo-400">{{ $loop->iteration }}</span>
                                </td>

                                <td class="py-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-black uppercase tracking-tight text-slate-700">{{ $item->name }}</span>
                                        <span class="text-[10px] font-bold italic text-slate-400">Slug:
                                            {{ $item->slug }}</span>
                                    </div>
                                </td>

                                <td class="py-5 text-center">
                                    <div
                                        class="badge badge-ghost h-7 rounded-lg border-none bg-slate-100 px-4 text-[11px] font-black text-slate-500">
                                        {{ $item->cars_count ?? 0 }} Unit
                                    </div>
                                </td>

                                <td class="py-5 pr-10 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ url("admin/categories/" . $item->slug . "/edit") }}"
                                            class="btn btn-ghost btn-sm btn-square rounded-xl border border-transparent text-slate-400 hover:border-amber-100 hover:bg-amber-50 hover:text-amber-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v12a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <button type="button"
                                            onclick="prepareDelete('{{ $item->slug }}', '{{ $item->name }}')"
                                            class="btn btn-ghost btn-sm btn-square rounded-xl border border-transparent text-slate-400 hover:border-rose-100 hover:bg-rose-50 hover:text-rose-500">
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
                                <td colspan="5" class="py-24 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="mb-4 rounded-[3rem] bg-slate-50 p-10 text-slate-200">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                            </svg>
                                        </div>
                                        <p class="text-lg font-black tracking-tight text-slate-400">Database Kosong</p>
                                        <p class="text-xs font-medium text-slate-400">Belum ada merek mobil yang
                                            didaftarkan.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <dialog id="delete_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box max-w-sm rounded-[3rem] border border-slate-100 bg-white p-10 shadow-2xl">
            <div class="flex flex-col items-center text-center">
                <div
                    class="mb-6 flex h-24 w-24 items-center justify-center rounded-full bg-rose-50 text-rose-500 ring-[12px] ring-rose-50/50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <h3 class="text-xl font-black tracking-tight text-slate-800">Konfirmasi Hapus</h3>
                <p class="mt-3 text-sm font-medium leading-relaxed text-slate-400">
                    Merek <span id="delete_name_label" class="font-black uppercase text-slate-700"></span> akan dihapus.
                    Unit mobil dengan merek ini mungkin akan terpengaruh.
                </p>
            </div>

            <div class="mt-10 flex flex-col gap-3">
                <form id="delete_form_actual" method="POST">
                    @csrf
                    @method("DELETE")
                    <button type="submit"
                        class="btn btn-error w-full rounded-2xl border-none bg-rose-500 font-black uppercase tracking-widest text-white shadow-lg shadow-rose-100 hover:bg-rose-600">
                        Hapus Permanen
                    </button>
                </form>
                <form method="dialog">
                    <button class="btn btn-ghost w-full rounded-2xl font-bold text-slate-400">Batalkan</button>
                </form>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/40 backdrop-blur-sm">
            <button>close</button>
        </form>
    </dialog>

    <script>
        function prepareDelete(id, name) {
            const modal = document.getElementById('delete_modal');
            const form = document.getElementById('delete_form_actual');
            const label = document.getElementById('delete_name_label');

            form.action = `/admin/categories/${id}`;
            label.innerText = name;
            modal.showModal();
        }
    </script>
@endsection
