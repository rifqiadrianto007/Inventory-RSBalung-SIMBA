<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use Illuminate\Http\Request;

class PenerimaanPPKController extends Controller
{
    /**
     * ✅ LIST DATA PENERIMAAN (hanya draft PPK)
     */
    public function index()
    {
        $data = Penerimaan::orderBy('id_penerimaan', 'DESC')->get();

        return view('penerimaan.ppk.index', compact('data'));
    }

    /**
     * ✅ FORM TAMBAH PENERIMAAN BARU
     */
    public function create()
    {
        return view('penerimaan.ppk.create');
    }

    /**
     * ✅ SIMPAN PENERIMAAN BARU
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_penerimaan' => 'required|date',
            'supplier' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        Penerimaan::create([
            'tanggal_penerimaan' => $request->tanggal_penerimaan,
            'supplier' => $request->supplier,
            'catatan' => $request->catatan,
            'status' => 'draft_ppk',          // PPK membuat draft
            'status_kelayakan' => 'belum_dicek',
        ]);

        return redirect()->route('ppk.penerimaan.index')
            ->with('success', 'Penerimaan berhasil dibuat. Tambahkan detail barang.');
    }

    /**
     * ✅ FORM EDIT HEADER
     */
    public function edit($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);

        if ($penerimaan->status !== 'draft_ppk') {
            return back()->with('warning', 'Tidak dapat mengedit. Barang sudah dikirim ke teknis.');
        }

        return view('penerimaan.ppk.edit', compact('penerimaan'));
    }

    /**
     * ✅ UPDATE HEADER PENERIMAAN
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_penerimaan' => 'required|date',
            'supplier' => 'nullable|string',
            'catatan' => 'nullable|string',
        ]);

        $penerimaan = Penerimaan::findOrFail($id);

        if ($penerimaan->status !== 'draft_ppk') {
            return back()->with('warning', 'Tidak dapat mengedit. Barang sudah dikirim ke teknis.');
        }

        $penerimaan->update([
            'tanggal_penerimaan' => $request->tanggal_penerimaan,
            'supplier' => $request->supplier,
            'catatan' => $request->catatan,
        ]);

        return redirect()->route('ppk.penerimaan.index')
            ->with('success', 'Penerimaan berhasil diperbarui.');
    }

    /**
     * ✅ HAPUS PENERIMAAN (jika belum dicek + belum ada detail)
     */
    public function destroy($id)
    {
        $penerimaan = Penerimaan::with('detail')->findOrFail($id);

        if ($penerimaan->status !== 'draft_ppk') {
            return back()->with('warning', 'Tidak dapat menghapus. Penerimaan sudah dikirim ke teknis.');
        }

        if ($penerimaan->detail->count() > 0) {
            return back()->with('warning', 'Tidak dapat menghapus karena sudah ada detail barang.');
        }

        $penerimaan->delete();

        return back()->with('success', 'Penerimaan berhasil dihapus.');
    }

    /**
     * ✅ SUBMIT KE TEKNIS
     * PPK mengirim penerimaan ke teknis untuk diperiksa
     */
    public function submitToTeknis($id)
    {
        $penerimaan = Penerimaan::with('detail')->findOrFail($id);

        // Tidak bisa submit jika tidak ada detail
        if ($penerimaan->detail->count() === 0) {
            return back()->with('warning', 'Tidak dapat mengirim ke teknis. Tambahkan detail barang terlebih dahulu.');
        }

        // Tidak bisa submit dua kali
        if ($penerimaan->status !== 'draft_ppk') {
            return back()->with('warning', 'Penerimaan sudah dikirim ke teknis sebelumnya.');
        }

        // Update status ke teknis
        $penerimaan->update([
            'status' => 'cek_teknis',
        ]);

        return redirect()->route('ppk.penerimaan.index')
            ->with('success', 'Data berhasil dikirim ke Tim Teknis.');
    }
}
