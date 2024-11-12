<!-- Navbar -->
        <nav>
            <i class='bx bx-menu'></i>
            <input type="checkbox" id="theme-toggle" hidden>
            <label for="theme-toggle" class="theme-toggle"></label>
            <a class="notif notifBell">
                <i class='bx bx-bell'></i>
                @if(!$dataNotifikasi->isEmpty())
                    <span class="count">{{ $dataNotifikasi->count() }}</span>
                @endif
            </a>
            <form action="{{ route('auth.logout') }}" method="post">
                @csrf
                <button class="logoutNav" onclick="confirm('Apakah Anda Yakin Akan Log Out ?')"><i class='bx bx-log-out-circle'></i></button>
            </form>
        </nav>

        <!-- End of Navbar -->