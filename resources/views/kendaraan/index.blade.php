@extends('layouts.main')

@section('content')
<div class="bottom-data">
    <div class="orders">
        <div class="header">
            <i class='bx bx-car'></i>
            <h3>All Kendaraan</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Plat</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kendaraan as $k)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $k->nama }}</td>
                    <td>{{ $k->plat }}</td>
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