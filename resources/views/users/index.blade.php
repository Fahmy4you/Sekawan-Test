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
                        <a class="status completed">Edit</a>
                        <a class="status danger">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection