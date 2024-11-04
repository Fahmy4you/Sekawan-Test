@extends('layouts.main')

@section('content')
<h1 class="judulPage">Tambahkan Data User</h1>
<form action="{{ route('user.createPost') }}" method="post" class="formData">
    @csrf
    <div class="inputDiv">
        <input type="text" placeholder="Nama..." name="name" class="error" />
            <span class="focus"></span>
    </div>
    <p>Name is required</p>
    <div class="inputDiv">
        <input type="text" placeholder="Email..." name="email" />
            <span class="focus"></span>
    </div>
    <div class="inputDiv">
        <input type="password" placeholder="Password..." name="password" />
            <span class="focus"></span>
    </div>
    <select name="role" id="">
        @foreach($roles as $role)
            <option value="{{ $role->id }}">{{ $role->role }}</option>
        @endforeach
    </select>
    <div class="buttonDiv">
        <button type="submit">Tambahkan User</button>
    </div>
</form>

@endsection