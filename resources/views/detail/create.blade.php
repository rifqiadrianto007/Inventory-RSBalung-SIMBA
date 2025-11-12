<h2>Tambah Detail Barang</h2>

<form action="{{ route('detail.store', $penerimaan->id_penerimaan) }}" method="POST">
    @csrf

    <label>Pilih Barang:</label><br>
    <select name="id_stok" required>
        <option value="">-- pilih --</option>
        @foreach($stok as $s)
            <option value="{{ $s->id_stok }}">{{ $s->nama_stok }}</option>
        @endforeach
    </select><br><br>

    <label>Volume:</label><br>
    <input type="number" name="volume" required><br><br>

    <label>Satuan:</label><br>
    <select name="id_satuan" required>
        @foreach($satuan as $s)
            <option value="{{ $s->id_satuan }}">{{ $s->nama_satuan }}</option>
        @endforeach
    </select><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga"><br><br>

    <button type="submit">Simpan</button>
</form>
