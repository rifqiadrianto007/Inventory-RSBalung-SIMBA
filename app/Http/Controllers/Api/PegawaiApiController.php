<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Traits\ApiResponse;

class PegawaiApiController extends Controller
{
    use ApiResponse;

    public function index(){
        return $this->success(Pegawai::all(), 'Daftar pegawai');
    }

    public function show($id){
        return $this->success(Pegawai::findOrFail($id), 'Detail pegawai');
    }

    public function store(Request $request){
        $request->validate([
            'nama'=>'required',
            'nip'=>'nullable|unique:pegawai,nip',
            'email'=>'nullable|email|unique:pegawai,email'
        ]);
        $p = Pegawai::create($request->all());
        return $this->success($p, 'Pegawai dibuat', 201);
    }

    public function update(Request $request, $id){
        $p = Pegawai::findOrFail($id);
        $p->update($request->all());
        return $this->success($p, 'Pegawai diperbarui');
    }

    public function toggleStatus($id){
        $p = Pegawai::findOrFail($id);
        $p->status = $p->status === 'aktif' ? 'nonaktif' : 'aktif';
        $p->save();
        return $this->success($p, 'Status pegawai diperbarui');
    }
}
