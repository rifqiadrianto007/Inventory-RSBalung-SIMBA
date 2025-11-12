<h2>Penerimaan - PPK</h2>

<a href="{{ route('ppk.penerimaan.create') }}">+ Buat Penerimaan Baru</a>

<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama Penerimaan</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $p)
    <tr>
        <td>{{ $p->id_penerimaan }}</td>
        <td>{{ $p->nama_penerimaan }}</td>
        <td>{{ $p->tanggal_penerimaan }}</td>
        <td>{{ $p->status }}</td>
        <td>
            <a href="{{ route('detail.index', $p->id_penerimaan) }}">Detail Barang</a>

            @if($p->status === 'draft_ppk')
                | <a href="{{ route('ppk.penerimaan.edit', $p->id_penerimaan) }}">Edit</a>
                | <form method="POST" action="{{ route('ppk.penerimaan.delete', $p->id_penerimaan) }}" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>

                @if($p->detail->count() > 0)
                    | <form method="POST" action="{{ route('ppk.penerimaan.submit', $p->id_penerimaan) }}" style="display:inline;">
                        @csrf
                        <button type="submit">Kirim ke Teknis</button>
                    </form>
                @endif
            @endif
        </td>
    </tr>
    @endforeach
</table>
