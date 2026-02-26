@extends("Admin.Layouts.main")

@section("content")
    <div class="animate-[fadeIn_0.5s_ease-out] p-8">

        {{-- Alert --}}
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
                        <p class="text-[10px] font-black uppercase italic tracking-widest text-emerald-600">Berhasil!</p>
                        <p class="text-xs font-bold text-emerald-800">{{ session("success") }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Header --}}
        <div class="mb-8 flex flex-col justify-between gap-4 md:flex-row md:items-center">
            <div>
                <h2 class="text-3xl font-black uppercase italic tracking-tighter text-slate-800">
                    User <span class="text-indigo-600">Management</span>
                </h2>
                <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Kelola Akses Admin & Owner</p>
            </div>

            <div class="flex gap-4">
                {{-- Tombol Tambah User --}}
                <a href="{{ url("/admin/users/create") }}"
                    class="btn rounded-xl border-none bg-indigo-600 font-black uppercase italic tracking-widest text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah User
                </a>

                {{-- Form Search (yang sudah ada sebelumnya) --}}
                <div class="flex gap-4">
                    <form action="" method="GET" class="relative">
                        <input type="text" name="search" value="{{ request("search") }}" placeholder="Cari User..."
                            class="input input-bordered rounded-xl border-slate-200 bg-white pl-10 text-[10px] font-black uppercase tracking-widest focus:border-indigo-500">
                        <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-3 h-4 w-4 text-slate-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </form>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="card overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white shadow-xl shadow-slate-200/50">
            <div class="overflow-x-auto">
                <table class="table w-full border-separate border-spacing-0">
                    <thead class="bg-slate-50 text-[10px] font-black uppercase tracking-widest text-slate-500">
                        <tr>
                            <th class="p-6">Informasi Akun</th>
                            <th>Role / Jabatan</th>
                            <th>Dibuat</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-xs font-bold text-slate-600">
                        @foreach ($users as $user)
                            <tr class="transition-colors hover:bg-slate-50/50">
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="{{ $user->is_owner ? "bg-amber-100 text-amber-600" : "bg-indigo-100 text-indigo-600" }} flex h-10 w-10 items-center justify-center rounded-xl text-sm font-black uppercase">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-black uppercase italic text-slate-800">{{ $user->name }}</p>
                                            <p class="text-[10px] font-medium text-slate-400">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($user->is_owner)
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full border border-amber-200 bg-amber-100 px-3 py-1 text-[9px] font-black uppercase tracking-widest text-amber-700">
                                            <div class="h-1.5 w-1.5 animate-pulse rounded-full bg-amber-500"></div>
                                            Owner
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-1 rounded-full border border-indigo-100 bg-indigo-50 px-3 py-1 text-[9px] font-black uppercase tracking-widest text-indigo-600">
                                            Administrator
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="font-medium text-slate-400">{{ $user->created_at->format("d M Y") }}</span>
                                </td>

                                <td class="text-center">
                                    <div class="flex justify-center gap-2">
                                        {{-- TOMBOL EDIT --}}
                                        <a href="{{ url("/admin/users/" . $user->id . "/edit") }}"
                                            class="btn btn-square btn-ghost btn-sm text-indigo-500 hover:bg-indigo-50 hover:text-indigo-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2.828 2.828 0 114 4L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        {{-- TOMBOL HAPUS (Hanya muncul jika bukan owner yang sedang login) --}}
                                        @if (!$user->is_owner)
                                            <button type="button"
                                                onclick="prepareDelete('{{ $user->id }}', '{{ $user->name }}')"
                                                class="btn btn-square btn-ghost btn-sm text-rose-400 hover:bg-rose-50 hover:text-rose-600">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bg-slate-50/30 p-6">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL DELETE --}}
    <dialog id="delete_modal" class="modal modal-bottom sm:modal-middle">
        <div class="modal-box overflow-hidden rounded-[2.5rem] bg-white p-0 shadow-2xl">
            <div class="bg-rose-500 p-6 text-center text-white">
                <h3 class="text-xl font-black uppercase italic tracking-tighter text-white">Hapus <span
                        class="text-rose-200">User</span></h3>
            </div>
            <div class="p-8 text-center">
                <p class="text-sm font-bold text-slate-600">Hapus akses login untuk <span id="display_name"
                        class="font-black text-rose-600"></span>?</p>
                <div class="mt-8 grid grid-cols-2 gap-4">
                    <form method="dialog"><button
                            class="btn btn-ghost w-full rounded-2xl font-black uppercase tracking-widest text-slate-400">Batal</button>
                    </form>
                    <form id="form_delete" action="" method="POST">
                        @csrf @method("DELETE")
                        <button type="submit"
                            class="btn w-full rounded-2xl border-none bg-rose-600 font-black uppercase italic tracking-widest text-white shadow-lg shadow-rose-100 hover:bg-rose-700">Ya,
                            Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        <form method="dialog" class="modal-backdrop bg-slate-900/60 backdrop-blur-sm"><button>close</button></form>
    </dialog>

    <script>
        function prepareDelete(id, name) {
            document.getElementById('form_delete').action = '/admin/users/' + id;
            document.getElementById('display_name').innerText = name;
            document.getElementById('delete_modal').showModal();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.animate-\\[slideDown_0.5s_ease-out\\]');
            alerts.forEach(function(alert) {
                setTimeout(() => {
                    alert.style.transition = "opacity 0.5s, transform 0.5s";
                    alert.style.opacity = "0";
                    alert.style.transform = "translateY(-10px)";
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }, 3000);
            });
        });
    </script>
@endsection
