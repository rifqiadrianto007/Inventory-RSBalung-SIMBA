<h2>Pemeriksaan Teknis: {{ $penerimaan->nama_penerimaan }}</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>Barang</th>
        <th>Volume</th>
        <th>Satuan</th>
        <th>Kelayakan</th>
        <th>Aksi</th>
    </tr>

    @foreach($penerimaan->detail as $d)
    <tr>
        <td>{{ $d->stok->nama_stok }}</td>
        <td>{{ $d->volume }}</td>
        <td>{{ $d->satuan->nama_satuan }}</td>
        <td>{{ $d->layak ? 'Layak' : 'Tidak Layak' }}</td>
        <td>
            <form action="{{ route('teknis.penerimaan.updateKelayakan', $d->id_detail_penerimaan) }}" method="POST">
                @csrf
                <select name="layak">
                    <option value="1" @if($d->layak) selected @endif>Layak</option>
                    <option value="0" @if(!$d->layak) selected @endif>Tidak Layak</option>
                </select>
                <button type="submit">Update</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<form action="{{ route('teknis.penerimaan.submitToGudang', $penerimaan->id_penerimaan) }}" method="POST">
    @csrf
    <button type="submit">Kirim ke Gudang</button>
</form>
