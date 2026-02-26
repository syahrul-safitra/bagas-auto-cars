<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;

use App\Models\Car;
use App\Models\Category;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
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
    return view('Customer.home', [
        'cars' => Car::latest()->limit(3)->get(),
    ]);
});

Route::get('/dashboard', function () {
    return view('Admin.dashboard');
});

Route::resource('/admin/categories', CategoryController::class)->parameters([
    'categories' => 'category:slug',
]);

Route::delete('/admin/cars/{car:slug}/delete-image/{imageName}', [CarController::class, 'deleteImage'])->name('cars.deleteImage');

Route::resource('admin/cars', CarController::class)->scoped([
    'car' => 'slug',
]);

Route::get('/search-cars', function (Request $request) {

    // $query = Car::with('category')->where('status', 'Available');
    $query = Car::with('category');

    // Filter Search
    if ($request->filled('search')) {
        $query->where('name', 'like', '%' . $request->search . '%');
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
    
    // return view('Customer.cars');
});



// Customer : 
Route::get('/detail-car/{slug}', [CarController::class, 'show']);
Route::post('/booking-car/{slug}', [BookingController::class, 'store']);

Route::get('/booking/detail/{booking_code}', [BookingController::class, 'show']);
Route::post('/booking-upload/{booking_code}', [BookingController::class, 'uploadBukti']);

Route::get('/profile', [CustomerController::class, 'show']);
Route::put('/profile/{customer}', [CustomerController::class, 'update']);

// ================== Authentication : ======================================
Route::get('/register', [CustomerController::class, 'create']);
Route::post('/register', [CustomerController::class, 'store']);



Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authenticate']);
Route::post('/logout', [AuthController::class, 'logout']);