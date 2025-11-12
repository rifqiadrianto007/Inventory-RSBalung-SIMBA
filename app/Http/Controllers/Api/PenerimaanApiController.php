<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Penerimaan;
use App\Models\DetailPenerimaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PenerimaanApiController extends Controller
{
    public function index()
    {
        $data = Penerimaan::with('detail')->get();
        return response()->json($data);
    }

    public function show($id)
    {
        $p = Penerimaan::with('detail')->findOrFail($id);
        return response()->json($p);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_po' => 'required|string',
            'tanggal_penerimaan' => 'required|date',
            'supplier' => 'nullable|string',
        ]);

        $data = Penerimaan::create($request->all());
        return response()->json(['message' => 'Penerimaan dibuat', 'data' => $data], 201);
    }

    public function update(Request $request, $id)
    {
        $p = Penerimaan::findOrFail($id);
        $p->update($request->all());
        return response()->json(['message' => 'Penerimaan diperbarui', 'data' => $p]);
    }

    public function destroy($id)
    {
        $p = Penerimaan::findOrFail($id);
        $p->delete();
        return response()->json(['message' => 'Penerimaan dihapus']);
    }

    public function uploadBast(Request $request, $id)
    {
        $request->validate(['file_bast' => 'required|mimes:pdf']);
        $p = Penerimaan::findOrFail($id);

        $path = $request->file('file_bast')->store('bast', 'public');
        $p->update(['file_bast' => $path]);

        return response()->json(['message' => 'BAST berhasil diupload', 'file_path' => $path]);
    }

    public function downloadBast($id)
    {
        $p = Penerimaan::findOrFail($id);

        if (!$p->file_bast || !Storage::exists('public/'.$p->file_bast)) {
            return response()->json(['message' => 'File tidak ditemukan'], 404);
        }

        return response()->download(storage_path('app/public/'.$p->file_bast));
    }
}
