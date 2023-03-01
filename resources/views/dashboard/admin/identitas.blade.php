
@extends('dashboard.layouts.main')
@section('title', 'Data Identitas')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Identitas</h3>
                <p class="text-subtitle text-muted">Sebuah halaman untuk mengelola data identitas perpustakaan.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Data</li>
                        <li class="breadcrumb-item active" aria-current="page">Identitas</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="row">
        <div class="col-md-4">
            <div class="card" style="width: 18rem;">
                <img src="{{ asset('assets/images/logo/perpus-logo.jpg') }}" class="card-img-top img-fluid" width="50">
                <div class="card-body">
                    <h5 class="card-title">{{ $identitas->nama_app }}</h5>
                    <p class="card-text">{{ $identitas->alamat_hp }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="bi bi-envelope-fill"></i> {{ $identitas->email_hp }}</li>
                    <li class="list-group-item"><i class="bi bi-telephone-fill"></i> {{ $identitas->nomor_hp }}</li>
                </ul>
                <div class="card-footer">
                <small class="text-muted">Last Updated {{ $last_updated }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.admin.identitas.edit') }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="nama_app">Nama App</label>
                            <input type="text" class="form-control" name="nama_app" value="{{ $identitas->nama_app }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat App</label>
                            <textarea name="alamat_app" name="alamat_app" class="form-control">{{ $identitas->alamat_hp }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="email_app">Email App</label>
                            <input type="text" class="form-control" name="email_app" value="{{ $identitas->email_hp }}">
                        </div>
                        <div class="form-group">
                            <label for="no_app">No HP</label>
                            <input type="text" class="form-control" name="no_app" value="{{ $identitas->nomor_hp }}">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection