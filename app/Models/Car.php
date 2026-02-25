<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'year', 'price', 'mileage', 'color',
        'transmission', 'fuel_type', 'description', 'thumbnail', 'images', 'status',

    ];

    // Relasi: Setiap mobil dimiliki oleh satu kategori (merek)
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected $casts = [
        'images' => 'array',
    ];
}
