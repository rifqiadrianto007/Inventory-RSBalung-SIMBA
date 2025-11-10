<h2>Daftar Penerimaan - Tim Teknis</h2>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Status Kelayakan</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $p)
        <tr>
            <td>{{ $p->id_penerimaan }}</td>
            <td>{{ $p->nama_barang }}</td>
            <td>{{ $p->jumlah }} {{ $p->satuan }}</td>
            <td>{{ $p->status_kelayakan }}</td>
            <td>
                <a href="{{ route('teknis.penerimaan.detail', $p->id_penerimaan) }}">
                    Periksa
                </a>
            </td>
        </tr>
    @endforeach
</table>
