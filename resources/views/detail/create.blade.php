<h2>Tambah Detail Barang</h2>

<form action="{{ route('detail.store', $id) }}" method="POST">
    @csrf

    <label>Nama Barang:</label><br>
    <select name="id_stok">
        @foreach ($stok as $s)
            <option value="{{ $s->id_stok }}">{{ $s->nama_stok }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Volume:</label><br>
    <input type="number" name="volume" step="0.01">
    <br><br>

    <label>Satuan:</label><br>
    <select name="id_satuan">
        @foreach ($satuan as $st)
            <option value="{{ $st->id_satuan }}">{{ $st->nama_satuan }}</option>
        @endforeach
    </select>
    <br><br>

    <label>Harga Barang:</label><br>
    <input type="number" name="harga" step="0.01">
    <br><br>

    <button type="submit">Simpan</button>
</form>

<br>
<a href="javascript:history.back()">Kembali</a>
