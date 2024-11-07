@extends('layouts.main')

@section('content')

<div class="bookingCard">
    @if($bookings != "[]")
        @foreach($bookings as $booking)
        <div class="card">
            <h1>{{ $booking->kendaraan->nama }}</h1>
            <p>PLAT : {{ $booking->kendaraan->plat }}</p>
            <p>Status : <span class="disetujui">Disetujui</span></p>
            <form class="button">
                <button>Sudahi Pemakaian</button>
            </form>
        </div>
        @endforeach
    @else 
        <h3>Anda Tidak Memiliki Bookingan</h3>
    @endif
</div>

@endsection