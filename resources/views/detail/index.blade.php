<h2>Detail Barang Penerimaan</h2>

<p><b>ID Penerimaan:</b> {{ $penerimaan->id_penerimaan }}</p>
<p><b>Status Kelayakan:</b> {{ $penerimaan->status_kelayakan }}</p>

<a href="{{ route('detail.create', $penerimaan->id_penerimaan) }}">
    + Tambah Detail Barang
</a>

<br><br>

<table border="1" cellpadding="6">
    <tr>
        <th>ID Detail</th>
        <th>Nama Barang</th>
        <th>Volume</th>
        <th>Satuan</th>
        <th>Harga</th>
        <th>Layak?</th>
        <th>Aksi</th>
    </tr>

    @foreach($penerimaan->detail as $d)
    <tr>
        <td>{{ $d->id_detail_penerimaan }}</td>
        <td>{{ $d->stok->nama_stok ?? '-' }}</td>
        <td>{{ $d->volume }}</td>
        <td>{{ $d->satuan->nama_satuan ?? '-' }}</td>
        <td>{{ number_format($d->harga) }}</td>
        <td>{{ $d->layak ? 'Layak' : 'Tidak Layak' }}</td>

        <td>
            <a href="{{ route('detail.edit', $d->id_detail_penerimaan) }}">Edit</a>

            <form action="{{ route('detail.delete', $d->id_detail_penerimaan) }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<br>
<a href="javascript:history.back()">Kembali</a>
