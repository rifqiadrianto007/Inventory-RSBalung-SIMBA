<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Berita Acara Serah Terima (BAST)</title>
    <style>
        body { font-family: 'Arial', sans-serif; margin: 40px; font-size: 13px; }
        h2 { text-align: center; text-transform: uppercase; text-decoration: underline; margin-bottom: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f2f2f2; text-align: center; }
        .footer { margin-top: 40px; display: flex; justify-content: space-between; }
        .footer div { text-align: center; width: 40%; }
    </style>
</head>
<body>
    <h2>Berita Acara Serah Terima Barang (BAST)</h2>

    <p>Pada hari ini, dilakukan serah terima barang dari <b>Tim PPK</b> kepada <b>Admin Gudang</b> berdasarkan hasil pemeriksaan teknis dan kelayakan barang yang telah diterima. Adapun rincian barang sebagai berikut:</p>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Volume</th>
            <th>Satuan</th>
            <th>Harga</th>
            <th>Kelayakan</th>
        </tr>
        @foreach($p->detail as $i => $d)
            <tr>
                <td style="text-align:center;">{{ $i+1 }}</td>
                <td>{{ $d->stok->nama_barang ?? '-' }}</td>
                <td style="text-align:center;">{{ $d->volume }}</td>
                <td style="text-align:center;">{{ $d->satuan->nama_satuan ?? '-' }}</td>
                <td style="text-align:right;">Rp {{ number_format($d->harga, 0, ',', '.') }}</td>
                <td style="text-align:center;">{{ $d->layak ? 'Layak' : 'Tidak Layak' }}</td>
            </tr>
        @endforeach
    </table>

    <p style="margin-top:20px;">
        Demikian berita acara serah terima barang ini dibuat dengan sebenar-benarnya untuk digunakan sebagaimana mestinya.
    </p>

    <div class="footer">
        <div>
            <p><b>Pihak PPK</b></p>
            <br><br><br>
            <p>_________________________</p>
        </div>

        <div>
            <p><b>Admin Gudang</b></p>
            <br><br><br>
            <p>_________________________</p>
        </div>
    </div>

</body>
</html>
