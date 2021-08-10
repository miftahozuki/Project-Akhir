@extends('layouts.app')

@section('section-title', 'Tambah User Master')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.user.index') }}" class="btn btn-warning float-right">Kembali</a>
                    <form action="{{ route('admin.user.store') }}" method="post" class="mt-5">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @endif" value="{{ old('name') }}"
                                required>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">E-mail</label>
                            <input type="email" name="email" id="email"
                                class="form-control @error('email') is-invalid @endif" value="{{ old('email') }}"
                                required>
                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select name="role" id="role"
                                class="form-control @error('role') is-invalid @endif text-capitalize">
                                <option value="">Pilih</option>
                                @foreach (getEnum('users', 'role') as $role)
                                @if ($role != 'siswa')
                                <option value="{{ $role }}" @if(old('role')==$role) selected @endif>{{ $role }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"
                                class="form-control @error('password') is-invalid @endif" required>
                            @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                            <small class="form-text text-muted">
                                Password harus terdiri dari 8 karakter
                            </small>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Konfirmasi password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                                class="form-control" required>
                        </div>

                        <button class="btn btn-primary float-right">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
