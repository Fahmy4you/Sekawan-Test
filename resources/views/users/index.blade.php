@extends('layouts.main')

@section('content')

@if(session()->has('success'))
<div class="successAlert">
    <p>{{ session('success') }}</p>
</div>
@endif

<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-user'></i>
            <h3>All Users</h3>
        </div>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role->role }}</td>
                    <td>
                        <a class="status completed" href="{{ route('user.edit', ['user' => $user->id]) }}">Edit</a>
                        <form class="formDelete" action="{{ route('user.hapus', ['user' => $user->id]) }}" method="post">
                            @method('delete')
                            @csrf
                            <button onclick="confirm('Apakah Anda Yakin Menghapus Data {{$user->name}}')" type="submit" class="status danger">Delete</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection