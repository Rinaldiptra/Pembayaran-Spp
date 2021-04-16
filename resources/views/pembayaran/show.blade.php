@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-body" onclick="print()">
               <strong>Nama Siswa: {{$pembayaran->nama}}</strong><br>
               <strong>Rombel: {{$pembayaran->nisn}}</strong><br>
               <strong>tanggal_bayar: {{$pembayaran->tanggal_bayar}}</strong><br>
               <strong>Spp: {{$pembayaran->nominal}}</strong><br>
               <strong>Petugas: {{$pembayaran->name}}</strong><br>
               <strong>Pembayaran Untuk Bulan-Tahun: {{$pembayaran->bulan_dibayar}}/{{$pembayaran->tahun_dibayar}}</strong>
              

            </div>
        </div>
    </div>
</body>
</html>
    <script>
        function.print(){
            windows.print();
        }
    </script>
@endsection