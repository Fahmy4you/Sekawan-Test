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
            <i class='bx bx-child'></i>
            <h3>All Role</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($role as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->role }}</td>
                    <td>
                        <a class="status completed" href="{{ route('role.edit', ['role' => $r->id]) }}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection