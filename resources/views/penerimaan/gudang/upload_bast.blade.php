<h2>Upload BAST</h2>

<p><b>ID Penerimaan:</b> {{ $penerimaan->id_penerimaan }}</p>
<p><b>Nomor PO:</b> {{ $penerimaan->nomor_po }}</p>
<p><b>Status Kelayakan:</b> {{ $penerimaan->status_kelayakan }}</p>

<hr>

<h3>Rincian Barang</h3>

<table border="1" cellpadding="6">
    <tr>
        <th>Nama Barang</th>
        <th>Volume</th>
        <th>Satuan</th>
        <th>Harga</th>
    </tr>

    @foreach ($penerimaan->detail as $d)
    <tr>
        <td>{{ $d->stok->nama_stok }}</td>
        <td>{{ $d->volume }}</td>
        <td>{{ $d->satuan->nama_satuan }}</td>
        <td>{{ number_format($d->harga) }}</td>
    </tr>
    @endforeach
</table>

<hr><br>

<form action="{{ route('gudang.penerimaan.storeBast', $penerimaan->id_penerimaan) }}"
      method="POST" enctype="multipart/form-data">

    @csrf

    <label>Nomor Surat BAST:</label><br>
    <input type="text" name="nomor_surat" required>
    <br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" required></textarea>
    <br><br>

    <label>File BAST (PDF):</label><br>
    <input type="file" name="file_bast" accept="application/pdf">
    <br><br>

    <button type="submit">Upload BAST</button>
</form>

<br>
<a href="javascript:history.back()">Kembali</a>
