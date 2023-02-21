@extends('dashboard._layout')
@section('title', 'Data Kategori Buku')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <table class="table table-responsive-md table-striped table-hover">
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
                    @foreach ($kategori_bukus as $kategori)
                        <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $kategori->kode_kategori }}</td>
                                <td>{{ $kategori->nama_kategori }}</td>
                                <td class="d-flex">
                                    {{-- <a class="badge badge-primary btnInfo mx-1" data-id="{{ $user->id_user }}" data-toggle="modal" data-target="#infoModal">
                                        <i class="fas fa-edit text-white"></i> Edit
                                    </a>
                                    <a href="{{ route('dashboard.data.anggota.delete', $user->id_user) }}" class="badge badge-danger mx-1">
                                        <i class="fas fa-trash text-white"></i> Hapus
                                    </a> --}}
                                </td>
                        </tr>
                    @endforeach
                    {{-- @if(!$kategori_bukus->empty())
                    @else
                        <tr><td colspan="7" style="text-align: center;">Belum ada data</td></tr>
                    @endif --}}
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.data.kategori_buku.create') }}" method="post">
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
    </div>

    <!-- Modal -->
    <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="infoModalLabel">Profil Anggota</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    <div class="form">
                        @csrf
                        <input type="hidden" name="id" id="idModal">
                        <div class="form-group">
                            <label for="fullname">Full Name</label>
                            <input type="text" class="form-control" name="fullname" id="fullnameModal">
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="usernameModal">
                        </div>
                    </div>
                    <div class="loading text-center">
                        <h3>Loading....</h3>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div> 
    </div>
@endsection

@section('js')
    <script>
        $('.loading').hide();
        $('.btnInfo').on("click", function() {
            var user_id = $(this).data('id');
            $('.loading').show();
            $('.form').hide();
            $.ajax({
                url: "{{ route('dashboard.data.anggota.get') }}",
                data: {
                    id: user_id
                },
                success: function(response) {
                    var res = JSON.parse(response);
                    $('.loading').hide();
                    $('.form').show();
                    $('#fullnameModal').val(res.fullname)
                    $('#usernameModal').val(res.username)
                    $('#idModal').val(user_id)
                },
            })
        })
    </script>
@endsection