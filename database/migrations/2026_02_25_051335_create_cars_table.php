<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name'); // Contoh: M4 Competition
            $table->string('slug')->unique();
            $table->integer('year');
            $table->bigInteger('price');
            $table->integer('mileage'); // Jarak tempuh (KM)
            $table->string('color');
            $table->enum('transmission', ['Automatic', 'Manual']);
            $table->enum('fuel_type', ['Bensin', 'Diesel', 'Electric', 'Hybrid']);
            $table->text('description');
            $table->string('thumbnail'); // Gambar utama
            $table->json('images')->nullable(); // Untuk galeri foto tambahan
            $table->enum('status', ['Available', 'Sold', 'Booked'])->default('Available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
