@extends('layouts.app')

@section('title', 'Dashboard Dokter')
@section('subtitle', 'Obat')

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
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Obat</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Obat</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Success Message -->
        @if (session('success'))
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-check"></i> Success!</h5>
            {{ session('success') }}
          </div>
        @endif

        <div class="row">
          <div class="col-md-12">
            <!-- Form Tambah Obat -->
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
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Daftar Obat</h3>
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Obat</th>
                      <th>Kemasan</th>
                      <th>Harga</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($obats->count() > 0)
                      @foreach ($obats as $obat)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $obat->nama_obat }}</td>
                          <td>{{ $obat->kemasan }}</td>
                          <td>{{ $obat->harga }}</td>
                          <td>
                            <a href="{{ route('obat.edit', $obat->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('obat.destroy', $obat->id) }}" method="POST" style="display:inline;">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus obat ini?')">Delete</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    @else
                      <tr>
                        <td colspan="5" class="text-center">Tidak ada data obat.</td>
                      </tr>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
@endsection