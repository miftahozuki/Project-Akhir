@extends('layouts.app')

@section('section-title', 'Detail Mahasiswa')

@section('content')
<div class="section-body">
    <div class="row d-flex justify-content-center mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                    <img alt="image" src="{{ asset('img/avatar/default.png') }}"
                        class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">NIM / Tahun Angkatan</div>
                            <div class="profile-widget-item-value">
                                {{ $student->detail->nim . ' / ' . $student->detail->tahun_masuk }}</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Prodi / Jurusan</div>
                            <div class="profile-widget-item-value">
                                {{ $student->detail->grade->name . ' / ' . $student->detail->grade->major->name }}</div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" value="{{ $student->name }}" disabled>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-7 col-12">
                            <label>E-mail</label>
                            <input type="email" class="form-control" value="{{ $student->email }}" disabled>
                        </div>
                        <div class="form-group col-md-5 col-12">
                            <label>Nomor HP</label>
                            <input type="tel" class="form-control" value="{{ $student->detail->phone }}" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label>Alamat</label>
                            <textarea
                                class="form-control summernote-simple" disabled>{{ $student->detail->address }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
