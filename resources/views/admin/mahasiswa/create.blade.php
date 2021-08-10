@extends('layouts.app')

@section('section-title', 'Tambah Mahasiswa Master')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.mahasiswa.index') }}" class="btn btn-warning float-right">Kembali</a>
                    <form action="{{ route('admin.mahasiswa.store') }}" method="post" class="mt-5">
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
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input type="email" name="email" id="email"
                                        class="form-control @error('email') is-invalid @endif"
                                        value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="phone">Nomor HP</label>
                                    <input type="number" name="phone" id="phone"
                                        class="form-control @error('phone') is-invalid @endif" min="62"
                                        value="{{ old('phone') ?? '62'}}" required>
                                    @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="grade">Prodi</label>
                            <select name="grade" id="grade" class="form-control @error('grade') is-invalid @endif">
                                <option value="">Pilih</option>
                                @foreach ($grades as $grade)
                                <option value="{{ $grade->id }}" @if($grade->id == old('grade'))
                                   selected @endif>{{ $grade->name . ' | ' . $grade->major->name }}</option>
                                @endforeach
                            </select>
                            @error('grade')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="nim">NIM</label>
                                    <input type="text" name="nim" id="nim"
                                        class="form-control @error('nim') is-invalid @endif" value="{{ old('nim') }}"
                                        required>
                                    @error('nim')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="tahun_masuk">Tahun Angkatan</label>
                                    <input type="text" name="tahun_masuk" id="tahun_masuk"
                                        class="form-control @error('tahun_masuk') is-invalid @endif" value="{{ old('tahun_masuk') }}"
                                        required>
                                    @error('tahun_masuk')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat</label>
                            <textarea name="address" id="address"
                                class="form-control @error('address') is-invalid @endif"></textarea>
                            @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm">
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
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="password_confirmation">Konfirmasi password</label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary float-right">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
