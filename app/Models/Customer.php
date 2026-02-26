<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'password',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // App/Models/Customer.php

    protected static function booted()
    {
        static::deleting(function ($customer) {
            // Otomatis bebaskan mobil sebelum customer benar-benar terhapus
            $carIds = $customer->bookings()->pluck('car_id');
            \App\Models\Car::whereIn('id', $carIds)->update(['status' => 'Available']);
        });
    }
}
