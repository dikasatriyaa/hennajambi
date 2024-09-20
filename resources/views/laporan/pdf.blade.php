<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
        h2 { margin-top: 50px; }
    </style>
</head>
<body>
    <h1>Laporan Data</h1>

    <h2>Data User</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Tanggal Daftar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Data Service</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Service</th>
                <th>Deskripsi</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->id }}</td>
                <td>{{ $service->name }}</td>
                <td>{{ $service->description }}</td>
                <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Data Toko</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Toko</th>
                <th>Alamat</th>
                <th>Pemilik</th>
            </tr>
        </thead>
        <tbody>
            @foreach($tokos as $toko)
            <tr>
                <td>{{ $toko->id }}</td>
                <td>{{ $toko->name }}</td>
                <td>{{ $toko->address }}</td>
                <td>{{ $toko->user->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Data Pembayaran</h2>
    <table>
        <thead>
            <tr>
                <th>Invoice Code</th>
                <th>Service</th>
                <th>Toko</th>
                <th>User</th>
                <th>Total Bayar</th>
                <th>Tanggal Booking</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pembayarans as $pembayaran)
            <tr>
                <td>{{ $pembayaran->invoice_code }}</td>
                <td>{{ $pembayaran->service->name }}</td>
                <td>{{ $pembayaran->toko->name }}</td>
                <td>{{ $pembayaran->user->name }}</td>
                <td>Rp {{ number_format($pembayaran->total_bayar, 0, ',', '.') }}</td>
                <td>{{ $pembayaran->tanggal_booking }}</td>
                <td>{{ $pembayaran->status }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
