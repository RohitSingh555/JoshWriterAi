<div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('admin') }}/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
</div>

<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="/" target="_block">
                <i class="fas fa-globe"></i>
            </a>

        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('clearcache') }}" style="    background: red;
            color: white;
            font-weight: 700;
            border-radius: 5px;">
                Clear Cache
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
