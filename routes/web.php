<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Models\Car;
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

Route::get('/search-cars', function () {
    return view('Customer.cars');
});

Route::get('/register', [CustomerController::class, 'create']);
Route::post('/register', [CustomerController::class, 'store']);

Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'authentication']);
