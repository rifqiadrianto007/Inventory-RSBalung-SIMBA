<h2>Upload BAST - Admin Gudang</h2>

<p><b>Penerimaan ID:</b> {{ $penerimaan->id_penerimaan }}</p>
<p><b>Nama Barang:</b> {{ $penerimaan->nama_barang }}</p>

<form action="{{ route('gudang.penerimaan.storeBast', $penerimaan->id_penerimaan) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label>Nomor Surat BAST:</label><br>
    <input type="text" name="nomor_surat"><br><br>

    <label>Deskripsi:</label><br>
    <textarea name="deskripsi" rows="4" cols="40"></textarea><br><br>

    <label>Upload File (PDF):</label><br>
    <input type="file" name="file_bast" accept="application/pdf"><br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('gudang.penerimaan.index') }}">Kembali</a>
