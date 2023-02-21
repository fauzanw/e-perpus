@extends('dashboard._layout')
@section('title', 'Data Buku')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('dashboard.data.buku.create') }}" class="btn btn-primary mb-2">Tambah Buku</a>
            <table class="table table-responsive-md table-striped table-hover">
                <thead class="bg-primary text-white">
                    <tr>
                        <td>No</td>
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
                                    <td>{{ $buku->judul_buku }}</td>
                                    <td>{{ $buku->kategori->nama_kategori }}</td>
                                    <td>{{ $buku->tahun_terbit }}</td>
                                    <td>{{ $buku->isbn }}</td>
                                    <td class="d-flex">
                                        <a class="badge badge-primary btnEdit mx-1" data-id="{{ $buku->id_buku }}" data-toggle="modal" data-target="#editKategoriModal">
                                            <i class="fas fa-edit text-white"></i> Edit
                                        </a>
                                        <a href="{{ route('dashboard.data.kategori_buku.delete', $buku->id_buku) }}" class="badge badge-danger mx-1">
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

    <!-- Modal -->
    <div class="modal fade" id="editKategoriModal" tabindex="-1" aria-labelledby="editKategoriModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="editKategoriModalLabel">Edit Kategori</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('dashboard.data.kategori_buku.edit') }}" method="post">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
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
                url: "{{ route('dashboard.data.kategori_buku.get') }}",
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