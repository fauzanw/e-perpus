@extends('dashboard.layouts.main')
@section('title', 'Data Buku')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Penerbit</h3>
                <p class="text-subtitle text-muted">Sebuah halaman untuk mengelola data penerbit buku.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Data</li>
                        <li class="breadcrumb-item">Buku</li>
                        <li class="breadcrumb-item active" aria-current="page">Penerbit</li>
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
                                    <td>Kode</td>
                                    <td>Nama</td>
                                    <td>Status Verifikasi</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                            @php $i = 1 @endphp
                            @foreach ($penerbits as $penerbit)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $penerbit->kode_penerbit }}</td>
                                    <td>{{ $penerbit->nama_penerbit }}</td>
                                    <td>
                                        @if($penerbit->verif_penerbit == 'verified')
                                            <div class="form-check">
                                                <input type="checkbox" checked class="form-check-input" onclick="return false;" readonly>
                                                <label class="form-check-label" for="flexCheckIndeterminate">
                                                    Telah diverifikasi
                                                </label>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" onclick="verifPenerbit({{ $penerbit->id_penerbit }})">
                                                <label class="form-check-label" for="flexCheckIndeterminate">
                                                    Belum diverifikasi  
                                                </label>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="d-flex">
                                        <a class="badge bg-primary btnEdit mx-1" data-id="{{ $penerbit->id_penerbit }}" data-bs-toggle="modal" data-bs-target="#editModal">
                                            Edit
                                        </a>
                                        <a href="{{ route('dashboard.data.penerbit.delete', $penerbit->id_penerbit) }}" class="badge bg-danger">
                                            Hapus
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.data.penerbit.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="kode_penerbit">Kode Penerbit</label>
                            <input type="text" class="form-control" name="kode_penerbit" id="kode_penerbit" value="{{ $kode_penerbit }}" readonly>
                            <small class="text-muted">* Kode Kategori Buku dibuat secara otomatis</small>
                        </div>
                        <div class="form-group">
                            <label for="nama_penerbit">Nama Penerbit</label>
                            <input type="text" class="form-control @error('nama_penerbit') is-invalid @enderror" name="nama_penerbit" id="nama_penerbit" value="{{ old('nama_penerbit') }}">
                            @error('nama_penerbit')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalTitle">Edit Data Penerbit
                    </h5>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('dashboard.data.penerbit.edit') }}" method="post">
                        @method('PUT')
                        <div class="form">
                            @csrf
                            <input type="hidden" name="id" id="idModal">
                            <div class="form-group">
                                <label for="kode_penerbit">Kode Penerbit</label>
                                <input type="text" class="form-control" name="kode_penerbit" id="kode_penerbitModal" readonly>
                            </div>
                            <div class="form-group">
                                <label for="nama_penerbit">Nama Penerbit</label>
                                <input type="text" class="form-control" name="nama_penerbit" id="nama_penerbitModal">
                            </div>
                            <div class="form-check unverified">
                                <input type="checkbox" id="verif" name="verif_penerbit" class="form-check-input" disabled>
                                <label class="form-check-label" for="verif">
                                    Belum diverifikasi
                                </label>
                            </div>
                            <div class="form-check verified">
                                <input type="checkbox" id="verified" name="verif_penerbit" class="form-check-input" checked disabled>
                                <label class="form-check-label" for="verified">
                                    Terverifikasi
                                </label>
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
        function verifPenerbit(id) {
            window.location.href = "{{ route('dashboard.data.penerbit.verify') }}?id=" + id;
        }

        $('.loading').hide();
        $('.btnEdit').on("click", function() {
            var penerbit_id = $(this).data('id');
            $('.loading').show();
            $('.form').hide();
            $.ajax({
                url: "{{ route('dashboard.data.penerbit.get') }}",
                data: {
                    id: penerbit_id
                },
                success: function(response) {
                    console.log(penerbit_id)
                    var res = JSON.parse(response);
                    $('.loading').hide();
                    $('.form').show();
                    if(res.verif_penerbit == 'verified') {
                        $('.unverified').hide();
                        $('.verified').show()
                    }else {
                        $('.verified').hide()
                        $('.unverified').show()
                    }
                    $('#kode_penerbitModal').val(res.kode_penerbit)
                    $('#nama_penerbitModal').val(res.nama_penerbit)
                    $('#kode_penerbit')
                    $('#idModal').val(res.id_penerbit)
                },
            })
        })
    </script>
@endsection