@extends('dashboard._layout')
@section('title', 'Data Administrator')

@section('content')
    <div class="row">
        <div class="col-md-8">
            <table class="table table-responsive table-striped table-hover">
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
                    @if(!$administrators->isEmpty()) 
                    @foreach ($administrators as $administrator)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $administrator->kode_user }}</td>
                            <td>{{ (!$administrator->fullname) ? '-':Str::limit($administrator->fullname, 19) }}</td>
                            <td>{{ (!$administrator->username) ? '-':Str::limit($administrator->username, 19) }}</td>
                            <td>{{ (!$administrator->terakhir_login) ? '-':Str::limit($administrator->terakhir_login, 19) }}</td>
                            <td class="d-flex">
                                <a href="{{ route('dashboard.data.administrator.delete', $administrator->id_user) }}" class="badge badge-danger mx-1">
                                    <i class="fas fa-trash text-white"></i> Hapus
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @else
                        <tr><td colspan="7">Belum ada data</td></tr>
                    @endif
                </tbody>
            </table>
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
    </div>

@endsection