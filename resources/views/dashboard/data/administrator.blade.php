
@extends('dashboard.layouts.main')
@section('title', 'Data Anggota')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Data Administrator</h3>
                <p class="text-subtitle text-muted">Sebuah halaman untuk mengelola data administrator perpustakaan.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item">Data</li>
                        <li class="breadcrumb-item active" aria-current="page">Administrator</li>
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
                        <table class="table table-responsive table-hover" id="table">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <td>No</td>
                                    <td>Kode User</td>
                                    <td>Full Name</td>
                                    <td>Username</td>
                                    <td>Terakhir Login</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1 @endphp
                                @foreach ($administrators as $administrator)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $administrator->kode_user }}</td>
                                    <td>{{ (!$administrator->fullname) ? '-':Str::limit($administrator->fullname, 19) }}</td>
                                    <td>{{ (!$administrator->username) ? '-':Str::limit($administrator->username, 19) }}</td>
                                    <td>{{ (!$administrator->terakhir_login) ? '-':Str::limit($administrator->terakhir_login, 19) }}</td>
                                    <td class="d-flex">
                                        <a href="{{ route('dashboard.data.administrator.delete', $administrator->id_user) }}" class="btn btn-danger btn-block mx-1">
                                            <i class="bi bi-trash"></i>
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
                    <form action="{{ route('dashboard.data.administrator.create') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror" name="fullname" id="fullname" value="{{ old('fullname') }}">
                            @error('fullname')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username') }}">
                            @error('username')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!--Extra Large Modal -->
    <div class="modal fade text-left w-100" id="infoModal" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel16" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
            role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel16">Detail user</h4>
                    <button type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered" id="table-info">
                        <tr>
                            <th>Kode User</th>
                            <td id="modal_kode_user"></td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td id="modal_nama_lengkap"></td>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <td id="modal_username"></td>
                        </tr>
                        <tr>
                            <th>NIS</th>
                            <td id="modal_nis"></td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td id="modal_kelas"></td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td id="modal_alamat"></td>
                        </tr>
                        <tr>
                            <th>Terakhir Login</th>
                            <td id="modal_last_login"></td>
                        </tr>
                    </table>
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
                    <button type="button" class="btn btn-primary ml-1"
                        data-bs-dismiss="modal">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        <span class="d-none d-sm-block">Accept</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</div>
@endsection

@section('js')
<script>
        $('#loading').hide();
        $('.btnInfo').on("click", function() {
            var user_id = $(this).data('id');
            $('#loading').show();
            $('#table-info').hide();
            $.ajax({
                url: "{{ route('dashboard.data.anggota.get') }}",
                data: {
                    id: user_id
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    console.log(res);
                    $('#loading').hide();
                    $('#table-info').show();
                    $('#modal_kode_user').html(res.kode_user)
                    $('#modal_nama_lengkap').html(res.fullname)
                    $('#modal_username').html(res.username)
                    $('#modal_kelas').html((res.kelas) ? res.kelas:'<small class="text-muted">Belum diupdate</small')
                    $('#modal_alamat').html((res.alamat) ? res.alamat:'<small class="text-muted">Belum diupdate</small')
                    $('#modal_nis').html((res.nis) ? res.nis:'<small class="text-muted">Belum diupdate</small')
                    $('#modal_last_login').html((res.terakhir_login) ? res.terakhir_login:'<small class="text-muted">Belum diupdate</small')
                    $('#idModal').val(user_id)
                },
            })
        })
    </script>
@endsection