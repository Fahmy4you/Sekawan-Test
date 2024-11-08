@extends('layouts.main')

@section('content')

<h1 class="judulPage">Pilih Kendaraan Booking</h1>
@if(!$kendaraan) 
<h4>Anda Sudah Memiliki Bookingan Tidak Bisa Nambah Lagi</h4>

@elseif($kendaraan == "[]") 
<h4>Data Kendaraan Tidak Ada Atau Dipesan Semua</h4>

@else
<form action="{{ route('dashboard.bookingCreatePost') }}" method="post" class="formData">
    @csrf
    <select name="kendaraan_id" id="" @error('kendaraan_id') style="--aHover: #D32F2F;" @enderror>
        @foreach($kendaraan as $k)
            <option value="{{ $k->id }}">{{ $k->nama }}</option>
        @endforeach
    </select>
    <div class="buttonDiv">
        <button type="submit">Tambahkan Pesanan</button>
    </div>
</form>
@endif

@endsection