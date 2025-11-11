<h2>Edit Detail Barang</h2>

<form action="{{ route('detail.update', $detail->id_detail_penerimaan) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Barang:</label><br>
    <select name="id_stok">
        @foreach ($stok as $s)
            <option value="{{ $s->id_stok }}"
                @if($s->id_stok == $detail->id_stok) selected @endif
            >
                {{ $s->nama_stok }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label>Volume:</label><br>
    <input type="number" name="volume" step="0.01" value="{{ $detail->volume }}">
    <br><br>

    <label>Satuan:</label><br>
    <select name="id_satuan">
        @foreach ($satuan as $st)
            <option value="{{ $st->id_satuan }}"
                @if($st->id_satuan == $detail->id_satuan) selected @endif
            >
                {{ $st->nama_satuan }}
            </option>
        @endforeach
    </select>
    <br><br>

    <label>Harga:</label><br>
    <input type="number" name="harga" step="0.01" value="{{ $detail->harga }}">
    <br><br>

    <button type="submit">Update</button>
</form>

<br>
<a href="javascript:history.back()">Kembali</a>
