@extends('layouts.app')

@section('title','Dashboard Pasien')

@section('sidebar')
  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <li class="nav-item">
      <a href="/pasien" class="nav-link {{ request()->is('pasien') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="/pasien/periksa" class="nav-link {{ request()->is('pasien/periksa*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Periksa</p>
      </a>
    </li>
  </ul>
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Home Pasien</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/">Home</a></li>
              <li class="breadcrumb-item active">Dashboard Pasien</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
@endsection