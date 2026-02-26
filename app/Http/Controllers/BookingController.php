<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Car;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'car'])->latest();

        // Filter berdasarkan status jika diperlukan
        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }

        $bookings = $query->paginate(10);

        return view('Admin.Booking.index', compact('bookings'));

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
            'customer_id' => 'required',
        ]);

        // 2. Cek ketersediaan mobil
        if ($slug->status !== 'Available') {
            return back()->with('error', 'Maaf, mobil ini baru saja dibooking orang lain.');
        }

        // 3. Simpan data sesuai struktur tabel kamu
        $booking = Booking::create([
            'customer_id' => $request->customer_id,
            'car_id' => $slug->id,
            'booking_code' => 'BAC-'.date('Y').strtoupper(Str::random(4)), // Contoh: BAC-2026XJ21
            'booking_fee' => 0, // Misal: Flat DP 2 Juta, atau ambil dari $slug->price * 0.1
            'payment_status' => 'Pending',
            'booking_status' => 'Process',
            'notes' => $request->message, // Pesan dari modal tadi masuk ke kolom notes
        ]);

        // 4. Update status mobil agar tidak bisa dibooking lagi
        $slug->update(['status' => 'Booked']);

        return redirect('booking/detail/'.$booking->booking_code)
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
        return view('Admin.Booking.detail', [
            'booking' => $booking,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        // 1. Update data booking terlebih dahulu
        $booking->update([
            'booking_fee' => $request->booking_fee,
            'payment_status' => $request->payment_status,
            'booking_status' => $request->booking_status,
        ]);

        // 2. Logika Sinkronisasi Status Mobil
        // Jika booking status adalah 'Failed' atau payment status adalah 'Cancelled'
        if ($request->booking_status == 'Failed' || $request->payment_status == 'Cancelled') {

            // Ubah status mobil terkait menjadi Available
            $booking->car->update([
                'status' => 'Available',
            ]);

        } elseif ($request->booking_status == 'Deal' || $request->payment_status == 'Success') {

            // Opsional: Jika status Deal, pastikan mobil berstatus 'Sold' atau 'Booked'
            $booking->car->update([
                'status' => 'Booked', // atau 'Sold' tergantung alur showroom kamu
            ]);
        }

        return back()->with('success', 'Data booking '.$booking->booking_code.' dan status unit berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {

        // Kembalikan status mobil menjadi Available sebelum booking dihapus
        if ($booking->car) {
            $booking->car->update(['status' => 'Available']);
        }

        $booking->delete();

        return back()->with('success', 'Data booking '.$booking->booking_code.' telah berhasil dihapus.');
    }

    public function uploadBukti(Request $request, Booking $booking)
    {

        $request->validate([
            'bukti_dp' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ]);


        if ($request->hasFile('bukti_dp')) {
            $file = $request->file('bukti_dp');
            $filename = 'DP-'.$booking->booking_code.'-'.time().'.'.$file->getClientOriginalExtension();

            // Simpan ke folder public/uploads/bukti_pembayaran
            $file->move(public_path('uploads/bukti_pembayaran'), $filename);

            $booking->update([
                'bukti_dp' => $filename,    
                'payment_status' => 'Waiting_Verification',
                // Opsional: kamu bisa ubah booking_status ke 'Waiting Verification' di sini
            ]);
        }

        return back()->with('success', 'Bukti pembayaran berhasil diunggah!');
    }

    public function exportPdf(Request $request)
    {

        $status = $request->status;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $query = Booking::with(['car', 'customer']);

        // Filter Tanggal (Berdasarkan created_at)
        if ($start_date && $end_date) {
            $query->whereBetween('created_at', [$start_date.' 00:00:00', $end_date.' 23:59:59']);
        }

        // Filter Status
        if ($status) {
            $query->where('payment_status', $status);
        }

        $bookings = $query->latest()->get();

        // Hitung Total Pendapatan dari booking_fee
        $total_revenue = $bookings->sum('booking_fee');

        $pdf = Pdf::loadView('Admin.Booking.pdf', compact('bookings', 'status', 'start_date', 'end_date', 'total_revenue'))
            ->setPaper('a4', 'portrait'); // Potrait agar kop surat terlihat lebih formal

        return $pdf->stream('Laporan-Bagas-Auto-Car.pdf'); // Gunakan stream agar terbuka di tab baru
    }
}
