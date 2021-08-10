@extends('layouts.app')

@section('section-title', 'Mahasiswa Master')

@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.mahasiswa.filter') }}" method="post">
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
                    <a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary float-right">Tambah Mahasiswa</a>
                    <div class="table-responsive pt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th>E-mail</th>
                                    <th>Prodi</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($students as $student)
                                <tr>
                                    <td>{{ $loop->iteration + $students->firstItem() - 1  }}</td>
                                    <td>{{ $student->detail->nim }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->detail->grade->name . ' ' . $student->detail->grade->major->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.mahasiswa.show', $student->id) }}"
                                            class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                                        <a href="{{ route('admin.mahasiswa.edit', $student->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ route('admin.mahasiswa.destroy', $student->id) }}" method="post"
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
                        <p>Total data : {{ $students->total() }}</p>
                        {!! $students->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
