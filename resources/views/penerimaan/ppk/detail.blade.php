<h2>Detail Draft Penerimaan</h2>

<p><b>ID:</b> {{ $penerimaan->id_penerimaan }}</p>
<p><b>Tanggal:</b> {{ $penerimaan->tanggal_penerimaan }}</p>
<p><b>Supplier:</b> {{ $penerimaan->supplier ?? '-' }}</p>
<p><b>Status:</b> {{ $penerimaan->status }}</p>

<a href="{{ route('ppk.penerimaan.item.create', $penerimaan->id_penerimaan) }}">+ Tambah Item</a>

<table border="1" cellpadding="6" style="margin-top:10px">
  <tr>
    <th>Barang</th><th>Volume</th><th>Satuan</th><th>Harga</th><th>Aksi</th>
  </tr>
  @foreach($penerimaan->detail as $d)
  <tr>
    <td>{{ $d->stok->nama_barang ?? '-' }}</td>
    <td>{{ $d->volume }}</td>
    <td>{{ $d->satuan->nama_satuan ?? '-' }}</td>
    <td>{{ number_format($d->harga) }}</td>
    <td>
      <a href="{{ route('ppk.penerimaan.item.edit', $d->id_detail_penerimaan) }}">Edit</a>
      <form action="{{ route('ppk.penerimaan.item.delete', $d->id_detail_penerimaan) }}" method="POST" style="display:inline">
        @csrf @method('DELETE')
        <button type="submit">Hapus</button>
      </form>
    </td>
  </tr>
  @endforeach
</table>

<br>
<form method="POST" action="{{ route('ppk.penerimaan.submit', $penerimaan->id_penerimaan) }}">
  @csrf
  <button type="submit">Kirim ke Tim Teknis</button>
</form>

<br>
<a href="{{ route('ppk.penerimaan.index') }}">Kembali</a>
