<h2>Edit Item</h2>

<form method="POST" action="{{ route('ppk.penerimaan.item.update', $detail->id_detail_penerimaan) }}">
  @csrf @method('PUT')

  <label>Barang</label><br>
  <select name="id_stok" required>
    @foreach($stok as $s)
      <option value="{{ $s->id_stok }}" @selected($s->id_stok==$detail->id_stok)>
        {{ $s->nama_barang }}
      </option>
    @endforeach
  </select><br><br>

  <label>Volume</label><br>
  <input type="number" step="0.01" name="volume" value="{{ $detail->volume }}" required><br><br>

  <label>Satuan</label><br>
  <select name="id_satuan" required>
    @foreach($satuan as $u)
      <option value="{{ $u->id_satuan }}" @selected($u->id_satuan==$detail->id_satuan)>
        {{ $u->nama_satuan }}
      </option>
    @endforeach
  </select><br><br>

  <label>Harga</label><br>
  <input type="number" step="0.01" name="harga" value="{{ $detail->harga }}" required><br><br>

  <button type="submit">Update</button>
</form>

<br>
<a href="{{ route('ppk.penerimaan.detail', $detail->id_penerimaan) }}">Kembali</a>
