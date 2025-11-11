<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\DetailPenerimaan;
use App\Models\Stok;
use App\Models\Satuan;
use Illuminate\Http\Request;

class DetailPenerimaanController extends Controller
{
    /**
     * ✅ LIST DETAIL BARANG DALAM 1 PENERIMAAN
     */
    public function index($id)
    {
        $penerimaan = Penerimaan::with('detail.stok', 'detail.satuan')
            ->findOrFail($id);

        return view('detail.index', compact('penerimaan'));
    }

    /**
     * ✅ FORM TAMBAH DETAIL BARANG
     * Hanya PPK yang boleh menambah saat status = draft_ppk
     */
    public function create($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);

        if ($penerimaan->status !== 'draft_ppk') {
            return back()->with('warning', 'Tidak dapat menambah detail. Penerimaan sudah dikirim ke teknis.');
        }

        $stok = Stok::all();
        $satuan = Satuan::all();

        return view('detail.create', compact('penerimaan', 'stok', 'satuan'));
    }

    /**
     * ✅ SIMPAN DETAIL BARANG
     */
    public function store(Request $request, $id)
    {
        $request->validate([
            'id_stok' => 'required|exists:stok,id_stok',
            'volume' => 'required|numeric|min:1',
            'id_satuan' => 'required|exists:satuan,id_satuan',
            'harga' => 'nullable|numeric|min:0',
        ]);

        $penerimaan = Penerimaan::findOrFail($id);

        if ($penerimaan->status !== 'draft_ppk') {
            return back()->with('warning', 'Tidak dapat menambah detail. Penerimaan sudah dikirim ke teknis.');
        }

        DetailPenerimaan::create([
            'id_penerimaan' => $id,
            'id_stok' => $request->id_stok,
            'volume' => $request->volume,
            'id_satuan' => $request->id_satuan,
            'harga' => $request->harga ?? 0,
            'layak' => true, // default
        ]);

        return redirect()->route('detail.index', $id)
            ->with('success', 'Detail barang berhasil ditambahkan.');
    }

    /**
     * ✅ FORM EDIT DETAIL BARANG
     * Hanya bisa sebelum masuk teknis
     */
    public function edit($id_detail)
    {
        $detail = DetailPenerimaan::with('penerimaan')->findOrFail($id_detail);
        $penerimaan = $detail->penerimaan;

        if ($penerimaan->status !== 'draft_ppk') {
            return back()->with('warning', 'Tidak dapat mengedit. Barang sudah dikirim ke teknis.');
        }

        $stok = \App\Models\Stok::all();
        $satuan = \App\Models\Satuan::all();

        return view('detail.edit', compact('detail', 'stok', 'satuan'));
    }

    /**
     * ✅ UPDATE DETAIL BARANG
     */
    public function update(Request $request, $id_detail)
    {
        $request->validate([
            'id_stok' => 'required|exists:stok,id_stok',
            'volume' => 'required|numeric|min:1',
            'id_satuan' => 'required|exists:satuan,id_satuan',
            'harga' => 'nullable|numeric|min:0',
        ]);

        $detail = DetailPenerimaan::with('penerimaan')->findOrFail($id_detail);
        $penerimaan = $detail->penerimaan;

        if ($penerimaan->status !== 'draft_ppk') {
            return back()->with('warning', 'Tidak dapat mengedit. Barang sudah dikirim ke teknis.');
        }

        $detail->update([
            'id_stok' => $request->id_stok,
            'volume' => $request->volume,
            'id_satuan' => $request->id_satuan,
            'harga' => $request->harga ?? 0,
        ]);

        return redirect()->route('detail.index', $penerimaan->id_penerimaan)
            ->with('success', 'Detail barang berhasil diperbarui.');
    }

    /**
     * ✅ HAPUS DETAIL BARANG
     */
    public function destroy($id_detail)
    {
        $detail = DetailPenerimaan::with('penerimaan')->findOrFail($id_detail);
        $penerimaan = $detail->penerimaan;

        if ($penerimaan->status !== 'draft_ppk') {
            return back()->with('warning', 'Tidak dapat menghapus. Barang sudah dikirim ke teknis.');
        }

        $detail->delete();

        return back()->with('success', 'Detail barang berhasil dihapus.');
    }
}
