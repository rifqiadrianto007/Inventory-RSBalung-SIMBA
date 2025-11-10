<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use Illuminate\Http\Request;

class PenerimaanTeknisController extends Controller
{
    // Halaman daftar penerimaan
    public function index()
    {
        $data = Penerimaan::orderBy('tanggal_penerimaan', 'desc')->get();
        return view('penerimaan.teknis.index', compact('data'));
    }

    // Halaman detail + form pengecekan
    public function detail($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);
        return view('penerimaan.teknis.detail', compact('penerimaan'));
    }

    // Aksi pengecekan
    public function updateKelayakan(Request $request, $id)
    {
        $request->validate([
            'status_kelayakan' => 'required|in:layak,tidak_layak',
            'catatan' => 'nullable|string',
        ]);

        $penerimaan = Penerimaan::findOrFail($id);
        $penerimaan->status_kelayakan = $request->status_kelayakan;
        $penerimaan->catatan = $request->catatan;
        $penerimaan->save();

        return redirect()->route('teknis.penerimaan.index')
                         ->with('success', 'Pengecekan barang berhasil disimpan.');
    }
}
