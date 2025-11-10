<h2>Penerimaan - Admin Gudang</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Status Kelayakan</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $p)
        <tr>
            <td>{{ $p->id_penerimaan }}</td>
            <td>{{ $p->nama_barang }}</td>
            <td>{{ $p->status_kelayakan }}</td>
            <td>
                <a href="{{ route('gudang.penerimaan.upload', $p->id_penerimaan) }}">Upload BAST</a>
            </td>
        </tr>
    @endforeach
</table>
