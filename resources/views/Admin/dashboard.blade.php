@extends("Admin.Layouts.main")

@section("content")
    <div class="mb-8 grid grid-cols-1 gap-6 md:grid-cols-3">
        <div class="stat bg-base-100 border-base-300 rounded-2xl border shadow-sm">
            <div class="stat-figure text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block h-8 w-8 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            <div class="stat-title font-bold italic">Total Mobil</div>
            <div class="stat-value text-primary">48</div>
            <div class="stat-desc">2 unit baru ditambahkan hari ini</div>
        </div>

        <div class="stat bg-base-100 border-base-300 rounded-2xl border shadow-sm">
            <div class="stat-figure text-secondary">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    class="inline-block h-8 w-8 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                    </path>
                </svg>
            </div>
            <div class="stat-title font-bold italic">Booking Aktif</div>
            <div class="stat-value text-secondary">12</div>
            <div class="stat-desc text-secondary">Butuh konfirmasi segera</div>
        </div>

        <div class="stat bg-base-100 border-base-300 rounded-2xl border shadow-sm">
            <div class="stat-figure text-success text-3xl">💰</div>
            <div class="stat-title font-bold italic">Estimasi Penjualan</div>
            <div class="stat-value">Rp 12.5M</div>
            <div class="stat-desc">Bulan Februari 2026</div>
        </div>
    </div>

    <div class="card bg-base-100 border-base-300 rounded-2xl border shadow-sm">
        <div class="card-body p-0 md:p-6">
            <div class="flex items-center justify-between p-4">
                <h2 class="text-xl font-bold uppercase italic tracking-tighter">Armada Terbaru</h2>
                <button class="btn btn-primary btn-sm rounded-lg">+ Tambah Mobil</button>
            </div>
            <div class="overflow-x-auto">
                <table class="table-zebra table w-full">
                    <thead class="bg-base-200">
                        <tr class="text-xs uppercase italic">
                            <th>Mobil</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle h-12 w-12 italic">
                                            <img src="https://images.pexels.com/photos/112460/pexels-photo-112460.jpeg?auto=compress&cs=tinysrgb&w=150"
                                                alt="Car Image" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">Mercedes-AMG G63</div>
                                        <div class="text-xs opacity-50">NIK 2023</div>
                                    </div>
                                </div>
                            </td>
                            <td>Mercedes Benz</td>
                            <td class="font-bold">Rp 6.250M</td>
                            <td><span class="badge badge-success badge-sm font-bold italic">Available</span></td>
                            <th>
                                <button class="btn btn-ghost btn-xs">Edit</button>
                                <button class="btn btn-ghost btn-xs text-error font-bold">Hapus</button>
                            </th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
