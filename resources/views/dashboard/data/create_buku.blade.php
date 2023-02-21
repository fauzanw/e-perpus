@extends('dashboard._layout')
@section('title', 'Tambah Buku')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <a href="{{ route('dashboard.data.buku') }}" class="btn btn-primary">Kembali</a>
            <div class="card mt-2">
                <div class="card-body">
                    <form method="post" action="{{ route('dashboard.data.buku.doCreate') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="judul_buku">Judul Buku</label>
                                <input type="text" class="form-control @error('judul_buku') is-invalid @enderror" name="judul_buku" id="judul_buku" value="{{ old('judul_buku') }}">
                                @error('judul_buku')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="col">
                                <label for="tahun_terbit">Tahun Terbit</label>
                                <input type="text" class="form-control @error('tahun_terbit') is-invalid @enderror" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit') }}">
                                @error('tahun_terbit')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="kategori_id">Kategori</label>
                                <select class="custom-select @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
                                    <option selected>--- PILIH KATEGORI ---</option>
                                    @foreach ($kategoris as $kategori)
                                        <option @if (old('kategori_id') == $kategori->id_kategori) {{ 'selected' }} @endif value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                    @endforeach
                                </select>                 
                                @error('kategori_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror               
                            </div>
                            <div class="col">
                                <label for="penerbit_id">Nama Penerbit</label>
                                <select class="custom-select @error('penerbit_id') is-invalid @enderror" id="penerbit_id" name="penerbit_id">
                                    <option selected>--- PILIH PENERBIT ---</option>
                                    @foreach ($penerbits as $penerbit)
                                    <option @if (old('penerbit_id') == $penerbit->id_penerbit) {{ 'selected' }} @endif value="{{ $penerbit->id_penerbit }}">{{ $penerbit->nama_penerbit }}</option>
                                    @endforeach
                                </select>                                
                                @error('penerbit_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror               
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="isbn">ISBN</label>
                            <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ old('isbn') }}">
                            @error('isbn')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror               
                        </div>
                        <div class="form-group mt-2">
                            <label for="cover_buku">Cover Buku</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('cover_buku') is-invalid @enderror" id="cover_buku" name="cover_buku">
                                <label class="custom-file-label" for="cover_buku">Pilih Cover</label>
                            </div>
                            @error('cover_buku')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror               
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label for="jumlah_buku_baik">Jumlah Buku Baik</label>
                                <input type="number" class="form-control @error('jumlah_buku_baik') is-invalid @enderror" id="jumlah_buku_baik" name="jumlah_buku_baik" value="{{ old('jumlah_buku_baik') }}">                             
                                @error('jumlah_buku_baik')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror    
                            </div>
                            <div class="col">
                                <label for="jumlah_buku_rusak">Jumlah Buku Rusak</label>
                                <input type="number" class="form-control @error('jumlah_buku_rusak') is-invalid @enderror" id="jumlah_buku_rusak" name="jumlah_buku_rusak" value="{{ old('jumlah_buku_rusak') }}">                         
                                @error('jumlah_buku_rusak')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror    
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-2">Tambah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection