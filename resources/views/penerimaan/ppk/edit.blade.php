<h2>Edit Data Belanja - PPK</h2>

<form action="{{ route('ppk.penerimaan.update', $penerimaan->id_penerimaan) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nomor PO:</label><br>
    <input type="text" name="nomor_po" value="{{ $penerimaan->nomor_po }}"><br><br>

    <label>Nama Barang:</label><br>
    <input type="text" name="nama_barang" value="{{ $penerimaan->nama_barang }}"><br><br>

    <label>Jumlah:</label><br>
    <input type="number" name="jumlah" value="{{ $penerimaan->jumlah }}"><br><br>

    <label>Satuan:</label><br>
    <input type="text" name="satuan" value="{{ $penerimaan->satuan }}"><br><br>

    <label>Tanggal Penerimaan:</label><br>
    <input type="date" name="tanggal_penerimaan" value="{{ $penerimaan->tanggal_penerimaan }}"><br><br>

    <label>Supplier:</label><br>
    <input type="text" name="supplier" value="{{ $penerimaan->supplier }}"><br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="{{ route('ppk.penerimaan.index') }}">Kembali</a>
