<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>

    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            margin-bottom: 2em;
            text-align: center;
            text-transform: uppercase;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header h2 {
            margin: 0;
            font-size: 14px;
        }
        .table {
            font-size: 10px;
            border-collapse: collapse;
            width: 100%;
            font-size: 10px;
        }
        .table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
        }
        .table td, .table th {
            border: 1px solid black;
            padding: 8px;
        }

    </style>
</head>
<body>
    <main>
        <div class="header">
            <h1><b>CV. Al Harits Corp</b></h1>
            <h2><b>Laporan Penjualan</b></h2>
        </div>
        <table class="table" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>ID Pesanan</th>
                    <th>Nama Pesanan</th>
                    <th>Nama Pelanggan</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $index => $report)
                    <tr>
                        <td>{{ $index + 1}}</td>
                        <td>{{ $report['date'] }}</td>
                        <td>{{ $report['order_id'] }}</td>
                        <td>{{ $report['order_name'] }}</td>
                        <td>{{ $report['customer_name'] }}</td>
                        <td>{{ $report['price'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
