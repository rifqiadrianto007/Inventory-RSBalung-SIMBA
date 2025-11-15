<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stok;
use App\Traits\ApiResponse;

class StokApiController extends Controller
{
    use ApiResponse;

    public function index(Request $request){
        $q = Stok::with(['kategori','satuan']);
        if ($request->has('kategori')) {
            $q->where('id_kategori', $request->kategori);
        }
        return $this->success($q->get(), 'Daftar stok berhasil diambil');
    }

    public function show($id){
        $s = Stok::with(['kategori','satuan'])->findOrFail($id);
        return $this->success($s, 'Detail stok');
    }

    public function store(Request $request){
        $request->validate([
            'nama_barang'=>'required',
            'id_kategori'=>'nullable|integer',
            'id_satuan'=>'nullable|integer',
            'harga'=>'nullable|numeric',
            'total_stok'=>'nullable|integer',
        ]);
        $s = Stok::create($request->all());
        return $this->success($s, 'Stok berhasil dibuat', 201);
    }

    public function update(Request $request, $id){
        $s = Stok::findOrFail($id);
        $s->update($request->all());
        return $this->success($s, 'Stok berhasil diperbarui');
    }

    // endpoint util: adjust stok (dipanggil setelah BAST final di Sprint1)
    public function adjustStock(Request $request, $id){
        $request->validate(['delta'=>'required|integer']);
        $s = Stok::findOrFail($id);
        $s->total_stok += intval($request->delta);
        if ($s->total_stok < 0) $s->total_stok = 0;
        $s->save();
        return $this->success($s, 'Stok berhasil disesuaikan');
    }
}
