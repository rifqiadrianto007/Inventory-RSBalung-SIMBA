<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use Illuminate\Http\Request;

class PenerimaanTeknisController extends Controller
{
    public function index()
    {
        // Hanya tampilkan barang yang butuh dicek teknis
        $data = Penerimaan::orderBy('tanggal_penerimaan', 'desc')->get();

        return view('penerimaan.teknis.index', compact('data'));
    }

    public function detail($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);

        // Jika barang sudah dicek, jangan biarkan teknis buka halaman ini lagi
        if ($penerimaan->status_kelayakan !== 'belum_dicek') {
            return redirect()->route('teknis.penerimaan.index')
                ->with('warning', 'Barang ini sudah diperiksa sebelumnya.');
        }

        return view('penerimaan.teknis.detail', compact('penerimaan'));
    }

    public function updateKelayakan(Request $request, $id)
    {
        $request->validate([
            'status_kelayakan' => 'required|in:layak,tidak_layak',
            'catatan' => 'nullable|string',
        ]);

        $penerimaan = Penerimaan::with('detail')->findOrFail($id);
        $penerimaan->status_kelayakan = $request->status_kelayakan;
        $penerimaan->catatan = $request->catatan;
        $penerimaan->save();

        // ✅ Jika teknis menetapkan "tidak layak", maka semua item → tidak layak
        if ($request->status_kelayakan == 'tidak_layak') {
            foreach ($penerimaan->detail as $d) {
                $d->layak = false;
                $d->save();
            }
        }

        return redirect()->route('teknis.penerimaan.index')
            ->with('success', 'Pengecekan teknis berhasil disimpan.');
    }

}
