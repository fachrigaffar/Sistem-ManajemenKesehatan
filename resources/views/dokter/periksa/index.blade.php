@extends('layouts.app')

@section('title', 'Periksa Pasien')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h3>Daftar Pasien</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pasienList as $index => $pasien)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $pasien->nama }}</td>
                            <td>
                                <a href="{{ route('periksa.edit', $pasien->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                    @if($pasienList->isEmpty())
                        <tr><td colspan="3">Tidak ada pasien ditemukan</td></tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection