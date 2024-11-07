@extends('layouts.main')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<div class="container-dashboard">
    <h2>Selamat Datang {{ auth()->user()->name }}</h2>

    <h3 class="titleGrafik">Bookingan Grafik 1 Tahun</h3>
    <canvas id="myChart" style="width:100%; height: 300px;"></canvas>
</div>

<script>
    const xValues = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    const yValues = @json($dataGrafikTahun);

    let pesanan = {{ $pesananTerbanyak + 5 }};

    new Chart("myChart", {
    type: "line",
    data: {
        labels: xValues,
        datasets: [{
        fill: false,
        lineTension: 0,
        backgroundColor: "rgba(0,0,255,1.0)",
        borderColor: "rgba(255,255,255,1)",
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        scales: {
        yAxes: [{ticks: {min: 0, max: pesanan}}],
        }
    }
    });
</script>
@endsection