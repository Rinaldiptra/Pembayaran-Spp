<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Kelas;
use App\Models\Spp;
use App\Models\view_siswa;

class siswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data =view_siswa::all();
        return view('siswa.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas =Kelas::all();
        $s =Spp::all();
        return view('siswa.create', compact('kelas','s'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Siswa $siswa)
    {
        $request->validate =([
            'nisn'=>'required',
            'nis'=>'required',
            'nama'=>'required',
            'id_kelas'=>'required',
            'alamat'=>'required',
            'no_telpon'=>'required',
            'id_spp'=>'required',
        ]);
        Siswa::create($request->all());
        $email = $request->nisn.'@smkwikrama.com';
        User::create([
            'name' =>$request->nama,
            'role' =>'siswa',
            'nio' =>$request->nisn,
            'email'=>$email,
            'password' =>bcrypt($request->nisn),
        ]);
        return redirect()->route('siswa.index');
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
    public function edit($siswa)
    {
        $kelas= Kelas::all();
        $s = Spp::all();
        $siswa = view_siswa::where('nisn','=',$siswa)->first();
        return view('siswa.edit', compact('siswa', 'kelas','s'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $nisn)
    {
        // dd($siswa);
        Siswa::where('nisn', $nisn)->update([
            'nisn' => $request->nisn,
            'nis' => $request->nis,
            'nama' => $request->nama,
            'id_kelas' => $request->id_kelas,
            'alamat' => $request->alamat,
            'no_telpon' => $request->no_telpon,
            'id_spp' => $request->id_spp,
            
        ]);
        $email = $request->nis.'@smkwikrama.com';
        User::where('nio', $nisn)->update([
            'nio' => $request->nisn,
            'name' => $request->nama,
            'password' => $request->nisn,
            'role' => 'siswa',
            'email' => $email,
            
        ]);
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($siswa)
    {
        // $a=Siswa::where('nisn', $siswa);
        // $a->delete();
        Siswa::where('nisn', $siswa)->delete();
        User::where('nio', $siswa)->delete();
        return redirect()->route('siswa.index');
    }
}
