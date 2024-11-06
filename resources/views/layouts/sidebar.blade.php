<!-- Sidebar -->
    <div class="sidebar">
        <a href="#" class="logo">
            <i class='bx bxl-sketch'></i>
            <div class="logo-name"><span>ANTAM </span>ID</div>
        </a>
        <ul class="side-menu">
            <li class="{{ ($active === "dashboard") ? 'active' : '' }}"><a href="{{ route('dashboard.home') }}"><i class='bx bxs-dashboard'></i>Dashboard</a></li>
            <li class="{{ ($active === "booking") ? 'active' : '' }}"><a href="{{ route('dashboard.booking') }}"><i class='bx bxs-car-garage'></i>Booking</a></li>
            <li class="{{ ($active === "users") ? 'active' : '' }}"><a href="{{ route('user.home') }}"><i class='bx bx-user'></i>Users</a></li>
            <li class="{{ ($active === "role") ? 'active' : '' }}"><a href="{{ route('role.home') }}"><i class='bx bx-child'></i>Role</a></li>
            <li class="{{ ($active === "kendaraan") ? 'active' : '' }}"><a href="{{ route('kendaraan.home') }}"><i class='bx bx-car'></i>Kendaraan</a></li>
            <li class="{{ ($active === "pesanan") ? 'active' : '' }}"><a href="{{ route('pesanan.home') }}"><i class='bx bx-message-alt-edit'></i>Pesanan</a></li>
            <li class="{{ ($active === "riwayat") ? 'active' : '' }}"><a href="{{ route('riwayat.home') }}"><i class='bx bx-stopwatch'></i>Log Riwayat</a></li>
        </ul>
        <ul class="side-menu">
            <li>
                <a href="#" class="logout">
                    <i class='bx bx-log-out-circle'></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
    <!-- End of Sidebar -->