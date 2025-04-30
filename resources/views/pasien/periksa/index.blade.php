@extends('layouts.app')

@section('title', 'Periksa Pasien')

@section('content')
<div class="container">
    <h4>Form Periksa</h4>

    <form action="{{ route('pasien.periksa.simpan') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Pilih Dokter</label>
            <select name="id_dokter" class="form-control" required>
                <option value="">-- Pilih Dokter --</option>
                @foreach ($dokterList as $dokter)
                    <option value="{{ $dokter->id }}">{{ $dokter->nama }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajukan Periksa</button>
    </form>

    <hr>

    <h5>Riwayat Periksa</h5>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dokter</th>
                <th>Tanggal Periksa</th>
                <th>Biaya</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($riwayatPeriksa as $index => $riwayat)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $riwayat->dokter->nama ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($riwayat->tgl_periksa)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($riwayat->biaya_konsultasi ?? 0) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada riwayat periksa.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
