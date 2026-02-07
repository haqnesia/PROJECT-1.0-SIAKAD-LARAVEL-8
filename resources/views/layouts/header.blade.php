<div class="container">
    <a class="navbar-brand font-weight-bold" href="#">
        <i class="bi bi-mortarboard-fill"></i> Universitas Semen Padang
    </a>

    <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item">
            <a class="nav-link active" href="{{ route('home') }}">
                <i class="bi bi-house-door"></i> Home
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('fakultas.index') }}">
                <i class="bi bi-building"></i> Fakultas
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('prodi.index') }}">
                <i class="bi bi-journal-bookmark"></i> Program Studi
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('mahasiswa.index') }}">
                <i class="bi bi-people"></i> Mahasiswa
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-danger" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

        </li>
    </ul>
</div>
