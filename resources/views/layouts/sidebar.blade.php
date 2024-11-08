<!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bxl-sketch'></i>
            <div class="logo-name"><span>ANTAM </span>ID</div>
        </a>
        <ul class="side-menu">
            <li class="{{ ($active === "dashboard") ? 'active' : '' }}"><a href="{{ route('dashboard.home') }}"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            
            @canany(["sopir", "super"])
            <li class="{{ ($active === "booking") ? 'active' : '' }}"><a href="{{ route('dashboard.booking') }}"><i class='bx bxs-car-garage'></i>Booking</a></li>
            @endcan
            
            @can('super')
            <li class="{{ ($active === "users") ? 'active' : '' }}"><a href="{{ route('user.home') }}"><i class='bx bx-user'></i>Users</a></li>
            @endcan
            
            @can('super')
            <li class="{{ ($active === "role") ? 'active' : '' }}"><a href="{{ route('role.home') }}"><i class='bx bx-child'></i>Role</a></li>
            @endcan
            
            @canany(["admin", "super"])
            <li class="{{ ($active === "kendaraan") ? 'active' : '' }}"><a href="{{ route('kendaraan.home') }}"><i class='bx bx-car'></i>Kendaraan</a></li>
            @endcan
            
            @canany(["manager", "supervisor", "super"])
            <li class="{{ ($active === "pesanan") ? 'active' : '' }}"><a href="{{ route('pesanan.home') }}"><i class='bx bx-message-alt-edit'></i>Pesanan</a></li>
            @endcan
            
            @canany(["manager", "supervisor", "admin", "super"])
            <li class="{{ ($active === "riwayat") ? 'active' : '' }}"><a href="{{ route('riwayat.home') }}"><i class='bx bx-stopwatch'></i>Log Riwayat</a></li>
            @endcan
        </ul>
        <ul class="side-menu">
            <li>
                <form action="{{ route('auth.logout') }}" method="post">
                    @csrf
                    <button class="logout" onclick="confirm('Apakah Anda Yakin Akan Log Out ?')"><i class='bx bx-log-out-circle'></i> Logout</button>
                </form>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->