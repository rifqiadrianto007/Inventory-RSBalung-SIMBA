<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\Pengguna;

class MonitoringController extends Controller
{
    // hanya superadmin yang bisa akses
    public function index()
    {
        // ambil log aktivitas + relasi user
        $logs = LogAktivitas::with(['pengguna'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Monitoring', compact('logs'));
    }

    // monitoring per user
    public function perUser($id)
    {
        $user = Pengguna::findOrFail($id);

        // ambil log aktivitas untuk user tertentu
        $logs = LogAktivitas::where('id_sso', $user->id_sso)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('monitorUser', compact('logs', 'user'));
    }
}
