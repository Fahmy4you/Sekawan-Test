@extends('auth.layout')

@section('content')
<div class="card">
    <h1>Daftar Disini</h1>
    <form action="{{ route('auth.registerPost') }}" method="post">
        @csrf
        <div class="inputDiv">
            <input type="text" placeholder="Nama..." autofocus name="name" @error('name') style="--aHover: #D32F2F;" @enderror>
            @error('name')
                    <p>{{ $message }}</p>
            @enderror
        </div>
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
            <button>REGISTER</button>
        </div>
    </form>

    <p>Sudah Mempunyai Akun ? <a href="{{ route('auth.login') }}">Login Disini</a></p>
</div>

@endsection