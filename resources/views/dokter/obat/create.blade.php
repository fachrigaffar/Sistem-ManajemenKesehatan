@extends('layouts.app')

@section('title', 'Dashboard Dokter')
@section('subtitle', 'Tambah Obat')

@section('nav-item')
  @if (request()->is('dokter*'))
    <li class="nav-item">
      <a href="/dokter/periksa" class="nav-link {{ request()->is('dokter/periksa*') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Periksa</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/dokter/obat" class="nav-link {{ request()->is('dokter/obat*') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Obat</p>
      </a>
    </li>
  @else
    @each('adminlte::partials.sidebar.menu-item', $adminlte->menu(), 'item')
  @endif
@endsection

@section('content')
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Tambah Obat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('obat.index') }}">Obat</a></li>
              <li class="breadcrumb-item active">Tambah</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Obat</h3>
              </div>
              <form action="{{ route('obat.store') }}" method="POST">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" name="nama_obat" class="form-control @error('nama_obat') is-invalid @enderror" id="nama_obat" placeholder="Masukkan Nama Obat" value="{{ old('nama_obat') }}">
                    @error('nama_obat')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="kemasan">Jenis Kemasan</label>
                    <input type="text" name="kemasan" class="form-control @error('kemasan') is-invalid @enderror" id="kemasan" placeholder="Masukkan Jenis Kemasan Obat" value="{{ old('kemasan') }}">
                    @error('kemasan')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Masukkan Harga Obat" value="{{ old('harga') }}">
                    @error('harga')
                      <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                  </div>
                </div>
                <div class="card-footer text-right">
                  <a href="{{ route('obat.index') }}" class="btn btn-secondary">Kembali</a>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection