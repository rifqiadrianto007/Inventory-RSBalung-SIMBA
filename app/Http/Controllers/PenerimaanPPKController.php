<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use Illuminate\Http\Request;

class PenerimaanPPKController extends Controller
{
    public function index()
    {
        $data = Penerimaan::orderBy('id_penerimaan','desc')->get();
        return view('penerimaan.ppk.index', compact('data'));
    }

    public function create()
    {
        return view('penerimaan.ppk.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_po' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required|numeric',
            'satuan' => 'required',
            'tanggal_penerimaan' => 'required|date',
            'supplier' => 'nullable|string',
        ]);

        Penerimaan::create($request->all());

        return redirect()->route('ppk.penerimaan.index')
                         ->with('success', 'Data belanja berhasil dibuat.');
    }

    public function edit($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);
        return view('penerimaan.ppk.edit', compact('penerimaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nomor_po' => 'required',
            'nama_barang' => 'required',
            'jumlah' => 'required|numeric',
            'satuan' => 'required',
            'tanggal_penerimaan' => 'required|date',
        ]);

        $penerimaan = Penerimaan::findOrFail($id);
        $penerimaan->update($request->all());

        return redirect()->route('ppk.penerimaan.index')
                         ->with('success', 'Data belanja berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Penerimaan::findOrFail($id)->delete();

        return redirect()->route('ppk.penerimaan.index')
                         ->with('success', 'Data belanja berhasil dihapus.');
    }
}
