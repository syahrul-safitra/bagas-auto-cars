<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $customers = Customer::query()
            ->when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            })
            ->withCount('bookings') // Asumsi relasi di model Customer bernama bookings()
            ->latest()
            ->paginate(10);

        return view('Admin.Customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|min:8',
            'password' => 'required|string|min:8|confirmed',
        ], [
            'email.unique' => 'Email ini sudah terdaftar!',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min' => 'Password minimal 8 karakter.',
        ]);

        // 2. Simpan ke Database
        $user = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'role' => 'customer', // Default role sebagai customer
        ]);

        // 3. Langsung Login setelah daftar
        // Auth::login($user);

        // 4. Redirect ke halaman katalog atau dashboard customer
        return redirect('/')->with('success', 'Registrasi berhasil! Selamat datang di Showroom.');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Customer::firstOrFail();

        $bookings = Booking::with('car')
            ->where('customer_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Customer.profile', compact('user', 'bookings'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,'.$customer->id,
            'phone' => 'required|string|max:15',
            'address' => 'nullable|string|max:500',
            'password' => 'nullable|min:5', // Password opsional
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        // Jika user mengisi password baru, maka kita enkripsi dan masukkan ke data update
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $customer->update($data);

        return back()->with('success', 'Profil Anda berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {

        DB::beginTransaction();
        try {
            // $customer = Customer::findOrFail($id);

            // 1. Cari semua booking milik customer ini yang statusnya masih aktif (Process/Deal)
            // Kita ambil ID mobil-mobil tersebut
            $carIds = $customer->bookings()
                ->whereIn('booking_status', ['Process', 'Deal'])
                ->pluck('car_id');

            // 2. Update status mobil-mobil tersebut menjadi 'Available'
            if ($carIds->isNotEmpty()) {
                Car::whereIn('id', $carIds)->update(['status' => 'Available']);
            }

            // 3. Hapus data customer
            // Catatan: Jika tidak pakai SoftDeletes, data booking terkait biasanya akan terhapus jika di migrasi ada 'onDelete cascade'
            $customer->delete();

            DB::commit();

            return back()->with('success', 'Customer berhasil dihapus & unit mobil telah dikembalikan ke status Available.');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Gagal menghapus customer: '.$e->getMessage());
        }
    }
}
