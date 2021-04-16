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
        <h1>Index Pembayaran</h1>
       
        <div class="container">
            @if ($message = Session::get('sukses'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
        @endif
            <a href="{{route('pembayaran.create')}}" class="btn btn-success">Creat Payment</a>
            <br>
            <br>
            <table class="table table-bordered" id="table">
                <thead>
                    <tr>
                        <th>Petugas</th>
                        <th>Nisn</th>
                        <th>Nama</th>
                        <th>Tanggl Bayar</th>
                        <th>Bulan Dibayar</th>
                        <th>Tahun Dibayar</th>
                        <th>Spp</th>
                        <th>Jumlah Bayar</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $p)
                    <tr>
                        <td>{{$p->name}}</td>
                        <td>{{$p->nisn}}</td>
                        <td>{{$p->nama}}</td>
                        <td>{{$p->tanggal_bayar}}</td>
                        <td>{{$p->bulan_dibayar}}</td>
                        <td>{{$p->tahun_dibayar}}</td>
                        <td>{{$p->nominal}}</td>
                        <td>{{$p->jumlah_bayar}}</td>
                        <td>

                            <form action="{{ route('pembayaran.destroy',$p->id) }}" method="POST">
             
            
                                   <a class="btn btn-primary" href="{{ route('pembayaran.show',$p->id) }}">Show</a>
            
                                   {{-- <a class="btn btn-success" href="{{ route('pembayarans.show',$pembayaran->id) }}">Show</a> --}}
            
                                @csrf
                                @method('DELETE')
            
                  
            
                                {{-- <button type="submit" class="btn btn-danger">Delete</button> --}}
            
                            </form>
            
                        </td>
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