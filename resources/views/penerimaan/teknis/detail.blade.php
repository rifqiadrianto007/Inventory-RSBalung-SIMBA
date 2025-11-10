<h2>Pengecekan Barang - Tim Teknis</h2>

<p><b>Nama Barang:</b> {{ $penerimaan->nama_barang }}</p>
<p><b>Jumlah:</b> {{ $penerimaan->jumlah }} {{ $penerimaan->satuan }}</p>
<p><b>Tanggal:</b> {{ $penerimaan->tanggal_penerimaan }}</p>

<form action="{{ route('teknis.penerimaan.update', $penerimaan->id_penerimaan) }}" method="POST">
    @csrf

    <label>Status Kelayakan:</label><br>
    <select name="status_kelayakan">
        <option value="layak">Layak</option>
        <option value="tidak_layak">Tidak Layak</option>
    </select>
    <br><br>

    <label>Catatan Teknis:</label><br>
    <textarea name="catatan" rows="4" cols="40"></textarea>

    <br><br>
    <button type="submit">Simpan</button>
</form>

<br>
<a href="{{ route('teknis.penerimaan.index') }}">Kembali</a>
