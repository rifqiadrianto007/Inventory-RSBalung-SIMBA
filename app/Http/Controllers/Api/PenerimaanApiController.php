<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Traits\ApiResponse; // ⬅️ tambahkan

class PenerimaanApiController extends Controller
{
    use ApiResponse; // ⬅️ aktifkan trait

    public function index()
    {
        $data = Penerimaan::with('detail')->get();
        return $this->success($data, 'Daftar penerimaan berhasil diambil');
    }

    public function show($id)
    {
        $p = Penerimaan::with('detail')->findOrFail($id);
        return $this->success($p, 'Detail penerimaan ditemukan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_po' => 'required|string',
            'tanggal_penerimaan' => 'required|date',
            'supplier' => 'nullable|string',
        ]);

        $data = Penerimaan::create($request->all());
        return $this->success($data, 'Penerimaan berhasil dibuat', 201);
    }

    public function update(Request $request, $id)
    {
        $p = Penerimaan::findOrFail($id);
        $p->update($request->all());
        return $this->success($p, 'Penerimaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $p = Penerimaan::findOrFail($id);
        $p->delete();
        return $this->success(null, 'Penerimaan berhasil dihapus');
    }

    public function uploadBast(Request $request, $id)
    {
        $request->validate(['file_bast' => 'required|mimes:pdf']);
        $p = Penerimaan::findOrFail($id);

        $path = $request->file('file_bast')->store('bast', 'public');
        $p->update(['file_bast' => $path]);

        return $this->success(['file_path' => $path], 'BAST berhasil diupload');
    }

    public function downloadBast($id)
    {
        $p = Penerimaan::findOrFail($id);

        if (!$p->file_bast || !Storage::exists('public/'.$p->file_bast)) {
            return $this->error('File tidak ditemukan', 404);
        }

        return response()->download(storage_path('app/public/'.$p->file_bast));
    }
}
