@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2>Form siswa</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-success" href="{{ route('employ.create') }}"> Create New Employ</a>

            </div>

        </div>

    </div>

   <div class="container">
<br>
    @if ($message = Session::get('success'))

        <div class="alert alert-success">

            <p>{{ $message }}</p>

        </div>

    @endif

   

    <table class="table table-bordered" id="table">
        <thead>
        <tr>

            {{-- <th>No</th> --}}

            <th>Name</th>
            <th>Email</th>
            <th>Level</th>
            <th width="280px">Action</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($data as $petuga)

        <tr>

            {{-- <td>{{ ++$i }}</td> --}}

            <td>{{ $petuga->nama }}</td>
            <td>{{ $petuga->email }}</td>
            <td>{{ $petuga->role}}</td>
            {{-- <td>{{ $petuga->password }}</td> --}}


            <td>

                <form action="{{ route('employ.destroy', $petuga->nip)}}" method="POST" onsubmit="return confirm('Yakin akan di hapus?')">
                        

                       <a class="btn btn-warning" href="{{ route('employ.edit', $petuga->nip)}}">Edit</a>

   

                    @csrf

                    @method('DELETE')

      

                    <button type="submit" class="btn btn-danger">Delete</button>

                </form>

            </td>

        </tr>

        @endforeach
    </tbody>
    </table>

  
</div>
    {{-- {!! $siswas->links() !!} --}}

      
<script>
    $(document).ready(function(){
        $('#table').DataTable();
    });
</script>
@endsection