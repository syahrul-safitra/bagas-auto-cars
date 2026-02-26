<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id', 
        'car_id',
        'booking_code', 
        'booking_fee',
        'payment_status',
        'booking_status',
        'notes',
        'bukti_dp'
    ];

    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

}
