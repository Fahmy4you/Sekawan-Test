@extends('layouts.main')

@section('content')
<h1 class="judulPage">Edit Data User</h1>
<form action="{{ route('kendaraan.editPost', ['kendaraan' => $kendaraan->id]) }}" method="post" class="formData">
    @csrf
    @method('put')
    <div class="inputDiv">
        <input type="text" placeholder="Nama..." name="name" @error('name') style="--aHover: #D32F2F;" @enderror value="{{ old('name', $user->name) }}"/>
            <span class="focus"></span>
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="inputDiv">
            <input type="text" placeholder="Email..." name="email" @error('email') style="--aHover: #D32F2F;" @enderror value="{{ old('email', $user->email) }}"/>
            <span class="focus"></span>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="inputDiv">
            <input type="text" placeholder="Password..." name="password" @error('password') style="--aHover: #D32F2F;" @enderror />
            <span class="focus"></span>
            @error('password')
                <p>{{ $message }}</p>
            @enderror
            <p class="info">Kosongi Jika Tidak Mengganti Password</p>
        </div>
        <select name="role_id" id="" @error('role') style="--aHover: #D32F2F;" @enderror>
            @foreach($roles as $role)
            @if($role->id == $user->role->id)
            <option value="{{ $role->id }}" selected>{{ $role->role }}</option>
            @elseif($role->role != "Super")
            <option value="{{ $role->id }}">{{ $role->role }}</option>
            @endif
            @endforeach
        </select>
        <p class="info">Jika Anda Mengganti Role Dari Driver Ke Yang Lainnya Maka Jika Ia Mempunyai Pesanan Kendaraan Maka Akan Dihapus</p>
    <div class="buttonDiv">
        <button type="submit">Edit User</button>
    </div>
</form>

@endsection