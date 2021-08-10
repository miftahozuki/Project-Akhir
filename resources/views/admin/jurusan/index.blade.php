@extends('layouts.app')

@section('section-title', 'Jurusan Master')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.jurusan.filter') }}" method="post">
                        @csrf
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-3">
                                <input type="text" name="name" class="form-control" value="{{ $input['name'] }}"
                                    placeholder="Nama">
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
                    <a href="{{ route('admin.jurusan.create') }}" class="btn btn-primary float-right">Tambah jurusan</a>
                    <div class="table-responsive pt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($majors as $major)
                                <tr>
                                    <td>{{ $loop->iteration + $majors->firstItem() - 1  }}</td>
                                    <td>{{ $major->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.jurusan.edit', $major->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ route('admin.jurusan.destroy', $major->id) }}" method="post"
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
                        <p>Total data : {{ $majors->total() }}</p>
                        {!! $majors->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
