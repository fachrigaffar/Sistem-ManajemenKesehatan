<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use Illuminate\Support\Facades\Log;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::all();
        return view('dokter.obat.index', compact('obats'));
    }

    public function create()
    {
        return view('dokter.obat.create');
    }

    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'nama_obat' => 'required|string|max:255',
        'kemasan' => 'nullable|string|max:255',
        'harga' => 'required|numeric|min:0',
    ]);

    // Log data yang diterima
    Log::info('Data received for store: ' . json_encode($request->all()));

    // Aktifkan query logging
    \DB::enableQueryLog();

    try {
        $obat = new Obat();
        $obat->nama_obat = $request->nama_obat;
        $obat->kemasan = $request->kemasan;
        $obat->harga = (int) $request->harga;
        $saved = $obat->save();

        // Log query yang dijalankan
        Log::info('Query executed: ' . json_encode(\DB::getQueryLog()));
        Log::info('Save result: ' . ($saved ? 'Success' : 'Failed'));

        if ($saved) {
            return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan.');
        } else {
            return back()->withErrors(['error' => 'Gagal menyimpan obat: Tidak ada data yang tersimpan.']);
        }
    } catch (\Exception $e) {
        Log::error('Error storing obat: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Gagal menambahkan obat: ' . $e->getMessage()]);
    }
}

    public function edit($id)
    {
        $obat = Obat::findOrFail($id);
        return view('dokter.obat.edit', compact('obat'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'nullable|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        try {
            $obat = Obat::findOrFail($id);
            $obat->update($request->all());
            return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Error updating obat: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal memperbarui obat. Silakan coba lagi.']);
        }
    }

    public function destroy($id)
    {
        try {
            $obat = Obat::findOrFail($id);
            $obat->delete();
            return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus.');
        } catch (\Exception $e) {
            Log::error('Error deleting obat: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal menghapus obat. Silakan coba lagi.']);
        }
    }
}