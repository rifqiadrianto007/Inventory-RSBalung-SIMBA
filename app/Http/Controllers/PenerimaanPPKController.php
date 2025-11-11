<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use Illuminate\Http\Request;

class PenerimaanPPKController extends Controller
{
    /**
     * LIST SEMUA PENERIMAAN UNTUK PPK
     */
    public function index()
    {
        // ✅ PPK hanya bisa melihat penerimaan yang sudah diperiksa teknis
        $data = Penerimaan::with('detail')
            ->where('status_kelayakan', '!=', 'belum_dicek')
            ->orderBy('id_penerimaan', 'desc')
            ->get();

        return view('penerimaan.ppk.index', compact('data'));
    }


    /**
     * FORM MEMBUAT PO (BERDASARKAN 1 ID PENERIMAAN)
     */
    public function create($id)
    {
        $penerimaan = Penerimaan::with('detail')->findOrFail($id);

        // ✅ Tidak boleh jika teknis belum selesai
        if ($penerimaan->status_kelayakan === 'belum_dicek') {
            return back()->with('warning', 'Belum bisa membuat PO: Barang belum diperiksa Teknis.');
        }

        // ✅ Tidak boleh jika detail barang masih kosong
        if ($penerimaan->detail->count() === 0) {
            return back()->with('warning', 'Detail barang masih kosong. Tambahkan detail barang terlebih dahulu.');
        }

        // ✅ Tidak boleh jika PO sudah ada
        if ($penerimaan->nomor_po !== null) {
            return back()->with('warning', 'PO sudah dibuat untuk penerimaan ini.');
        }

        return view('penerimaan.ppk.create', compact('penerimaan'));
    }


    /**
     * SIMPAN DATA PO
     */
    public function store(Request $request, $id)
    {
        $penerimaan = Penerimaan::with('detail')->findOrFail($id);

        // ✅ Pastikan detail barang tidak kosong
        if ($penerimaan->detail->count() === 0) {
            return back()->with('warning', 'Detail barang masih kosong. Tidak bisa membuat PO.');
        }

        // ✅ Validasi input
        $request->validate([
            'nomor_po' => 'required',
            'supplier' => 'nullable|string',
            'tanggal_penerimaan' => 'required|date',
        ]);

        // ✅ Cek duplikasi nomor PO
        $cek = Penerimaan::where('nomor_po', $request->nomor_po)
            ->where('id_penerimaan', '!=', $id)
            ->exists();

        if ($cek) {
            return back()->with('warning', 'Nomor PO sudah digunakan pada penerimaan lain.');
        }

        // ✅ Update data PO
        $penerimaan->update([
            'nomor_po' => $request->nomor_po,
            'supplier' => $request->supplier,
            'tanggal_penerimaan' => $request->tanggal_penerimaan,
        ]);

        return redirect()
            ->route('ppk.penerimaan.index')
            ->with('success', 'PO berhasil dibuat.');
    }


    /**
     * FORM EDIT PO
     */
    public function edit($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);

        if ($penerimaan->nomor_po === null) {
            return back()->with('warning', 'PO belum dibuat.');
        }

        return view('penerimaan.ppk.edit', compact('penerimaan'));
    }


    /**
     * UPDATE PO
     */
    public function update(Request $request, $id)
    {
        $penerimaan = Penerimaan::findOrFail($id);

        $request->validate([
            'nomor_po' => 'required',
            'supplier' => 'nullable|string',
            'tanggal_penerimaan' => 'required|date',
        ]);

        // ✅ Cegah duplikasi nomor PO
        $cek = Penerimaan::where('nomor_po', $request->nomor_po)
            ->where('id_penerimaan', '!=', $id)
            ->exists();

        if ($cek) {
            return back()->with('warning', 'Nomor PO sudah digunakan pada penerimaan lain.');
        }

        // ✅ Update data PO
        $penerimaan->update([
            'nomor_po' => $request->nomor_po,
            'supplier' => $request->supplier,
            'tanggal_penerimaan' => $request->tanggal_penerimaan,
        ]);

        return redirect()
            ->route('ppk.penerimaan.index')
            ->with('success', 'PO berhasil diperbarui.');
    }


    /**
     * HAPUS PO (OPSIONAL SESUAI UML)
     */
    public function destroy($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);

        // Tidak bisa hapus kalau sudah diverifikasi gudang
        if ($penerimaan->bast()->exists()) {
            return back()->with('warning', 'Tidak dapat menghapus PO karena BAST sudah diupload.');
        }

        $penerimaan->update([
            'nomor_po' => null,
            'supplier' => null,
        ]);

        return back()->with('success', 'PO berhasil dihapus.');
    }
}
