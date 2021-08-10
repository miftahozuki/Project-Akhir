<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 34px"> UKT POLIJE</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}"><img src="{{ asset('img/logo.png') }}" alt="Logo" style="width: 24px"></a>
        </div>
        <?php $routeName = \Request::route()->getName();$role = Auth::user()->role; ?>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown {{ ($routeName == 'home') ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-home"></i><span>Home</span></a>
            </li>
            <li class="menu-header">Transaksi</li>
            @if($role == 'admin' || $role == 'petugas')
            <li class="dropdown {{ ($routeName == 'payment.index') ? 'active' : '' }}">
                <a href="{{ route('payment.index') }}" class="nav-link"><i class="fas fa-money-bill"></i><span>Pembayaran</span></a>
            </li>
            @endif
            <li class="dropdown {{ ($routeName == 'history.index') ? 'active' : '' }}">
                <a href="{{ route('history.index') }}" class="nav-link"><i class="fas fa-receipt"></i><span>Riwayat</span></a>
            </li>
            @if($role == 'admin')
                <li class="menu-header">Admin</li>
                <li class="dropdown {{ ($routeName == 'admin.user.index' || $routeName == 'admin.user.edit' || $routeName == 'admin.user.create' || $routeName == 'admin.user.filter') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.index') }}" class="nav-link"><i class="fas fa-users"></i><span>User Database</span></a>
                </li>
                <li class="dropdown {{ ($routeName == 'admin.jurusan.index' || $routeName == 'admin.jurusan.edit' || $routeName == 'admin.jurusan.create' || $routeName == 'admin.jurusan.filter') ? 'active' : '' }}">
                    <a href="{{ route('admin.jurusan.index') }}" class="nav-link"><i class="fas fa-school"></i><span>Jurusan Database</span></a>
                </li>
                <li class="dropdown {{ ($routeName == 'admin.kelas.index' || $routeName == 'admin.kelas.edit' || $routeName == 'admin.kelas.create' || $routeName == 'admin.kelas.filter') ? 'active' : '' }}">
                    <a href="{{ route('admin.kelas.index') }}" class="nav-link"><i class="fas fa-school"></i><span>Prodi Database</span></a>
                </li>
                <li class="dropdown {{ ($routeName == 'admin.mahasiswa.index' || $routeName == 'admin.mahasiswa.edit' || $routeName == 'admin.mahasiswa.create' || $routeName == 'admin.mahasiswa.filter') ? 'active' : '' }}">
                    <a href="{{ route('admin.mahasiswa.index') }}" class="nav-link"><i class="fas fa-user"></i><span>Mahasiswa Database</span></a>
                </li>
                <li class="dropdown {{ ($routeName == 'admin.ukt.index' || $routeName == 'admin.ukt.edit' || $routeName == 'admin.ukt.create' || $routeName == 'admin.ukt.filter') ? 'active' : '' }}">
                    <a href="{{ route('admin.ukt.index') }}" class="nav-link"><i class="fas fa-receipt"></i><span>UKT Database</span></a>
                </li>
            @endif
        </ul>
    </aside>
</div>
