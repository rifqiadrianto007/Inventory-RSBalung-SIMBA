<?php

namespace App\Http\Controllers;

use App\Models\Penerimaan;
use App\Models\DetailPenerimaan;
use App\Models\Bast;
use App\Models\Stok;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class PenerimaanGudangController extends Controller
{
    /**
     * Daftar penerimaan untuk Admin Gudang
     */
    public function index()
    {
        $data = Penerimaan::where('status_kelayakan', 'layak')
            ->orderBy('id_penerimaan', 'desc')
            ->get();

        return view('penerimaan.gudang.index', compact('data'));
    }

    /**
     * ADMIN GUDANG DOWNLOAD BAST DRAFT
     */
    public function downloadDraft($id)
    {
        $p = Penerimaan::with('detail')->findOrFail($id);

        // Generate PDF draft otomatis
        $html = view('penerimaan.gudang.bast_draft_pdf', compact('p'))->render();

        $pdfName = "BAST-DRAFT-{$p->id_penerimaan}.pdf";

        return response()->streamDownload(function () use ($html) {
            echo $html;
        }, $pdfName);
    }

    /**
     * FORM UPLOAD BAST FINAL (Sudah ditandatangani)
     */
    public function uploadFinal($id)
    {
        $penerimaan = Penerimaan::findOrFail($id);

        if ($penerimaan->file_bast !== null) {
            return back()->with('warning', 'BAST sudah diupload.');
        }

        return view('penerimaan.gudang.upload_bast', compact('penerimaan'));
    }

    /**
     * SIMPAN BAST FINAL + UPDATE STOK
     */
    public function storeFinal(Request $request, $id)
    {
        $penerimaan = Penerimaan::with('detail')->findOrFail($id);

        $request->validate([
            'file_bast' => 'required|file|mimes:pdf',
        ]);

        // Simpan file
        $path = $request->file('file_bast')->store('bast', 'public');

        // Simpan ke tabel BAST
        $penerimaan->update([
            'file_bast' => $path,
        ]);

        // UPDATE STOK (PAKAI total_stok)
        foreach ($penerimaan->detail as $d) {
            $stok = $d->stok;

            if ($stok) {
                $stok->total_stok = $stok->total_stok + $d->volume;
                $stok->save();
            }
        }

        return redirect()->route('gudang.penerimaan.index')
            ->with('success', 'BAST final berhasil diupload dan stok diperbarui.');

        // notifikasi untuk admin
        Notifikasi::create([
            'judul'=>'BAST final diupload',
            'pesan'=>'BAST untuk penerimaan #'.$penerimaan->id_penerimaan.'telah diupload dan stok diperbarui.',
            'link'=>'/penerimaan/'.$penerimaan->id_penerimaan
        ]);

    }

    /**
     * DOWNLOAD BAST FINAL
     */
    public function downloadFinal($id)
    {
        $p = Penerimaan::findOrFail($id);

        if (!$p->file_bast) {
            return back()->with('warning', 'BAST final belum diupload.');
        }

        return response()->download(storage_path("app/public/" . $p->file_bast));
    }
}
