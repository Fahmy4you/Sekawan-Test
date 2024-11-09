@extends('layouts.main')

@section('content')

<div class="bottom-data riwayat">
    <div class="orders">
        <div class="header">
            <div class="title">
                <i class='bx bx-stopwatch'></i>
                <h3>Riwayat</h3>
            </div>
            <div class="inputTanggal">
                <input type="date">
            </div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th class="table-th-riwayat">Keterangan</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td class="table-td-riwayat">Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident possimus atque at corporis impedit quia ducimus saepe aliquid tempore ut?</td>
                    <td>Lorem ipsum dolor sit amet.</td>
                </tr>   
            </tbody>
        </table>
    </div>

</div>

@endsection