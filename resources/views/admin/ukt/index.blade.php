@extends('layouts.app')

@section('section-title', 'UKT Master')

@section('content')
<div class="section-body">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.ukt.create') }}" class="btn btn-primary float-right">Tambah UKT</a>
                    <div class="table-responsive pt-3">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Harga</th>
                                    <th>Tahun</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bills as $bill)
                                <tr>
                                    <td>{{ $loop->iteration + $bills->firstItem() - 1  }}</td>
                                    <td>{{ idr($bill->price) }}</td>
                                    <td>{{ $bill->years }}</td>
                                    <td>
                                        <a href="{{ route('admin.ukt.edit', $bill->id) }}"
                                            class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                        <form action="{{ route('admin.ukt.destroy', $bill->id) }}" method="post"
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
                        <p>Total data : {{ $bills->total() }}</p>
                        {!! $bills->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
