@extends('layouts.main')

@section('content')
<h1 class="judulPage">Edit Data Kendaraan</h1>
<form action="{{ route('role.editPost', ['role' => $role->id]) }}" method="post" class="formData">
    @method('put')
    @csrf
    <div class="inputDiv">
        <input type="text" placeholder="Role..." name="role" @error('role') style="--aHover: #D32F2F;" @enderror value="{{ old('role', $role->role) }}"/>
            <span class="focus"></span>
            @error('role')
                <p>{{ $message }}</p>
            @enderror
        </div>
    <div class="buttonDiv">
        <button type="submit">Edit Role</button>
    </div>
</form>

@endsection