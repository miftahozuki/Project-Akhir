@extends('layouts.auth')

@section('content')
<div class="card card-primary">
    <div class="card-header pb-0">
        <div class="col-lg p-0">
            <h4>Selamat datang</h4>
            <p class="mb-0" style="line-height: 130%;">Aku senang bertemu denganmu lagi. Anda dapat melanjutkan dari bagian terakhir yang Anda tinggalkan dengan masuk</p>
        </div>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group mb-2">
                <label for="email">E-mail</label>
                <input id="email" type="email" class="form-control @error('email') is-invalid @endif" name="email" tabindex="1" required autofocus>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="control-label">Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @endif" name="password" tabindex="2" required>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                    Masuk
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
