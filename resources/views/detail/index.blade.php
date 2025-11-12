<h2>Detail Barang untuk Penerimaan: {{ $penerimaan->nama_penerimaan }}</h2>

@if($penerimaan->status === 'draft_ppk')
<a href="{{ route('detail.create', $penerimaan->id_penerimaan) }}">+ Tambah Barang</a>
@endif

<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>Barang</th>
        <th>Volume</th>
        <th>Satuan</th>
        <th>Harga</th>
        <th>Kelayakan</th>
        <th>Aksi</th>
    </tr>

    @foreach($penerimaan->detail as $d)
    <tr>
        <td>{{ $d->stok->nama_stok }}</td>
        <td>{{ $d->volume }}</td>
        <td>{{ $d->satuan->nama_satuan }}</td>
        <td>{{ $d->harga }}</td>
        <td>
            @if($penerimaan->status === 'cek_teknis')
                (menunggu teknis)
            @else
                {{ $d->layak ? 'Layak' : 'Tidak Layak' }}
            @endif
        </td>

        <td>
            @if($penerimaan->status === 'draft_ppk')
                <a href="{{ route('detail.edit', $d->id_detail_penerimaan) }}">Edit</a> |
                <form method="POST" action="{{ route('detail.delete', $d->id_detail_penerimaan) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            @else
                (tidak bisa diubah)
            @endif
        </td>
    </tr>
    @endforeach

</table>
