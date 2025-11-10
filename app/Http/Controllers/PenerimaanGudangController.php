<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\Bast;
use Illuminate\Http\Request;

class PenerimaanGudangController extends Controller
{
    public function index()
    {
        $data = Penerimaan::orderBy('id_penerimaan','desc')->get();
        return view('penerimaan.gudang.index', compact('data'));
    }

    public function uploadBast($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);
        return view('penerimaan.gudang.upload_bast', compact('penerimaan'));
    }

    public function storeBast(Request $request, $id)
    {
        $request->validate([
            'nomor_surat' => 'required',
            'deskripsi' => 'required',
            'file_bast' => 'nullable|file|mimes:pdf',
        ]);

        // upload
        $path = null;
        if ($request->hasFile('file_bast')) {
            $path = $request->file_bast->store('bast', 'public');
        }

        Bast::create([
            'nomor_surat' => $request->nomor_surat,
            'id_penerimaan' => $id,
            'deskripsi' => $request->deskripsi,
            'file_path' => $path,
        ]);

        return redirect()->route('gudang.penerimaan.index')
                         ->with('success', 'BAST berhasil disimpan.');
    }

    public function downloadBast($id)
    {
        $bast = Bast::findOrFail($id);
        return response()->download(storage_path("app/public/" . $bast->file_path));
    }
}
