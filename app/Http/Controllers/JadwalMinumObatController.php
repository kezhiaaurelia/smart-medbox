<?php

namespace App\Http\Controllers;

use App\Models\JadwalMinumObat;
use App\Models\Obat;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalMinumObatController extends Controller
{
    public function index()
    {
        $jadwals = JadwalMinumObat::with(['pasien', 'obat', 'jamMinums'])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $pasiens = Pasien::where('user_id', auth()->id())->get();
        $obats = Obat::where('user_id', auth()->id())->get();

        if ($pasiens->isEmpty() || $obats->isEmpty()) {
            return redirect()->route('jadwal.index')
                ->with('error', 'Tambahkan data Pasien dan Obat terlebih dahulu sebelum membuat jadwal.');
        }

        return view('jadwal.create', compact('pasiens', 'obats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'obat_id' => 'required|exists:obats,id',
            'tipe_frekuensi' => 'required|in:setiap_hari,interval_hari',
            'interval_hari' => 'required_if:tipe_frekuensi,interval_hari|nullable|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'jam' => 'required|array|min:1',
            'jam.*' => 'required|date_format:H:i',
        ]);

        $this->authorizeRelation($validated['pasien_id'], $validated['obat_id']);

        DB::transaction(function () use ($validated) {
            $jadwal = JadwalMinumObat::create([
                'user_id' => auth()->id(),
                'pasien_id' => $validated['pasien_id'],
                'obat_id' => $validated['obat_id'],
                'tipe_frekuensi' => $validated['tipe_frekuensi'],
                'interval_hari' => $validated['tipe_frekuensi'] === 'interval_hari' ? $validated['interval_hari'] : 1,
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'keterangan' => $validated['keterangan'] ?? null,
                'aktif' => true,
            ]);

            foreach ($validated['jam'] as $jam) {
                $jadwal->jamMinums()->create(['jam' => $jam]);
            }
        });

        return redirect()->route('jadwal.index')->with('success', 'Jadwal minum obat berhasil ditambahkan.');
    }

    public function edit(JadwalMinumObat $jadwal)
    {
        $this->authorizeOwner($jadwal);

        $pasiens = Pasien::where('user_id', auth()->id())->get();
        $obats = Obat::where('user_id', auth()->id())->get();
        $jadwal->load('jamMinums');

        return view('jadwal.edit', compact('jadwal', 'pasiens', 'obats'));
    }

    public function update(Request $request, JadwalMinumObat $jadwal)
    {
        $this->authorizeOwner($jadwal);

        $validated = $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'obat_id' => 'required|exists:obats,id',
            'tipe_frekuensi' => 'required|in:setiap_hari,interval_hari',
            'interval_hari' => 'required_if:tipe_frekuensi,interval_hari|nullable|integer|min:1',
            'tanggal_mulai' => 'required|date',
            'keterangan' => 'nullable|string|max:255',
            'jam' => 'required|array|min:1',
            'jam.*' => 'required|date_format:H:i',
        ]);

        $this->authorizeRelation($validated['pasien_id'], $validated['obat_id']);

        DB::transaction(function () use ($validated, $jadwal) {
            $jadwal->update([
                'pasien_id' => $validated['pasien_id'],
                'obat_id' => $validated['obat_id'],
                'tipe_frekuensi' => $validated['tipe_frekuensi'],
                'interval_hari' => $validated['tipe_frekuensi'] === 'interval_hari' ? $validated['interval_hari'] : 1,
                'tanggal_mulai' => $validated['tanggal_mulai'],
                'keterangan' => $validated['keterangan'] ?? null,
            ]);

            $jadwal->jamMinums()->delete();
            foreach ($validated['jam'] as $jam) {
                $jadwal->jamMinums()->create(['jam' => $jam]);
            }
        });

        return redirect()->route('jadwal.index')->with('success', 'Jadwal minum obat berhasil diperbarui.');
    }

    public function destroy(JadwalMinumObat $jadwal)
    {
        $this->authorizeOwner($jadwal);
        $jadwal->delete();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal minum obat berhasil dihapus.');
    }

    public function toggle(JadwalMinumObat $jadwal)
    {
        $this->authorizeOwner($jadwal);
        $jadwal->update(['aktif' => ! $jadwal->aktif]);

        return redirect()->route('jadwal.index')->with('success', 'Status jadwal berhasil diperbarui.');
    }

    private function authorizeOwner(JadwalMinumObat $jadwal): void
    {
        if ($jadwal->user_id !== auth()->id()) {
            abort(403);
        }
    }

    private function authorizeRelation(int $pasienId, int $obatId): void
    {
        $pasienValid = Pasien::where('id', $pasienId)->where('user_id', auth()->id())->exists();
        $obatValid = Obat::where('id', $obatId)->where('user_id', auth()->id())->exists();

        if (! $pasienValid || ! $obatValid) {
            abort(403);
        }
    }
}