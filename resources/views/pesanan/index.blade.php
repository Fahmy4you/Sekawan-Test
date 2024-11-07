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
                        @else 
                         pending
                        @endif">{{ $p->status->status }}</span>
                    </td>
                    <td>
                        @if($p->status->id == 1)
                            <form class="formDelete" action="{{ route('pesanan.setuju', ['pemesanan' => $p->id]) }}" method="post">
                                @method('put')
                                @csrf
                                <button onclick="confirm('Setuju Kendaraan {{ $p->kendaraan->nama }} Dipakai {{ $p->user->role->role }} {{ $p->user->name }}')" type="submit" class="status completed">Setuju</a>
                        </form>

                        @elseif($p->status->id == 2)
                            <form class="formDelete" action="{{ route('pesanan.setuju2', ['pemesanan' => $p->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button onclick="confirm('Setuju Kendaraan {{ $p->kendaraan->nama }} Dipakai {{ $p->user->role->role }} {{ $p->user->name }}')" type="submit" class="status completed">Setuju</a>
                        </form>
                        @endif

                            <form class="formDelete" action="{{ route('pesanan.tolak', ['pemesanan' => $p->id]) }}" method="post">
                                @method('delete')
                                @csrf
                                <button onclick="confirm('Setuju Kendaraan {{ $p->kendaraan->nama }} Dipakai {{ $p->user->role->role }} {{ $p->user->name }}')" type="submit" class="status danger">Tolak</a>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection