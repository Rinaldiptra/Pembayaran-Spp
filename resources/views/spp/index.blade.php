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
            <h1>Index Spp</h1>
            <div class="container">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{$message}}</p>
                </div>
            @endif
                <a href="{{route('spp.create')}}" class="btn btn-success">Create Spp</a>
                <br>
                <br>
                <table class="table table-bordered" id="table">
                    <thead>
                        <tr>
                            <th>Tahun</th>
                            <th>Nominal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $spp)
                        <tr>
                            <td>{{$spp->tahun}}</td>
                            <td>{{$spp->nominal}}</td>
                            <td>
                                <form action="{{route('spp.destroy', $spp->id)}}" method="POST" onsubmit="return confirm('Yakin akan di hapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                <a href="{{route('spp.edit', $spp->id)}}" class="btn btn-warning"> Edit</a>
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