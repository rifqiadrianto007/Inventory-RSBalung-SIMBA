<h2>Buat Penerimaan Baru</h2>

<form action="{{ route('ppk.penerimaan.store') }}" method="POST">
    @csrf

    <label>Nama Penerimaan:</label><br>
    <input type="text" name="nama_penerimaan" required><br><br>

    <label>Tanggal Penerimaan:</label><br>
    <input type="date" name="tanggal_penerimaan" required><br><br>

    <button type="submit">Simpan</button>
</form>
