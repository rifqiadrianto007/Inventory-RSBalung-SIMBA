<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\DetailPenerimaan;
use Illuminate\Http\Request;

class PenerimaanTeknisController extends Controller
{
    /**
     * ✅ 1. LIST PENERIMAAN YANG PERLU DICEK TEKNIS
     */
    public function index()
    {
        $data = Penerimaan::where('status', 'cek_teknis')
            ->orderBy('id_penerimaan', 'DESC')
            ->get();

        return view('penerimaan.teknis.index', compact('data'));
    }

    /**
     * ✅ 2. DETAIL PENERIMAAN + LIST BARANG
     */
    public function detail($id)
    {
        $penerimaan = Penerimaan::with('detail.stok', 'detail.satuan')
            ->findOrFail($id);

        if ($penerimaan->status !== 'cek_teknis') {
            return back()->with('warning', 'Barang ini belum masuk tahap pemeriksaan teknis.');
        }

        return view('penerimaan.teknis.detail', compact('penerimaan'));
    }

    /**
     * ✅ 3. UPDATE KELAYAKAN PER ITEM DETAIL
     */
    public function updateKelayakan(Request $request, $id_detail)
    {
        $detail = DetailPenerimaan::with('penerimaan')->findOrFail($id_detail);
        $penerimaan = $detail->penerimaan;

        if ($penerimaan->status !== 'cek_teknis') {
            return back()->with('warning', 'Pemeriksaan teknis sudah selesai. Tidak dapat mengubah kelayakan.');
        }

        $request->validate([
            'layak' => 'required|boolean',
        ]);

        $detail->layak = $request->layak;
        $detail->save();

        return back()->with('success', 'Status kelayakan berhasil diperbarui.');
    }

    /**
     * ✅ 4. FINALISASI TEKNIS → LANJUT KE ADMIN GUDANG
     * Hanya bisa dilakukan jika semua item diberi status kelayakan
     */
    public function submitToGudang($id)
    {
        $penerimaan = Penerimaan::with('detail')->findOrFail($id);

        if ($penerimaan->status !== 'cek_teknis') {
            return back()->with('warning', 'Pemeriksaan teknis belum dimulai.');
        }

        // ✅ Pastikan semua detail sudah dicek
        foreach ($penerimaan->detail as $d) {
            if ($d->layak === null) {
                return back()->with('warning', 'Masih ada barang yang belum diperiksa.');
            }
        }

        // ✅ Tentukan status_kelayakan penerimaan
        $allLayak = $penerimaan->detail->every(fn($d) => $d->layak === 1);

        $penerimaan->update([
            'status_kelayakan' => $allLayak ? 'layak' : 'tidak_layak',
            'status' => 'siap_gudang',
        ]);

        return redirect()->route('teknis.penerimaan.index')
            ->with('success', 'Pemeriksaan teknis selesai dan diteruskan ke Admin Gudang.');
    }
}
