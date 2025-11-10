<h2>Tambah Data Belanja - PPK</h2>

<form action="{{ route('ppk.penerimaan.store') }}" method="POST">
    @csrf
    <label>Nomor PO:</label><br>
    <input type="text" name="nomor_po"><br><br>

    <label>Nama Barang:</label><br>
    <input type="text" name="nama_barang"><br><br>

    <label>Jumlah:</label><br>
    <input type="number" name="jumlah"><br><br>

    <label>Satuan:</label><br>
    <input type="text" name="satuan"><br><br>

    <label>Tanggal Penerimaan:</label><br>
    <input type="date" name="tanggal_penerimaan"><br><br>

    <label>Supplier:</label><br>
    <input type="text" name="supplier"><br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('ppk.penerimaan.index') }}">Kembali</a>
