<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Employ;
use Hash;

class petugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Employ::all();
        return view('petugas.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            Employ::create([
            'nip'=>$request->nip,
            'nama'=>$request->nama,
            'email'=>$request->email,
            'password'=> bcrypt($request->password),
            'role'=>$request->role,
        ]);
        User::create([
            'name'=>$request->nama,
            'nio'=>$request->nip,
            'role'=>$request->role,
            'password'=> bcrypt($request->password),
            'email'=>$request->email
        ]);
        return redirect()->route('employ.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($employ)
    {
        $employ = Employ::where('nip','=',$employ)->first();
        return view('petugas.edit', compact('employ'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nip)
    {
        Employ::where('nip', $nip)->update([
            'nip' => $request->nip,
            'nama' => $request->nama,
            'password' => $request->password,
            'role' => $request->role,
            'email' => $request->email,
            
        ]);
        User::where('nio', $nip)->update([
            'nio' => $request->nip,
            'name' => $request->nama,
            'password' => $request->password,
            'role' => $request->role,
            'email' => $request->email,
            
        ]);
        // Employ::find($nip)->update($request->all());
        // User::find($nip)->update($request->all());
        return redirect()->route('employ.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($employ)
    {
        // dd($petuga);
        Employ::where('nip', $employ)->delete();
        User::where('nio', $employ)->delete();
        return redirect()->route('employ.index');
    }
}
