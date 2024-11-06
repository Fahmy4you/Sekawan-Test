@extends('layouts.main')

@section('content')
<h1 class="judulPage">Edit Data Kendaraan</h1>
<form action="{{ route('kendaraan.editPost', ['kendaraan' => $kendaraan->id]) }}" method="post" class="formData">
    @method('put')
    @csrf
    <div class="inputDiv">
        <input type="text" placeholder="Nama..." name="nama" @error('nama') style="--aHover: #D32F2F;" @enderror value="{{ old('nama', $kendaraan->nama) }}"/>
            <span class="focus"></span>
            @error('nama')
                <p>{{ $message }}</p>
            @enderror
        </div>
    <div class="inputDiv">
        <input type="text" placeholder="Plat..." name="plat" @error('plat') style="--aHover: #D32F2F;" @enderror value="{{ old('plat', $kendaraan->plat) }}"/>
        <span class="focus"></span>
        @error('plat')
            <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="buttonDiv">
        <button type="submit">Edit Kendaraan</button>
    </div>
</form>

@endsection