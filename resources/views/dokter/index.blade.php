@extends('layouts.app')

@section('title','Dashboard Dokter')

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
            <h1 class="m-0">Home Dokter</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Dokter</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection