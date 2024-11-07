@extends('layouts.main')

@section('content')

<div class="bookingCard">
    @if($bookings != "[]")
        @foreach($bookings as $booking)
        <div class="card">
            <h1>TRUK TELOLET</h1>
            <p>PLAT : S 4545 D</p>
            <p>Status : <span class="disetujui">Disetujui</span></p>
            <div class="button">
                <button>Sudahi Pemakaian</button>
            </div>
        </div>
        @endforeach
    @else 
        <h3>Anda Tidak Memiliki Bookingan</h3>
    @endif
</div>

@endsection