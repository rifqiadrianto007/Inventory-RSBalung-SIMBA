<?php

namespace App\Http\Controllers;

use App\Models\DetailPenerimaan;
use App\Models\Penerimaan;
use App\Models\Stok;
use App\Models\Satuan;
use Illuminate\Http\Request;

class DetailPenerimaanController extends Controller
{
    public function index($id)
    {
        $penerimaan = Penerimaan::with('detail')->findOrFail($id);
        return view('detail.index', compact('penerimaan'));
    }

    public function create($id)
    {
        $stok = Stok::all();
        $satuan = Satuan::all();
        return view('detail.create', compact('id', 'stok', 'satuan'));
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'id_stok' => 'required',
            'volume' => 'required|numeric',
            'harga' => 'required|numeric',
            'id_satuan' => 'required',
        ]);

        DetailPenerimaan::create([
            'id_penerimaan' => $id,
            'id_stok' => $request->id_stok,
            'volume' => $request->volume,
            'harga' => $request->harga,
            'id_satuan' => $request->id_satuan,
            'layak' => true
        ]);

        return redirect()->route('detail.index', $id)
            ->with('success', 'Detail barang berhasil ditambahkan.');
    }

    public function edit($id_detail)
    {
        $detail = DetailPenerimaan::findOrFail($id_detail);
        $stok = Stok::all();
        $satuan = Satuan::all();
        return view('detail.edit', compact('detail', 'stok', 'satuan'));
    }

    public function update(Request $request, $id_detail)
    {
        $request->validate([
            'id_stok' => 'required',
            'volume' => 'required|numeric',
            'harga' => 'required|numeric',
            'id_satuan' => 'required',
        ]);

        $detail = DetailPenerimaan::findOrFail($id_detail);
        $detail->update($request->all());

        return redirect()->route('detail.index', $detail->id_penerimaan)
            ->with('success', 'Detail barang berhasil diperbarui.');
    }

    public function destroy($id_detail)
    {
        $detail = DetailPenerimaan::findOrFail($id_detail);
        $id_penerimaan = $detail->id_penerimaan;

        $detail->delete();

        return redirect()->route('detail.index', $id_penerimaan)
            ->with('success', 'Detail barang berhasil dihapus.');
    }
}
