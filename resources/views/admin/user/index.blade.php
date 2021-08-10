@extends('layouts.app')

@section('section-title', 'User Master')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.user.filter') }}" method="post">
                        @csrf
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-3">
                                <input type="text" name="name" class="form-control" value="{{ $input['name'] }}"
                                    placeholder="Nama">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="email" class="form-control form-control"
                                    value="{{ $input['email'] }}" placeholder="E-mail">
                            </div>
                            <div class="col-md-3">
                                <select name="role" class="form-control text-capitalize">
                                    <option value="">Pilih</option>
                                    @foreach (getEnum('users', 'role') as $role)
                                    @if ($role != 'siswa')
                                    <option value="{{ $role }}" @if($input['role']==$role) selected @endif>{{ $role }}
                                    </option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.user.create') }}" class="btn btn-primary float-right">Tambah user</a>
                    <div class="table-responsive pt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>E-mail</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration + $users->firstItem() - 1  }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td><span
                                            class="badge badge-{{ colorRole($user->role) }} text-capitalize">{{ $user->role }}</span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.user.edit', $user->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ route('admin.user.destroy', $user->id) }}" method="post"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="btn btn-danger btn-sm"><i
                                                    class="fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak Ada Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <p>Total data : {{ $users->total() }}</p>
                        {!! $users->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
