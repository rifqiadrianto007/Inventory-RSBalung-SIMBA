<h2>Penerimaan - Admin Gudang</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nama Penerimaan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $p)
    <tr>
        <td>{{ $p->id_penerimaan }}</td>
        <td>{{ $p->nama_penerimaan }}</td>
        <td>{{ $p->status_kelayakan }}</td>
        <td>
            @if($p->file_bast === null)
                <a href="{{ route('gudang.penerimaan.upload', $p->id_penerimaan) }}">
                    Upload BAST Final
                </a>
            @else
                <a href="{{ route('gudang.penerimaan.download', $p->id_penerimaan) }}">Download BAST</a>
            @endif
        </td>
    </tr>
    @endforeach
</table>
