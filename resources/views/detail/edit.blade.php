<h2>Edit Detail Barang</h2>

<form action="{{ route('detail.update', $detail->id_detail_penerimaan) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Pilih Barang:</label><br>
    <select name="id_stok" required>
        @foreach($stok as $s)
            <option value="{{ $s->id_stok }}"
                @if($detail->id_stok == $s->id_stok) selected @endif
            >{{ $s->nama_stok }}</option>
        @endforeach
    </select><br><br>

    <label>Volume:</label><br>
    <input type="number" name="volume" value="{{ $detail->volume }}" required><br><br>

    <label>Satuan:</label><br>
    <select name="id_satuan" required>
        @foreach($satuan as $s)
            <option value="{{ $s->id_satuan }}"
                @if($detail->id_satuan == $s->id_satuan) selected @endif
            >{{ $s->nama_satuan }}</option>
        @endforeach
    </select><br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga" value="{{ $detail->harga }}"><br><br>

    <button type="submit">Update</button>
</form>
