@extends('layouts.main')

@section('content')
<h1 class="judulPage">Tambahkan Data Pesanan</h1>
@if($kendaraan == "[]") 
<h4>Data Kendaraan Tidak Ada Atau Dipesan Semua Tambahkan Terlebih Dahulu</h4>

@elseif($users == "[]") 
<h4>Data User Tidak Ada Atau Dipesan Semua Tambahkan Terlebih Dahulu</h4>


@elseif($kendaraan == "[]" && $users == "[]")
<h4>Data Kendaraan & User Tidak Ada Atau Dipesan Semua Tambahkan Terlebih Dahulu</h4>

@else
<form action="{{ route('pesanan.createPost') }}" method="post" class="formData">
    @csrf
    <select name="user_id" id="" @error('user') style="--aHover: #D32F2F;" @enderror>
        @foreach($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    </select>
    <select name="kendaraan_id" id="" @error('user') style="--aHover: #D32F2F;" @enderror>
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