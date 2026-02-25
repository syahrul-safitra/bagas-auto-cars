<!DOCTYPE html>
<html lang="id" data-theme="light">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield("title", "Admin | Bagas Auto Cars")</title>
        @vite("resources/css/app.css")
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
            rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            /* Sembunyikan grup tombol attachment pada toolbar Trix */
            trix-toolbar .trix-button-group--file-tools {
                display: none !important;
            }
        </style>

        <style>
            /* Menyesuaikan tampilan Trix dengan tema modern kita */
            trix-editor {
                border-radius: 1.25rem !important;
                border-color: #e2e8f0 !important;
                /* slate-200 */
                background-color: #f8fafc !important;
                /* slate-50 */
                padding: 1rem !important;
                min-height: 200px !important;
            }

            trix-toolbar .trix-button-group {
                border-color: #e2e8f0 !important;
                background-color: white !important;
                border-radius: 0.5rem !important;
            }
        </style>
    </head>

    {{-- @php
        $user = auth()->user();
    @endphp --}}

    <body class="bg-[#F1F5F9] text-slate-700 antialiased">
        <div class="drawer lg:drawer-open">
            <input id="sidebar-drawer" type="checkbox" class="drawer-toggle" />

            <div class="drawer-content flex flex-col">
                <header
                    class="sticky top-0 z-30 flex h-20 w-full items-center justify-between border-b border-slate-200/50 bg-white/80 px-8 backdrop-blur-md">
                    <div class="flex items-center gap-4">
                        <label for="sidebar-drawer" class="btn btn-ghost btn-circle text-slate-500 lg:hidden">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </label>
                        <h1 class="text-xl font-bold italic tracking-tight text-slate-800">@yield("page_title", "Dashboard Overview")</h1>
                    </div>

                    <div class="flex items-center gap-6">
                        <div class="hidden flex-col text-right md:flex">
                            <span class="text-sm font-bold text-slate-800">{{ $user->name ?? "Bagas Admin" }}</span>
                            <span class="text-[10px] font-bold uppercase tracking-[0.15em] text-indigo-600">
                                {{ isset($user) && $user->is_admin == 1 ? "Super Admin" : "Staff Manager" }}
                            </span>
                        </div>
                        <div class="avatar">
                            <div
                                class="w-11 rounded-xl bg-slate-800 text-white shadow-lg ring-2 ring-white ring-offset-2">
                                <div class="flex h-full w-full items-center justify-center text-sm font-black">
                                    {{ strtoupper(substr($user->name ?? "AD", 0, 2)) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="p-8">
                    @yield("content")
                </main>
            </div>

            @include("Admin.Partials.sidebar")
        </div>

        <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    </body>

</html>
