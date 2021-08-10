@extends('layouts.app')

@section('section-title', 'Tambah Prodi Master')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.kelas.index') }}" class="btn btn-warning float-right">Kembali</a>
                    <form action="{{ route('admin.kelas.store') }}" method="post" class="mt-5">
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
                            <label for="major_id">Jurusan</label>
                            <select name="major_id" id="major_id" class="form-control @error('major_id') is-invalid @endif">
                                <option value="">Pilih</option>
                                @foreach ($majors as $major)
                                    <option value="{{ $major->id }}" @if(old('major_id') == $major->id) selected @endif>{{ $major->name }}</option>
                                @endforeach
                            </select>
                            @error('major_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary float-right">Tambahkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
