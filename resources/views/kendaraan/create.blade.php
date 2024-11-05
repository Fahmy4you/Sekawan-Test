@extends('layouts.main')

@section('content')
<h1 class="judulPage">Tambahkan Data Kendaraan</h1>
<form action="{{ route('user.createPost') }}" method="post" class="formData">
    @csrf
    <div class="inputDiv">
        <input type="text" placeholder="Nama..." name="nama" @error('nama') style="--aHover: #D32F2F;" @enderror value="{{ old('nama') }}"/>
            <span class="focus"></span>
            @error('nama')
                <p>{{ $message }}</p>
            @enderror
        </div>
    <div class="inputDiv">
        <input type="text" placeholder="Plat..." name="plat" @error('plat') style="--aHover: #D32F2F;" @enderror value="{{ old('plat') }}"/>
        <span class="focus"></span>
        @error('plat')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="buttonDiv">
        <button type="submit">Tambahkan Kendaraan</button>
    </div>
</form>

@endsection