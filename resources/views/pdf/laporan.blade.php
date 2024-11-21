<!DOCTYPE html>
<html>

<head>
  <title>Laporan Stock</title>
  <style>
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      border: 1px solid black;
      padding: 5px;
    }

    .header {
      margin-bottom: 20px;
    }
  </style>
</head>

<body>
  <div class="header">
    <h1>Laporan Stock Barang</h1>
    <p>Periode: {{ \Carbon\Carbon::parse($start_date)->format('d/m/Y') }} - {{ \Carbon\Carbon::parse($end_date)->format('d/m/Y') }}</p>
  </div>

  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Jenis</th>
        <th>Tanggal</th>
      </tr>
    </thead>
    <tbody>
      @foreach($data as $index => $item)
      <tr>
        <td>{{ $index + 1 }}</td>
        <td>{{ $item->dataBarang->nama_barang }}</td>
        <td>{{ $item->jumlah }}</td>
        <td>{{ $item->jumlah > 0 ? 'Barang Masuk' : 'Barang Keluar' }}</td>
        <td>{{ $item->created_at->format('d/m/Y') }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</body>

</html>