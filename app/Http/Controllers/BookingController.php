<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Tambahkan ini di paling atas

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Car $slug)
    {
        // 1. Validasi minimal
        $request->validate([
            'message' => 'nullable|string|max:500',
            'customer_id' => 'required'
        ]);


        // 2. Cek ketersediaan mobil
        if ($slug->status !== 'Available') {
            return back()->with('error', 'Maaf, mobil ini baru saja dibooking orang lain.');
        }

        // 3. Simpan data sesuai struktur tabel kamu
        $booking = Booking::create([
            'customer_id'    => $request->customer_id,
            'car_id'         => $slug->id,
            'booking_code'   => 'BAC-' . date('Y') . strtoupper(Str::random(4)), // Contoh: BAC-2026XJ21
            'booking_fee'    => 0, // Misal: Flat DP 2 Juta, atau ambil dari $slug->price * 0.1
            'payment_status' => 'Pending',
            'booking_status' => 'Process',
            'notes'          => $request->message, // Pesan dari modal tadi masuk ke kolom notes
        ]);

        // 4. Update status mobil agar tidak bisa dibooking lagi
        $slug->update(['status' => 'Booked']);

        return redirect('booking/detail/' . $booking->booking_code)
                        ->with('success', 'Booking berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     */
    public function show($booking_code)
    {
        $booking = Booking::with(['car', 'customer'])
                ->where('booking_code', $booking_code)
                // ->where('customer_id', auth()->id()) // Keamanan: Hanya pemesan yang bisa lihat
                ->firstOrFail();


        return view('Customer.detail-booking', compact('booking'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function uploadBukti(Request $request, $booking_code)
    {

        $request->validate([
            'bukti_dp' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $booking = Booking::where('booking_code', $booking_code)
                        ->where('customer_id', 1)
                        ->firstOrFail();

        if ($request->hasFile('bukti_dp')) {
            $file = $request->file('bukti_dp');
            $filename = 'DP-' . $booking_code . '-' . time() . '.' . $file->getClientOriginalExtension();
            
            // Simpan ke folder public/uploads/bukti_pembayaran
            $file->move(public_path('uploads/bukti_pembayaran'), $filename);

            $booking->update([
                'bukti_dp' => $filename,
                'payment_status' => 'Waiting_Verification'
                // Opsional: kamu bisa ubah booking_status ke 'Waiting Verification' di sini
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diunggah!');
    }
}
