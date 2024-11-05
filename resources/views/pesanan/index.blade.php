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
            <i class='bx bx-message-alt-edit'></i>
            <h3>All Pemesanan</h3>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kendaraan</th>
                    <th>Driver</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pesanan as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->kendaraan->nama }}</td>
                    <td>{{ $p->user->name }}</td>
                    <td>
                        <span class="status 
                        @if(strtolower($p->status->status) == 'disetujui')
                         completed 
                        @elseif(strtolower($p->status->status) == 'belum direspon')
                         pending
                        @elseif(strtolower($p->status->status) == 'setuju tahap 1')
                         process 
                        @elseif(strtolower($p->status->status) == 'ditolak')
                         danger 
                        @else 
                         pending
                        @endif">{{ $p->status->status }}</span>
                    </td>
                    <td>
                        <a class="status completed">Setuju</a>
                        <a class="status danger">Tolak</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection