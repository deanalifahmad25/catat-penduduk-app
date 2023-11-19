<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- Container wrapper -->
    <div class="container-fluid">
        <!-- Toggle button -->
        <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarCenteredExample"
            aria-controls="navbarCenteredExample" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Collapsible wrapper -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarCenteredExample">
            <!-- Left links -->
            <ul class="navbar-nav mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('penduduk')}}">Home</a>
                </li>
                <!-- Navbar dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-mdb-toggle="dropdown" aria-expanded="false">
                        Jumlah Penduduk
                    </a>
                    <!-- Dropdown menu -->
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('report.penduduk.province') }}">Provinsi</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{ route('report.penduduk.district') }}">Kabupaten</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Left links -->
        </div>
        <!-- Collapsible wrapper -->
    </div>
    <!-- Container wrapper -->
</nav>