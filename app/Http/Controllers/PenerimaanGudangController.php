<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\DetailPenerimaan;
use App\Models\Bast;
use Illuminate\Http\Request;

class PenerimaanGudangController extends Controller
{
    public function index()
    {
        $data = Penerimaan::where('status_kelayakan', '!=', 'belum_dicek')
            ->orderBy('id_penerimaan', 'desc')
            ->get();

        return view('penerimaan.gudang.index', compact('data'));
    }


    /**
     * FORM UPLOAD BAST
     */
    public function uploadBast($id)
    {
        $penerimaan = Penerimaan::with('detail')->findOrFail($id);

        // ✅ 1. Belum dicek teknis
        if ($penerimaan->status_kelayakan == 'belum_dicek') {
            return back()->with('warning', 'Barang belum diperiksa Teknisi.');
        }

        // ✅ 2. Ada item tidak layak
        foreach ($penerimaan->detail as $d) {
            if ($d->layak == false) {
                return back()->with('warning', 'Terdapat item tidak layak. Tidak dapat membuka halaman upload BAST.');
            }
        }

        // ✅ 3. PPK belum membuat PO
        if ($penerimaan->nomor_po == null) {
            return back()->with('warning', 'PPK belum membuat PO.');
        }

        // ✅ 4. BAST sudah ada
        if ($penerimaan->bast()->exists()) {
            return back()->with('warning', 'BAST sudah diupload sebelumnya.');
        }

        return view('penerimaan.gudang.upload_bast', compact('penerimaan'));
    }


    /**
     * SIMPAN BAST + UPDATE STOK + FINALISASI PENERIMAAN
     */
    public function storeBast(Request $request, $id)
    {
        $penerimaan = Penerimaan::with('detail')->findOrFail($id);

        // ✅ 1. Jangan izinkan upload jika ada item tidak layak
        foreach ($penerimaan->detail as $d) {
            if ($d->layak == false) {
                return back()->with('warning', 'Masih ada item tidak layak, BAST tidak dapat diupload.');
            }
        }

        // ✅ 2. Validasi
        $request->validate([
            'nomor_surat' => 'required',
            'deskripsi' => 'required',
            'file_bast' => 'nullable|file|mimes:pdf',
        ]);

        // ✅ 3. Upload file BAST
        $path = null;
        if ($request->hasFile('file_bast')) {
            $path = $request->file_bast->store('bast', 'public');
        }

        // ✅ 4. Simpan data BAST
        Bast::create([
            'nomor_surat' => $request->nomor_surat,
            'id_penerimaan' => $id,
            'deskripsi' => $request->deskripsi,
            'file_path' => $path,
        ]);

        // ✅ 5. UPDATE STOK OTOMATIS
        foreach ($penerimaan->detail as $item) {

            $stok = $item->stok;   // relasi stok dari model DetailPenerimaan

            if (!$stok) {
                continue; // jika stok tidak ditemukan, skip
            }

            // Update jumlah stok
            $stok->jumlah = $stok->jumlah + $item->volume;

            // Pastikan tidak negatif
            if ($stok->jumlah < 0) {
                $stok->jumlah = 0;
            }

            $stok->save();
        }

        // ✅ 6. FINALISASI STATUS PENERIMAAN
        $penerimaan->status = 'selesai';
        $penerimaan->save();

        return redirect()->route('gudang.penerimaan.index')
            ->with('success', 'BAST berhasil disimpan dan stok berhasil diperbarui.');
    }


    /**
     * DOWNLOAD BAST
     */
    public function downloadBast($id)
    {
        $bast = Bast::findOrFail($id);

        if (!$bast->file_path || !file_exists(storage_path("app/public/" . $bast->file_path))) {
            return back()->with('warning', 'File BAST tidak ditemukan.');
        }

        return response()->download(storage_path("app/public/" . $bast->file_path));
    }
}
