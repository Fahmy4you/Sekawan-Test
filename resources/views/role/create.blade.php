@extends('layouts.main')

@section('content')
<h1 class="judulPage">Tambahkan Role</h1>
<form action="{{ route('role.createPost') }}" method="post" class="formData">
    @csrf
    <div class="inputDiv">
      <input type="text" placeholder="Role..." name="role" @error('role') style="--aHover: #D32F2F;" @enderror value="{{ old('role') }}"/>
            <span class="focus"></span>
            @error('role')
                <p>{{ $message }}</p>
            @enderror
        </div>
    <div class="buttonDiv">
        <button type="submit">Tambahkan Role</button>
    </div>
</form>

@endsection