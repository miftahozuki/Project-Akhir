<!DOCTYPE html>
<html>
<head>
    <title>Hi</title>
    <link rel="stylesheet" href="{{ asset('modules/bootstrap/css/bootstrap.min.css') }}">
</head>
<body>
    <table align="center" style="border-bottom: 2px solid black;">
        <tr>
            <td><img src="{{ asset('img/logo.png') }}" width="70"></td>
            <td>
                <center>
                    <font size="4">KABUPATEN JEMBER</font><br>
                    <font size="5"><b>POLITEKNIK NEGERI JEMBER</b></font><br>
                    <font size="3"><i>Jl. Mastrip No.164, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121</i></font>
                </center>
            </td>
        </tr>
    </table>
    <p>Laporan tahun : {{ $date }}.</p>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>002328356</td>
            </tr>
        </tbody>
    </table>

      <script src="{{ asset('modules/jquery.min.js') }}"></script>
  <script src="{{ asset('modules/popper.js') }}"></script>
</body>
</html>