@extends('layouts.main')

@section('content')

<div class="bottom-data riwayat">
    <div class="orders">
        <div class="header">
            <div class="title">
                <i class='bx bx-stopwatch'></i>
                <h3>Riwayat</h3>
            </div>
            <form action="{{ route('riwayat.home') }}" method="get" class="inputTanggal">
                <input type="date" name="date">
                <button type="submit">Cari</button>
            </from>
        </div>
        @if(!$riwayats->isEmpty()) 
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th class="th-riwayat">Keterangan</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                @foreach($riwayats as $riwayat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td style="padding: 0 10px;">{{ $riwayat->keterangan }}</td>
                    <td>{{ $riwayat->category->category }}</td>
                </tr>   
                @endforeach
            </tbody>
        </table>
        @else 
        <p style="text-align: center; font-weight: 600;">Tidak Ada Data Pada Tanggal {{ $tanggal }}</p>
        @endif
    </div>

</div>

@endsection