@extends('auth.layout')

@section('content')
<div class="card">
    <h1>Selamat Datang</h1>
    @if(session()->has('success'))
    <div class="successAlert auth">
         <p>{{ session('success') }}</p>
    </div>
    @endif
    @if(session()->has('error'))
    <div class="successAlert auth error">
         <p> session('error') </p>
    </div>
    @endif
    <form action="">
        <div class="inputDiv">
            <input type="email" placeholder="Email..." name="email" @error('email') style="--aHover: #D32F2F;" @enderror>
            @error('email')
                    <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="inputDiv">
            <input type="password" placeholder="Password..." name="password" @error('password') style="--aHover: #D32F2F;" @enderror>
            @error('password')
                    <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="button">
            <button>LOGIN</button>
        </div>
    </form>

    <p>Tidak Mempunyai Akun ? <a href="{{ route('auth.register') }}">Daftar Disini</a></p>
</div>

@endsection