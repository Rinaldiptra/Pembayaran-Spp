@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>spp</title>
</head>
<body>
    <div class="container">
        <h1>Payment</h1>
        <div class="container">
            
                @if ($message = Session::get('gagal'))
                <div class="alert alert-danger">
                    <p>{{$message}}</p>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{route('pembayaran.store')}}" method="POST">
                    @csrf
                     <div class="form-group">
                         <strong>Siswa</strong>
                         <select name="nisn" id="nisn" class="form-control" id="nisn" onchange="getData()">
                            <option value="" selected>Pilih Siswa</option>
                            @foreach ($siswa as $a)
                            <option value="{{$a->nisn}}">{{$a->nisn}} {{$a->nama}}</option>
                         @endforeach
                         </select>
                         <strong>Terakhir Bayar</strong>
                         <input type="text" name="akhir" id="akhir" class="form-control" readonly>
                         <strong>Nominal</strong>
                         <input type="text" name="nominal" id="nominal" class="form-control" readonly>
                         <strong>Uang</strong>
                         <input type="number" name="jumlah_bayar" class="form-control">
                     </div>
                     <button type="submit" class="btn btn-success">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
    <script>
        $(document).ready(function(){
            $('#nisn').select2();
        });
    </script>

<script>
    function getData(){
        var nisn = $('#nisn').val();
        console.log(nisn);
        $.ajax({
            url:"{{ url('pembayaran/get-data/') }}" + '/' + nisn,
            type: 'GET',
            success: function(data){
                if(data['harga'] == null){
                    $('#nominal').val('belum pernah bayar');
                    $('#akhir').val('belum pernah bayar');
                }else{
                    var isi = data['bulan'] + " " + data['tahun'];
                    $('#nominal').val(data['harga']);
                    $('#akhir').val(isi);
                }
              
            }
        });
    }
</script>
@endsection