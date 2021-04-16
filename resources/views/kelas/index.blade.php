@extends('layouts.app')
@section('content')
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Spp</title>
    </head>
    <body>
        <div class="container">
            {{-- @if ($messege = Session::get('success'))
            <div class="aler alert-danger alert-blok">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>$messege</strong>
            @endif --}}
            <h1>Index Kelas</h1>
            <div class="container">
                <a href="{{route('kelas.create')}}" class="btn btn-success">Create Kelas</a>
                <br>
                <br>
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Nama Kelas</th>
                            <th>Kompetensi Keahlian</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $kelas)
                        <tr>
                            <td>{{$kelas->nama_kelas}}</td>
                            <td>{{$kelas->kompetensi_keahlian}}</td>
                            <td>
                                <form action="{{route('kelas.destroy', $kelas->id)}}" method="POST" onsubmit="return confirm('Yakin akan di hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <a href="{{route('kelas.edit', $kelas->id)}}" class="btn btn-warning"> Edit</a>
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
        });
    </script>
@endsection