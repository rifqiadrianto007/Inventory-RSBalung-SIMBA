<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use App\Models\Notifikasi;
use App\Traits\ApiResponse;

class PemesananApiController extends Controller
{
    use ApiResponse;

    public function index(){
        return $this->success(Pemesanan::with('detail')->get(), 'Daftar pemesanan');
    }

    public function show($id){
        return $this->success(Pemesanan::with('detail')->findOrFail($id), 'Detail pemesanan');
    }

    public function store(Request $request){
        $request->validate([
            'id_pengguna'=>'nullable|integer',
            'departemen'=>'nullable|string',
            'detail'=>'required|array|min:1'
        ]);

        DB::beginTransaction();
        try {
            $p = Pemesanan::create($request->only('id_pengguna','departemen','catatan'));
            foreach ($request->detail as $d) {
                DetailPemesanan::create([
                    'id_pemesanan' => $p->id_pemesanan,
                    'id_stok' => $d['id_stok'],
                    'quantity' => $d['quantity'],
                    'id_satuan' => $d['id_satuan'] ?? null,
                    'harga_estimasi' => $d['harga_estimasi'] ?? 0,
                    'keterangan' => $d['keterangan'] ?? null,
                ]);
            }

            // buat notifikasi ke PPK (contoh)
            Notifikasi::create([
                'judul' => 'Pemesanan baru',
                'pesan' => 'Ada permintaan barang baru dari ' . ($p->departemen ?? 'Instalasi'),
                'link' => '/pemesanan/'.$p->id_pemesanan
            ]);

            DB::commit();
            return $this->success($p->load('detail'), 'Pemesanan dibuat', 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Gagal membuat pemesanan: '.$e->getMessage(), 500);
        }
    }

    // move workflow: ppk approve / teknis check / gudang process
    public function updateStatus(Request $request, $id){
        $request->validate(['status'=>'required|string']);
        $p = Pemesanan::findOrFail($id);
        $old = $p->status;
        $p->status = $request->status;
        $p->save();

        Notifikasi::create([
            'judul' => 'Pemesanan status: '.$p->status,
            'pesan' => "Pemesanan #{$p->id_pemesanan} berubah dari {$old} ke {$p->status}",
            'link' => '/pemesanan/'.$p->id_pemesanan
        ]);

        return $this->success($p, 'Status pemesanan diperbarui');
    }

    public function destroy($id){
        $p = Pemesanan::findOrFail($id);
        $p->delete();
        return $this->success(null, 'Pemesanan dihapus');
    }
}
