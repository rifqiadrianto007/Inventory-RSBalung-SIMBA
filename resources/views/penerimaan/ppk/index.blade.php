<h2>PPK - Draft & Menunggu Kelayakan</h2>

<a href="{{ route('ppk.penerimaan.create') }}">+ Buat Draft Penerimaan</a>
<br><br>

<table border="1" cellpadding="6">
  <tr>
    <th>ID</th><th>Tanggal</th><th>Supplier</th><th>Status</th><th>Item</th><th>Aksi</th>
  </tr>
  @foreach($data as $p)
  <tr>
    <td>{{ $p->id_penerimaan }}</td>
    <td>{{ $p->tanggal_penerimaan }}</td>
    <td>{{ $p->supplier ?? '-' }}</td>
    <td>{{ $p->status }}</td>
    <td>{{ $p->detail_count }}</td>
    <td>
      <a href="{{ route('ppk.penerimaan.detail', $p->id_penerimaan) }}">Detail</a>
    </td>
  </tr>
  @endforeach
</table>
