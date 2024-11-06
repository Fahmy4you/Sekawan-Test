<!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a href="#" class="notif">
                <i class='bx bx-bell'></i>
                <span class="count">12</span>
            </a>
            <form action="{{ route('auth.logout') }}" method="post">
                @csrf
                <button class="logoutNav"><i class='bx bx-log-out-circle'></i></button>
            </form>
        </nav>

        <!-- End of Navbar -->