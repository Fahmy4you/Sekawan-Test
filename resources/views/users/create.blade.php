@extends('layouts.main')

@section('content')
<h1 class="judulPage">Tambahkan Data User</h1>
<form action="{{ route('user.createPost') }}" method="post" class="formData">
    @csrf
    <div class="inputDiv">
        <input type="text" placeholder="Nama..." name="name" @error('name') style="--aHover: #D32F2F;" @enderror value="{{ old('name') }}"/>
            <span class="focus"></span>
            @error('name')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="inputDiv">
            <input type="text" placeholder="Email..." name="email" @error('email') style="--aHover: #D32F2F;" @enderror value="{{ old('email') }}"/>
            <span class="focus"></span>
            @error('email')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <div class="inputDiv">
            <input type="password" placeholder="Password..." name="password" @error('password') style="--aHover: #D32F2F;" @enderror />
            <span class="focus"></span>
            @error('password')
                <p>{{ $message }}</p>
            @enderror
        </div>
        <select name="role_id" id="" @error('role') style="--aHover: #D32F2F;" @enderror>
        @foreach($roles as $role)
            @if($role->role != "Super")
            <option value="{{ $role->id }}">{{ $role->role }}</option>
            @endif
        @endforeach
    </select>
    <div class="buttonDiv">
        <button type="submit">Tambahkan User</button>
    </div>
</form>

@endsection