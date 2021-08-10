@extends('layouts.app')

@section('section-title', 'Riwayat')

@section('content')
<div class="section-body">
    <div class="row d-flex justify-content-center mt-sm-4">
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')<th>NIM</th>@endif
                                <th>UKT / Tahun</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($histories as $history)
                            <tr>
                                <td>{{ $loop->iteration + $histories->firstItem() - 1  }}</td>
                                @if (Auth::user()->role == 'admin' || Auth::user()->role == 'petugas')<td>{{ $history->detail->nim }}</td>@endif
                                <td>{{ idr($history->bill->price) }} / {{ $history->bill->years }}</td>
                                <td>{{ $history->semester->name }}</td>
                                <td><span class="btn btn-success btn-sm">LUNAS</span></td>
                                <td>{{ $history->created_at->format('d F, Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak Ada Data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <p>Total data : {{ $histories->total() }}</p>
                    {!! $histories->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
