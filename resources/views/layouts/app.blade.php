<!DOCTYPE html>
<html lang="en">

<head>
    @include('components.head')
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg bg-primary"></div>
            @include('components.topbar')
            @include('components.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>@yield('section-title')</h1>
                    </div>

                    @include('components.message')
                    @yield('content')
                </section>
            </div>
            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; 2021 <div class="bullet"></div><a href="https://www.polije.ac.id/"> Politeknik Negeri Jember</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    @include('components.script')
</body>

</html>
