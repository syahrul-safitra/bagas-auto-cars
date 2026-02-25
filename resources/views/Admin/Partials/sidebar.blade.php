<div class="drawer-side z-40">
    <label for="sidebar-drawer" class="drawer-overlay"></label>
    <aside class="flex min-h-full w-72 flex-col border-r border-slate-200 bg-white px-6 py-8">

        <div class="mb-10 flex items-center gap-3 px-2">
            <div
                class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white shadow-lg shadow-indigo-200">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                    <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"></path>
                </svg>
            </div>
            <span class="text-xl font-black uppercase italic tracking-tighter text-slate-800">BAGAS<span
                    class="text-indigo-600">AUTO</span></span>
        </div>

        <ul class="menu w-full gap-2 p-0 font-medium text-slate-600">
            <li class="menu-title mb-2 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Main
                Dashboard</li>

            {{-- DASHBOARD --}}
            <li>
                <a href="{{ url("/admin/dashboard") }}"
                    class="{{ Request::is("admin/dashboard") ? "bg-indigo-50 text-indigo-600 shadow-sm" : "hover:bg-slate-50" }} group flex gap-4 rounded-xl px-4 py-3 transition-all">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3">
                        </path>
                    </svg>
                    Dashboard
                </a>
            </li>

            <li class="menu-title mb-2 mt-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                Inventory</li>

            {{-- CATEGORIES / MEREK --}}
            <li>
                <a href="{{ url("/admin/categories") }}"
                    class="{{ Request::is("admin/categories*") ? "bg-indigo-50 text-indigo-600 shadow-sm" : "hover:bg-slate-50" }} group flex gap-4 rounded-xl px-4 py-3 transition-all">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01">
                        </path>
                    </svg>
                    Data Merek
                </a>
            </li>

            {{-- CARS --}}
            <li>
                <a href="{{ url("/admin/cars") }}"
                    class="{{ Request::is("admin/cars*") ? "bg-indigo-50 text-indigo-600 shadow-sm" : "hover:bg-slate-50" }} group flex gap-4 rounded-xl px-4 py-3 transition-all">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0zM13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h5a1 1 0 011 1v10a1 1 0 01-1 1h-1">
                        </path>
                    </svg>
                    Koleksi Mobil
                </a>
            </li>

            <li class="menu-title mb-2 mt-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                Sales & Users</li>

            {{-- BOOKINGS --}}
            <li>
                <a href="{{ url("/admin/bookings") }}"
                    class="{{ Request::is("admin/bookings*") ? "bg-indigo-50 text-indigo-600 shadow-sm" : "hover:bg-slate-50" }} group flex gap-4 rounded-xl px-4 py-3 transition-all">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                        </path>
                    </svg>
                    Pesanan Masuk
                </a>
            </li>

            {{-- CUSTOMERS --}}
            <li>
                <a href="{{ url("/admin/customers") }}"
                    class="{{ Request::is("admin/customers*") ? "bg-indigo-50 text-indigo-600 shadow-sm" : "hover:bg-slate-50" }} group flex gap-4 rounded-xl px-4 py-3 transition-all">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    Data Pelanggan
                </a>
            </li>

            <li class="menu-title mb-2 mt-6 text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">
                System</li>
            <li>
                <form action="{{ url("logout") }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="group flex w-full gap-4 rounded-xl px-4 py-3 text-rose-500 transition-all hover:bg-rose-50">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Logout Account
                    </button>
                </form>
            </li>
        </ul>

        <div class="mt-auto rounded-2xl border border-slate-100 bg-slate-50 p-5 shadow-inner">
            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Inventory System</p>
            <p class="text-xs font-black text-slate-700">BAGAS AUTO v1.0</p>
        </div>
    </aside>
</div>
