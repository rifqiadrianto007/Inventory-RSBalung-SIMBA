<h2>Penerimaan - PPK</h2>

<a href="{{ route('ppk.penerimaan.create') }}">+ Tambah Data Belanja</a>

<table border="1" cellpadding="6">
    <tr>
        <th>ID</th>
        <th>Nomor PO</th>
        <th>Nama Barang</th>
        <th>Jumlah</th>
        <th>Aksi</th>
    </tr>

    @foreach($data as $p)
        <tr>
            <td>{{ $p->id_penerimaan }}</td>
            <td>{{ $p->nomor_po }}</td>
            <td>{{ $p->nama_barang }}</td>
            <td>{{ $p->jumlah }} {{ $p->satuan }}</td>
            <td>
                <a href="{{ route('ppk.penerimaan.edit', $p->id_penerimaan) }}">Edit</a> |
                <form action="{{ route('ppk.penerimaan.delete', $p->id_penerimaan) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
