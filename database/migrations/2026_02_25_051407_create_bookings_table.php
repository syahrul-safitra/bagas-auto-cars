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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('car_id')->constrained();
            $table->string('booking_code')->unique(); // Contoh: BAC-2024001
            $table->bigInteger('booking_fee')->nullable(); // Tanda jadi / DP
            $table->enum('payment_status', ['Pending', 'Success', 'Cancelled', 'Paid_Off', 'Waiting_Verification'])->default('Pending');
            $table->enum('booking_status', ['Process', 'Deal', 'Failed'])->default('Process');
            $table->text('notes')->nullable();
            $table->string('bukti_dp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
