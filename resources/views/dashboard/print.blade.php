<!DOCTYPE html>
<html>
<head>
    <title>Data Pesanan</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        .text-right { text-align: right; }
    </style>
</head>
<body>
    <h2>Data Pesanan</h2>
    <p>Tanggal: {{ \Carbon\Carbon::now()->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dashboard as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->product->nama ?? '-' }}</td>
                <td>Rp{{ number_format($item->product->harga ?? 0, 0, ',', '.') }}</td>
                <td>{{ $item->qty }}</td>
                <td>Rp{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-right"><strong>JUMLAH</strong></td>
                <td class="border p-2">Rp{{ number_format($dashboard->sum('jumlah'), 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
