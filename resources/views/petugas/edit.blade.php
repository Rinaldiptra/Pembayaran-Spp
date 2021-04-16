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
        <h1>Edit Petugas</h1>
        <div class="container">
            <div class="card">  
                <div class="card-body">
                    <form action="{{ route('employ.update', $employ->nip) }}" method="POST">

                        @csrf
                
                        @method('PUT')
                
                        <strong>Nip:</strong>
                        <input type="text" name="nip" value="{{ $employ->nip }}" class="form-control" placeholder="nisn">                    
                                    <strong>Nama:</strong>
                                    <input type="text" name="nama" value="{{ $employ->nama }}" class="form-control" placeholder="nisn">                    
                                    <strong>Email:</strong>
                                    <input type="text" name="email" value="{{ $employ->email }}" class="form-control" placeholder="nip">
                                    <strong>Role</strong>
                                    <select id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" required autocomplete="new-role">
                                        <option valu=""selected>Pilih Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="petugas">Petugas</option>
                                        {{-- <option value="siswa">Siswa</option> --}}
                                     </select>
                                     <strong>Password</strong>
                                     <input type="password" name="password" class="form-control" value="{{$employ->password}}">
                                  
                <br>
                              <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
@endsection