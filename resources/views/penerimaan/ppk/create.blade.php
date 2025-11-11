<h2>Buat Draft Penerimaan</h2>

<form method="POST" action="{{ route('ppk.penerimaan.store') }}">
  @csrf
  <label>Tanggal Penerimaan</label><br>
  <input type="date" name="tanggal_penerimaan" required><br><br>

  <label>Supplier</label><br>
  <input type="text" name="supplier"><br><br>

  <label>Catatan</label><br>
  <textarea name="catatan"></textarea><br><br>

  <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('ppk.penerimaan.index') }}">Kembali</a>
