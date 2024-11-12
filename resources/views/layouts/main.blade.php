<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>ANTAM ID | {{ $title }}</title>
</head>

<body>
  @include('layouts.sidebar')
  
  <div class="notificationDash">
    @if(!$dataNotifikasi->isEmpty())
      @foreach($dataNotifikasi as $notifikasi)
      <div class="notifCard">
        <h3>{{ $notifikasi->judul }}</h3>
        <p>{{ $notifikasi->keterangan }}</p>
        <p>{{ $notifikasi->created_at }}</p>
      </div>
      @endforeach
    @else 
    <div style="height: 100%; display: flex; justify-content: center; align-items: center;">
      <p style="font-weight: 600; font-size: 13px;">Anda Tidak Memiliki Notifikasi Hari Ini</p>

    </div>
    @endif
  </div>

  <!-- Main Content -->
  <div class="content">
    @include('layouts.navbar')
    
    <main>
      <div class="header">
        <div class="left">
          <h1>{{ $path[0] }}</h1>
          <ul class="breadcrumb">
              <li><a href="#">{{ $path[0] }}</a></li>/<li><span class="active">{{ $path[1] }}</span></li>
          </ul>
        </div>
          <a href="{{ $aAtas['url'] }}" class="report">
              <i class='{{ $aAtas["icon"] }}'></i>
              <span>{{ $aAtas['text'] }}</span>
          </a>
        </div>
        
        @yield('content')
    </main>
    
  </div>
    <script src="{{ asset('js/index.js') }}"></script>
</body>

</html>