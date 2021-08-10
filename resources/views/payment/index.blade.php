@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('modules/izitoast/css/iziToast.min.css') }}">
@endsection

@section('section-title', 'Pembayaran')

@section('content')
<div class="section-body">
    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div id="student-info">
                    <div class="p-4">
                        <h4 class="text-center">Data Mahasiswa Akan Tampil Disini</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                        <h4>Pembayaran</h4>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" name="nim" id="nim" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="bill">UKT (Yang harus dibayar/Tahun)</label>
                                    <select name="bill" id="bill" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($bills as $bill)
                                        <option value="{{ $bill->id }}">{{ idr($bill->price) . ' | ' . $bill->years }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <select name="semester" id="semester" class="form-control">
                                        <option value="">Pilih</option>
                                        @foreach ($semesters as $semester)
                                        <option value="{{ $semester->id }}">{{ $semester->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="haspay">Total Bayar</label>
                                    <input type="number" name="haspay" id="haspay" min="0" class="form-control">
                                </div>
                            </div>
                        <div class="card-footer text-right">
                            <button class="btn btn-danger">Bayar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="{{ asset('modules/izitoast/js/iziToast.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#nim').change(function () {
            var _token = $('input[name="_token"]').val();
            var nim = $(this).val();
            $.ajax({
                url: "{{ route('payment.search') }}",
                method: "POST",
                data: {
                    _token: _token,
                    nim: nim
                },
                success: function (result) {
                    iziToast.success({
                        title: 'Sukses',
                        message: 'Mahasiswa berhasil ditemukan',
                        position: 'topRight',
                    });

                    var student = result.student;
                    var image = "{{ asset('img/avatar/default.png') }}"
                    $('#student-info').html(`<div class="profile-widget-header mt-3">
                    <img alt="image" id="student-image" src="${image}" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">NIM / Tahun Masuk</div>
                            <div class="profile-widget-item-value">${student.nim} / ${student.tahun_masuk}</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Kelas / Jurusan</div>
                            <div class="profile-widget-item-value">${student.grade.name} / ${student.grade
                        .major.name}</div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <strong>Nama : </strong> ${student.user.name}<br><strong>E-mail : </strong> ${student.user.email}<br><strong>Nomor HP : </strong> ${student.phone}<br><strong>Alamat : </strong> ${student.address}
                </div>`);
                },
                error: function (result) {
                    $('#student-info').html(
                        '<div class="p-4"><h4 class="text-center">Data Mahasiswa Tidak Ditemukan</h4></div>'
                    )
                    iziToast.error({
                        title: 'Error',
                        message: 'Mahasiswa tidak ditemukan',
                        position: 'topRight',
                    });
                }
            })
        })
        $('#haspay').keyup(function () {
            let bill = $('#bill option:selected').text().split(" ")[1].replace(".", "")
            let changes = $(this).val() - bill

            $('#changes').val(changes < 0  ? 0 : changes)
        })
    })

</script>
@endsection
