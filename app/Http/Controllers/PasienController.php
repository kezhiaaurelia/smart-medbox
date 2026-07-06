<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kontak_darurat' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        $validated['user_id'] = auth()->id();

        Pasien::create($validated);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil ditambahkan.');
    }

    public function edit(Pasien $pasien)
    {
        $this->authorizeOwner($pasien);

        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $this->authorizeOwner($pasien);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kontak_darurat' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        $pasien->update($validated);

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    public function destroy(Pasien $pasien)
    {
        $this->authorizeOwner($pasien);

        $pasien->delete();

        return redirect()->route('pasien.index')->with('success', 'Data pasien berhasil dihapus.');
    }

    private function authorizeOwner(Pasien $pasien): void
    {
        if ($pasien->user_id !== auth()->id()) {
            abort(403);
        }
    }
}