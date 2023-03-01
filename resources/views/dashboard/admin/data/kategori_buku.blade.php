@extends('dashboard.layouts.main')
@section('title', 'Data Buku')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Kategori</h3>
                <p class="text-subtitle text-muted">Sebuah halaman untuk mengelola data kategori buku.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Data</li>
                        <li class="breadcrumb-item">Buku</li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="col-12">
                        <table class="table table-responsive-md table-hover" id="table">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <td>No</td>
                                    <td>Kode Kategori</td>
                                    <td>Nama Kategori</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                            @php $i = 1 @endphp
                            @if(!$kategori_bukus->isEmpty())
                                @foreach ($kategori_bukus as $kategori)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $kategori->kode_kategori }}</td>
                                        <td>{{ $kategori->nama_kategori }}</td>
                                        <td class="d-flex">
                                            <a class="badge bg-primary btnEdit mx-1" data-id="{{ $kategori->id_kategori }}" data-bs-toggle="modal" data-bs-target="#editKategoriModal">
                                                <i class="fas fa-edit text-white"></i> Edit
                                            </a>
                                            <a href="{{ route('dashboard.admin.data.kategori_buku.delete', $kategori->id_kategori) }}" class="badge bg-danger mx-1">
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
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.admin.data.kategori_buku.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="kode_kategori">Kode Kategori</label>
                            <input type="text" class="form-control" name="kode_kategori" id="kode_kategori" value="{{ $kode_kategori }}" readonly>
                            <small class="text-muted">* Kode Kategori Buku dibuat secara otomatis</small>
                        </div>
                        <div class="form-group">
                            <label for="nama_kategori">Nama Kategori</label>
                            <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" name="nama_kategori" id="nama_kategori" value="{{ old('nama_kategori') }}">
                            @error('nama_kategori')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="editKategoriModal" tabindex="-1" role="dialog" aria-labelledby="editKategoriModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editKategoriModalTitle">Edit Kategori Buku
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                <form action="{{ route('dashboard.admin.data.kategori_buku.edit') }}" method="post">
                    @method('PUT')
                    <div class="form">
                        @csrf
                        <input type="hidden" name="id" id="idModal">
                        <div class="form-group">
                            <label for="kodeKategori">Kode Kategori</label>
                            <input type="text" class="form-control" name="kodeKategori" id="kodeKategoriModal" readonly>
                            <small>* Kode kategori tidak perlu diubah</small>
                        </div>
                        <div class="form-group">
                            <label for="namaKategori">Nama Kategori</label>
                            <input type="text" class="form-control" name="namaKategori" id="namaKategoriModal">
                        </div>
                    </div>
                    <div class="loading text-center">
                        <h3>Loading....</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light-secondary"
                        data-bs-dismiss="modal">
                        <i class="bx bx-x d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Close</span>
                    </button>
                    <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $('.loading').hide();
        $('.btnEdit').on("click", function() {
            var id = $(this).data('id');
            $('.loading').show();
            $('.form').hide();
            $.ajax({
                url: "{{ route('dashboard.admin.data.kategori_buku.get') }}",
                data: {
                    id
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    $('.loading').hide();
                    $('.form').show();
                    $('#kodeKategoriModal').val(res.kode_kategori)
                    $('#namaKategoriModal').val(res.nama_kategori)
                    $('#idModal').val(id)
                },
            })
        })
    </script>
@endsection