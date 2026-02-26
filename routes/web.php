<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\UserController;
use App\Models\Booking;
use App\Models\Car;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    if(auth()->guard('admin')->check()) {
        return redirect('/admin/dashboard');
    }

    return view('Customer.home', [
        'cars' => Car::latest()->limit(3)->get(),
    ]);
});

Route::get('/admin/dashboard', function () {

    $totalCars = Car::count();
    $newCarsToday = Car::whereDate('created_at', Carbon::today())->count();

    // 2. Booking Aktif (Status yang perlu konfirmasi/pending)
    $activeBookings = Booking::where('booking_status', 'pending')->count();

    // 3. Estimasi Penjualan (Hanya contoh logika: total harga mobil yang terjual bulan ini)
    // Jika Anda belum punya field penjualan, bisa gunakan angka dummy dulu atau hitung dari transaksi
    $estimatedSales = Car::where('status', 'sold')
        ->whereMonth('updated_at', Carbon::now()->month)
        ->sum('price');

    // Format harga ke Milyar (M) untuk tampilan dashboard
    $formattedSales = 'Rp '.($estimatedSales / 1000000000).'M';

    // 4. Ambil 5 Armada Terbaru untuk tabel
    $latestCars = Car::latest()->take(5)->get();

    return view('Admin.dashboard', compact(
        'totalCars',
        'newCarsToday',
        'activeBookings',
        'formattedSales',
        'latestCars'
    ));

})->middleware('isAdmin');

Route::resource('/admin/categories', CategoryController::class)->parameters([
    'categories' => 'category:slug',
]);

Route::delete('/admin/cars/{car:slug}/delete-image/{imageName}', [CarController::class, 'deleteImage'])->name('cars.deleteImage');

Route::resource('admin/cars', CarController::class)->scoped([
    'car' => 'slug',
]);

Route::get('/admin/booking', [BookingController::class, 'index']);
Route::get('/admin/booking/{booking}', [BookingController::class, 'edit']);
Route::put('/admin/booking/update/{booking}', [BookingController::class, 'update']);
Route::delete('/admin/booking/{booking}', [BookingController::class, 'destroy']);
Route::get('/export-pdf', [BookingController::class, 'exportPdf']);

Route::get('/admin/customers', [CustomerController::class, 'index']);
Route::delete('/admin/customers/{customer}', [CustomerController::class, 'destroy']);

Route::resource('/admin/users', UserController::class);

Route::get('/search-cars', function (Request $request) {

    // $query = Car::with('category')->where('status', 'Available');
    $query = Car::with('category');

    // Filter Search
    if ($request->filled('search')) {
        $query->where('name', 'like', '%'.$request->search.'%');
    }

    // Filter Kategori
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // Filter Transmisi
    if ($request->filled('transmission')) {
        $query->where('transmission', $request->transmission);
    }

    // Filter Harga
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    $cars = $query->latest()->paginate(9);
    $categories = Category::all();

    return view('Customer.cars', compact('cars', 'categories'));

})->middleware('isCustomer');

// Customer :
Route::get('/detail-car/{slug}', [CarController::class, 'show'])->middleware('isCustomer');
Route::post('/booking-car/{slug}', [BookingController::class, 'store'])->middleware('isCustomer');

Route::get('/booking/detail/{booking_code}', [BookingController::class, 'show'])->middleware('isCustomer');
Route::post('/booking-upload/{booking}', [BookingController::class, 'uploadBukti'])->middleware('isCustomer');

Route::get('/profile', [CustomerController::class, 'show'])->middleware('isCustomer');
Route::put('/profile/{customer}', [CustomerController::class, 'update'])->middleware('isCustomer');

// ================== Authentication : ======================================
Route::get('/register', [CustomerController::class, 'create']);
Route::post('/register', [CustomerController::class, 'store']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/test-b', function() {
    return Auth::guard('customer')->user();
});

Route::get('/test-a', function() {
    return Auth::guard('admin')->user();
});