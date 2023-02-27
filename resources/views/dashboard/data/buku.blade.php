@extends('dashboard.layouts.main')
@section('title', 'Data Buku')

@section('head')
        <link rel="stylesheet" href="{{ asset('assets/extensions/choices.js/public/assets/styles/choices.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/extensions/filepond/filepond.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/extensions/filepond-plugin-image-preview/filepond-plugin-image-preview.css') }}">
@endsection

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Buku</h3>
                <p class="text-subtitle text-muted">Sebuah halaman untuk mengelola data buku.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Data</li>
                        <li class="breadcrumb-item active" aria-current="page">Buku</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="row">
        <div class="card">
            <div class="card-body">
                <a href="{{ route('dashboard.data.buku.create') }}" class="btn btn-primary mb-3">Tambah Buku</a>
                <div class="col-12">
                    <table class="table table-responsive-md table-hover" id="table">
                        <thead class="bg-primary text-white">
                            <tr>
                                <td>No</td>
                                <td>Cover</td>
                                <td>Judul Buku</td>
                                <td>Kategori</td>
                                <td>Tahun Terbit</td>
                                <td>ISBN</td>
                                <td>Aksi</td>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i = 1 @endphp
                            @if(!$bukus->isEmpty())
                                @foreach ($bukus as $buku)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td><img src="{{ asset('storage') . '/' . $buku->cover_buku }}" class="img-fluid" width="50"></td>
                                        <td>{{ $buku->judul_buku }}</td>
                                        <td>{{ $buku->kategori->nama_kategori }}</td>
                                        <td>{{ $buku->tahun_terbit }}</td>
                                        <td>{{ $buku->isbn }}</td>
                                        <td>
                                            <a class="badge bg-primary btnEdit mx-1" data-id="{{ $buku->id_buku }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                                <i class="fas fa-edit text-white"></i> Edit
                                            </a>
                                            <a href="{{ route('dashboard.data.kategori_buku.delete', $buku->id_buku) }}" class="badge bg-danger mx-1">
                                                <i class="fas fa-trash text-white"></i> Hapus
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr><td colspan="7" style="text-align: center;">Belum ada data</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="editModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Edit Data Buku</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="data" class="row">
                        <div class="col-md-4">
                            <img id="img-cover_buku" class="img-fluid" width="100%">
                        </div>
                        <div class="col-md-8">
                            <form method="post" action="{{ route('dashboard.data.buku.doCreate') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col">
                                        <label for="judul_buku">Judul Buku</label>
                                        <input type="text" class="form-control" name="judul_buku" id="judul_buku">
                                    </div>
                                    <div class="col">
                                        <label for="tahun_terbit">Tahun Terbit</label>
                                        <input type="text" class="form-control" name="tahun_terbit" id="tahun_terbit">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="kategori_id">Kategori</label>
                                        <select class="choices form-select" id="kategori_id" name="kategori_id">
                                            <option selected>- KATEGORI -</option>
                                            @foreach ($kategoris as $kategori)
                                                <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                                            @endforeach
                                        </select>                 
                                    </div>
                                    <div class="col">
                                        <label for="penerbit_id">Nama Penerbit</label>
                                        <select class="choices form-select" id="penerbit_id" name="penerbit_id">
                                            <option selected>- PENERBIT -</option>
                                            @foreach ($penerbits as $penerbit)
                                            <option value="{{ $penerbit->id_penerbit }}">{{ $penerbit->nama_penerbit }}</option>
                                            @endforeach
                                        </select>                
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="isbn">ISBN</label>
                                    <input type="text" class="form-control" id="isbn" name="isbn">            
                                </div>
                                <div class="form-group mt-2">
                                    <label for="cover_buku">Cover Buku</label>
                                    <input class="form-control @error('cover_buku') is-invalid @enderror" type="file" id="cover_buku" name="cover_buku">
                                    <!-- <div class="custom-file">
                                        <input type="file" class="custom-file-input @error('cover_buku') is-invalid @enderror" id="cover_buku" name="cover_buku">
                                        <label class="custom-file-label" for="cover_buku">Pilih Cover</label>
                                    </div> -->      
                                </div>
                                <div class="row mt-2">
                                    <div class="col">
                                        <label for="jumlah_buku_baik">Jumlah Buku Baik</label>
                                        <input type="number" class="form-control" id="jumlah_buku_baik" name="jumlah_buku_baik">                                
                                    </div>
                                    <div class="col">
                                        <label for="jumlah_buku_rusak">Jumlah Buku Rusak</label>
                                        <input type="number" class="form-control" id="jumlah_buku_rusak" name="jumlah_buku_rusak">                         
                                        @error('jumlah_buku_rusak')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror    
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center" id="loading">
                            <h3>Loading....</h3>
                        </div>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1"
                        data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </form>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</div>
@endsection

@section('js')
    <script src="{{ asset('assets/extensions/choices.js/public/assets/scripts/choices.js') }}"></script>
    <script src="{{ asset('assets/js/pages/form-element-select.js') }}"></script>
    <script src="{{ asset('assets/extensions/filepond/filepond.js') }}"></script>

    <script>
        $('#loading').hide();
        $('.btnEdit').on("click", function() {
            var user_id = $(this).data('id');
            $('#loading').show();
            $('#data').hide();
            $.ajax({
                url: "{{ route('dashboard.data.buku.get') }}",
                data: {
                    id: user_id
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    $('#loading').hide();
                    $('#data').show();  
                    $('#img-cover_buku').attr('src', "{{ asset('storage') }}" + '/' + res.cover_buku)
                    $('#judul_buku').val(res.judul_buku)
                    $('#tahun_terbit').val(res.tahun_terbit)
                    $('#isbn').val(res.isbn)
                    $('#jumlah_buku_baik').val(res.jumlah_buku_baik)
                    $('#jumlah_buku_rusak').val(res.jumlah_buku_rusak)
                    $('#idModal').val(user_id)
                },
            })
        })
    </script>
@endsection