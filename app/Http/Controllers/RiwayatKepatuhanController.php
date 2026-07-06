<?php

namespace App\Http\Controllers;

use App\Models\JadwalMinumObat;
use App\Models\Pasien;
use App\Models\RiwayatKepatuhan;
use Illuminate\Http\Request;

class RiwayatKepatuhanController extends Controller
{
    public function index(Request $request)
    {
        $pasiens = Pasien::where('user_id', auth()->id())->get();

        $query = RiwayatKepatuhan::with(['jadwal.pasien', 'jadwal.obat'])
            ->where('user_id', auth()->id());

        if ($request->filled('pasien_id')) {
            $query->whereHas('jadwal', function ($q) use ($request) {
                $q->where('pasien_id', $request->pasien_id);
            });
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $riwayats = $query->orderByDesc('tanggal')->orderByDesc('jam_seharusnya')->get();

        $totalTepatWaktu = (clone $query)->where('status', 'tepat_waktu')->count();
        $totalTerlambat = (clone $query)->where('status', 'terlambat')->count();
        $totalTidakDiminum = (clone $query)->where('status', 'tidak_diminum')->count();

        return view('riwayat.index', compact(
            'riwayats', 'pasiens',
            'totalTepatWaktu', 'totalTerlambat', 'totalTidakDiminum'
        ));
    }

    public function tandaiDiminum(RiwayatKepatuhan $riwayat)
    {
        if ($riwayat->user_id !== auth()->id()) {
            abort(403);
        }

        $sekarang = now();
        $jamSeharusnya = \Carbon\Carbon::parse($riwayat->jam_seharusnya);

        $status = $sekarang->format('H:i') > $jamSeharusnya->addMinutes(30)->format('H:i')
            ? 'terlambat'
            : 'tepat_waktu';

        $riwayat->update([
            'jam_diminum' => $sekarang->format('H:i:s'),
            'status' => $status,
        ]);

        return redirect()->route('riwayat.index')->with('success', 'Status berhasil diperbarui: obat sudah diminum.');
    }
}