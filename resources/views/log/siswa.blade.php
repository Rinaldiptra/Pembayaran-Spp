@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Laporan Pembayaran</h1>
       
        <div class="container">
            <br>
            <br>
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th>Petugas</th>
                        <th>Nisn</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Tanggl Bayar</th>
                        <th>Bulan Dibayar</th>
                        <th>Tahun Dibayar</th>
                        <th>Spp</th>
                        <th>Tahun Ajaran</th>
                        <th>Jumlah Bayar</th>
                       
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $p)
                    <tr>
                        <td>{{$p->name}}</td>
                        <td>{{$p->nisn}}</td>
                        <td>{{$p->nama}}</td>
                        <td>{{$p->alamat}}</td>
                        <td>{{$p->tanggal_bayar}}</td>
                        <td>{{$p->bulan_dibayar}}</td>
                        <td>{{$p->tahun_dibayar}}</td>
                        <td>{{$p->nominal}}</td>
                        <td>{{$p->tahun}}</td>
                        <td>{{$p->jumlah_bayar}}</td>
                    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
    <script>
        $(document).ready(function(){
            $('#table').DataTable();
        })
    </script>
@endsection