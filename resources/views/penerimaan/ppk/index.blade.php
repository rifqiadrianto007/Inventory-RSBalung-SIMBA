<h2>Penerimaan - PPK</h2>

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
            <td>{{ $p->nomor_po ?? '-' }}</td>

            <td>{{ $p->nama_barang }}</td>
            <td>{{ $p->jumlah }} {{ $p->satuan }}</td>

            <td>
                <a href="{{ route('detail.index', $p->id_penerimaan) }}">Detail</a> |
                <a href="{{ route('detail.create', $p->id_penerimaan) }}">Tambah Detail</a> |

                @if(!$p->nomor_po)
                    <a href="{{ route('ppk.penerimaan.create', $p->id_penerimaan) }}">Buat PO</a> |
                @endif

                <a href="{{ route('ppk.penerimaan.edit', $p->id_penerimaan) }}">Edit PO</a> |

                <form action="{{ route('ppk.penerimaan.delete', $p->id_penerimaan) }}"
                      method="POST" style="display:inline">
                    @csrf @method('DELETE')
                    <button type="submit">Hapus PO</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
