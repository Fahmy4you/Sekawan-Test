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
                        <a class="status completed" href="{{ route('kendaraan.edit', ['kendaraan' => $k->id]) }}">Edit</a>
                        <form class="formDelete" action="{{ route('kendaraan.hapus', ['kendaraan' => $k->id]) }}" method="post">
                            @method('delete')
                            @csrf
                            <button onclick="confirm('Apakah Anda Yakin Menghapus Data {{$k->nama}}')" type="submit" class="status danger">Delete</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection