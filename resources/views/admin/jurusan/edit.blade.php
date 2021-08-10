@extends('layouts.app')

@section('section-title', 'Ubah Jurusan Master')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.jurusan.index') }}" class="btn btn-warning float-right">Kembali</a>
                    <form action="{{ route('admin.jurusan.update', $major->id) }}" method="post" class="mt-5">
                        @method('patch')
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @endif" value="{{ $major->name }}"
                                required>
                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary float-right">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
