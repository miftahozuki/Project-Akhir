@extends('layouts.app')

@section('section-title', 'Prodi Master')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.kelas.filter') }}" method="post">
                        @csrf
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-3">
                                <input type="text" name="name" class="form-control" value="{{ $input['name'] }}"
                                    placeholder="Nama">
                            </div>
                            <div class="col-md-3">
                                <input type="text" name="major" class="form-control" value="{{ $input['major'] }}"
                                    placeholder="Jurusan">
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
                    <a href="{{ route('admin.kelas.create') }}" class="btn btn-primary float-right">Tambah Prodi</a>
                    <div class="table-responsive pt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Jurusan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($grades as $grade)
                                <tr>
                                    <td>{{ $loop->iteration + $grades->firstItem() - 1  }}</td>
                                    <td>{{ $grade->name }}</td>
                                    <td>{{ $grade->major->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.kelas.edit', $grade->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ route('admin.kelas.destroy', $grade->id) }}" method="post"
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
                                    <td colspan="3" class="text-center">Tidak Ada Data</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <p>Total data : {{ $grades->total() }}</p>
                        {!! $grades->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
