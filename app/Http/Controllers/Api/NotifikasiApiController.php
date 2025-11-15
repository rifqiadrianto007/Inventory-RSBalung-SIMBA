<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notifikasi;
use App\Traits\ApiResponse;

class NotifikasiApiController extends Controller
{
    use ApiResponse;

    // list for user or pegawai
    public function index(Request $request){
        $q = Notifikasi::query();
        if ($request->has('id_pengguna')) $q->where('id_pengguna', $request->id_pengguna);
        if ($request->has('id_pegawai')) $q->where('id_pegawai', $request->id_pegawai);
        return $this->success($q->latest()->get(), 'Daftar notifikasi');
    }

    public function store(Request $request){
        $request->validate(['judul'=>'required','pesan'=>'nullable']);
        $n = Notifikasi::create($request->all());
        return $this->success($n, 'Notifikasi dibuat', 201);
    }

    public function markRead($id){
        $n = Notifikasi::findOrFail($id);
        $n->is_read = true;
        $n->save();
        return $this->success($n, 'Notifikasi ditandai terbaca');
    }
}
