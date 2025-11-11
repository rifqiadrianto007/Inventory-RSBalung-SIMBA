<h3>Detail Barang yang Diterima</h3>

<a href="{{ route('detail.index', $penerimaan->id_penerimaan) }}">
    Lihat Detail Barang
</a>
<br><br>

<table border="1" cellpadding="6">
    <tr>
        <th>Nama Barang</th>
        <th>Volume</th>
        <th>Satuan</th>
        <th>Harga</th>
        <th>Layak?</th>
    </tr>

    @foreach($penerimaan->detail as $d)
    <tr>
        <td>{{ $d->stok->nama_stok ?? '-' }}</td>
        <td>{{ $d->volume }}</td>
        <td>{{ $d->satuan->nama_satuan ?? '-' }}</td>
        <td>{{ number_format($d->harga) }}</td>
        <td>{{ $d->layak ? 'Layak' : 'Tidak Layak' }}</td>
    </tr>
    @endforeach

</table>
