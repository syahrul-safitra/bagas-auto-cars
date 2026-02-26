<!DOCTYPE html>
<html>

    <head>
        <title>Laporan Bagas Auto Car</title>
        <style>
            body {
                font-family: 'Helvetica', sans-serif;
                font-size: 11px;
                color: #333;
                line-height: 1.5;
            }

            /* KOP SURAT */
            .kop-surat {
                border-bottom: 3px double #333;
                padding-bottom: 10px;
                margin-bottom: 20px;
                text-align: center;
            }

            .kop-surat h1 {
                margin: 0;
                font-size: 24px;
                color: #1e1b4b;
                text-transform: uppercase;
            }

            .kop-surat p {
                margin: 2px 0;
                color: #666;
                font-style: italic;
            }

            .info-laporan {
                margin-bottom: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            table th {
                background-color: #f1f5f9;
                border: 1px solid #cbd5e1;
                padding: 8px;
                text-transform: uppercase;
                font-size: 9px;
            }

            table td {
                border: 1px solid #cbd5e1;
                padding: 8px;
            }

            .total-row {
                background-color: #e0e7ff;
                font-weight: bold;
                font-size: 12px;
            }

            .text-right {
                text-align: right;
            }
        </style>
    </head>

    <body>
        <div class="kop-surat">
            <h1>BAGAS AUTO CAR</h1>
            <p>Jalan Raya Otomotif No. 123, Jakarta Selatan | Telp: 0812-3456-7890</p>
            <p>Email: info@bagasautocar.com | Website: www.bagasautocar.com</p>
        </div>

        <div class="info-laporan">
            <h3 style="text-align: center; text-decoration: underline;">LAPORAN TRANSAKSI BOOKING</h3>
            <table style="border: none; width: 50%;">
                <tr style="border: none;">
                    <td style="border: none; padding: 2px;">Periode</td>
                    <td style="border: none; padding: 2px;">: {{ date("d-m-Y", strtotime($start_date)) }} s/d
                        {{ date("d-m-Y", strtotime($end_date)) }}</td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none; padding: 2px;">Status Filter</td>
                    <td style="border: none; padding: 2px;">: {{ $status ?? "Semua Status" }}</td>
                </tr>
            </table>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>ID Booking</th>
                    <th>Customer</th>
                    <th>Unit Mobil</th>
                    <th class="text-right">Tanda Jadi (DP)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $key => $item)
                    <tr>
                        <td style="text-align: center;">{{ $key + 1 }}</td>
                        <td>{{ $item->created_at->format("d/m/Y") }}</td>
                        <td style="color: #4f46e5; font-weight: bold;">{{ $item->booking_code }}</td>
                        <td>{{ $item->customer->name }}</td>
                        <td>{{ $item->car->name }}</td>
                        <td class="text-right">Rp {{ number_format($item->booking_fee, 0, ",", ".") }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="5" class="text-right">TOTAL PENDAPATAN</td>
                    <td class="text-right">Rp {{ number_format($total_revenue, 0, ",", ".") }}</td>
                </tr>
            </tfoot>
        </table>
    </body>

</html>
