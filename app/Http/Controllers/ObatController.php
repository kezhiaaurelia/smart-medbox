<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('obat.index', compact('obats'));
    }

    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'dosis' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();

        Obat::create($validated);

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil ditambahkan.');
    }

    public function edit(Obat $obat)
    {
        $this->authorizeOwner($obat);

        return view('obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $this->authorizeOwner($obat);

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'dosis' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string|max:255',
        ]);

        $obat->update($validated);

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil diperbarui.');
    }

    public function destroy(Obat $obat)
    {
        $this->authorizeOwner($obat);

        $obat->delete();

        return redirect()->route('obat.index')->with('success', 'Data obat berhasil dihapus.');
    }

    private function authorizeOwner(Obat $obat): void
    {
        if ($obat->user_id !== auth()->id()) {
            abort(403);
        }
    }
}