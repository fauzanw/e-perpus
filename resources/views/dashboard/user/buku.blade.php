@extends('dashboard.layouts.main')
@section('title', 'Buku')

@section('content')
    <div class="page-heading">
        <h3>Buku</h3>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('dashboard.user.buku.search') }}" method="post">
                    @csrf
                    <div class="form-group has-icon-left">
                        <label for="keyword">Kata Kunci</label>
                        <div class="position-relative">
                            <input type="text" class="form-control" placeholder="Tuliskan nama buku yang mau dicari..." id="keyword" name="keyword">
                            <div class="form-control-icon">
                                <i class="bi bi-search"></i>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary btn-block">Cari</button>
                </form>
            </div>
        </div>
        <section class="row mt-3">
            @foreach($bukus as $buku)
                <div class="col-md-3">
                    <div class="card">
                        <img src="{{ asset('storage') . '/' . $buku->cover_buku }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $buku->judul_buku }}</h5>
                            <p class="card-text text-muted">{{ $buku->penulis }}</p>
                        </div>
                        <div class="card-body">
                            <a href="#" class="card-link">Detail</a>
                            <a href="#" class="card-link">Pinjam</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </section>
    </div>
    <div class="page-content">
        </div>
@endsection