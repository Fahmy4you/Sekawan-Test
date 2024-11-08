@extends('layouts.main')

@section('content')

<div class="bookingCard">
    @if($bookings != "[]")
        @foreach($bookings as $booking)
        <div class="card">
            <h1>{{ $booking->kendaraan->nama }}</h1>
            <p>PLAT : {{ $booking->kendaraan->plat }}</p>
            <p>Status : <span class="
            @if($booking->status->id == 1)
            pending
            @elseif($booking->status->id == 2)
            tahap1
            @elseif($booking->status->id == 6)
            disetujui
            @else
            pending
            @endif
            ">{{ $booking->status->status }}</span></p>
            <form class="button" method="post" action="{{ route('dashboard.bookingDelete') }}">
                @method('delete')
                @csrf
                <button onclick="confrim('" type="submit">
                    {{ $booking->status->id != 6 ? "Batalkan Pemakaian" : "Sudahi Pemakaian"}}
                </button>
            </form>
        </div>
        @endforeach
    @else 
        <h3>Anda Tidak Memiliki Bookingan</h3>
    @endif
</div>

@endsection