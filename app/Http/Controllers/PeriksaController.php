<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;

class PeriksaController extends Controller
{
    public function index()
    {
        $pasienList = User::where('role', 'pasien')->get();
        return view('dokter.periksa.index', compact('pasienList'));
    }
    
    public function editPeriksa($id)
    {
        $pasien = User::findOrFail($id);
        $obatList = Obat::all();
        return view('dokter.periksa.edit', compact('pasien', 'obatList'));
    }

    public function simpanPeriksa(Request $request, $id)
    {
        $validated = $request->validate([
            'tgl_periksa' => 'required|date',
            'catatan' => 'nullable|string',
            'obat_nama' => 'nullable|array',
            'obat_nama.*' => 'exists:obats,nama_obat',
            'biaya_konsultasi' => 'required|numeric|min:0',
        ]);

        // Calculate total price (consultation fee + drug costs)
        $totalHarga = $validated['biaya_konsultasi'];
        if (!empty($validated['obat_nama'])) {
            $obatList = Obat::whereIn('nama_obat', $validated['obat_nama'])->get()->keyBy('nama_obat');
            foreach ($validated['obat_nama'] as $obatNama) {
                $totalHarga += $obatList[$obatNama]->harga; // Add each drug's price once
            }
        }

        // Save to periksa table
        Periksa::create([
            'id_dokter' => auth()->id(),
            'id_pasien' => $id,
            'tgl_periksa' => $validated['tgl_periksa'],
            'catatan' => $validated['catatan'],
            'biaya_periksa' => $totalHarga, // Total price (consultation + drugs)
        ]);

        return redirect()->route('periksa.index')->with('success', 'Janji temu berhasil disimpan.');
    }

    public function indexPasien()
    {
        $user = auth()->user(); // pasien yang login
        $dokterList = \App\Models\User::where('role', 'dokter')->get();

        $riwayatPeriksa = \App\Models\Periksa::where('id_pasien', $user->id)
            ->with('dokter')
            ->orderBy('tgl_periksa', 'desc')
            ->get();

        return view('pasien.periksa.index', compact('dokterList', 'riwayatPeriksa'));
    }

    public function storePasien(Request $request)
    {
        $request->validate([
            'dokter_id' => 'required|exists:users,id',
        ]);

        \App\Models\Periksa::create([
            'id_pasien' => auth()->id(),
            'id_dokter' => $request->id_dokter,
            'tgl_periksa' => now(), // atau null jika belum ditentukan
        ]);

        return redirect()->route('pasien.periksa.index')->with('success', 'Permintaan periksa dikirim.');
    }

}