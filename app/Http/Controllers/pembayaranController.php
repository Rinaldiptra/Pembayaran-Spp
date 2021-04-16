<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\view_bayar;
use App\Models\Pembayaran;
use Illuminate\Support\Carbon;
use App\Models\Siswa;
use App\Models\Spp;
use App\Models\view_siswa;
use Illuminate\Support\Facades\Auth;
class pembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembayaran = Pembayaran::all();
        $data = view_bayar::all();
        return view('pembayaran.index', compact('data','pembayaran'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $siswa = siswa::all();
        return view('pembayaran.create', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $this->validate($request, [
            'nisn' => 'required',
            'jumlah_bayar' => 'required',
        ]);

        $siswa = Siswa::where('nisn', '=', $request->nisn)->first();

        $spp = Spp::where('id', '=', $siswa->id_spp)->first();

        $bln = ['januari', 'februari', 'maret', 'april', 'mei', 'juni', 'juli', 'agustus', 'september', 'oktober', 'november', 'desember'];

        $transaksi = Pembayaran::where('nisn', '=', $request->nisn)->get();

        if (sizeof($transaksi) == 0) :
            $bulan = 6;
            $tahun = substr($spp->tahun, 0, 4);
        else :
            $a = array_key_last(end($transaksi));

            $akhir = $transaksi[$a];

            $a = array_search($akhir->bulan_dibayar, $bln);

            if ($a == 11) :
                $bulan = 0;
                $tahun = $akhir->tahun_dibayar + 1;
            else :
                $bulan = $a + 1;
                $tahun = $akhir->tahun_dibayar;
            endif;
        endif;

        if ($request->jumlah_bayar < $spp->nominal) :
            return back()->with(['gagal' => 'Uang yg anda masukan kurang']);
        endif;

        $pembayaranSimpan = Pembayaran::create([
            'id_petugas' => Auth::user()->id,
            'nisn' => $request->nisn,
            'tanggal_bayar' => Carbon::now(),
            'bulan_dibayar' => $bln[$bulan],
            'tahun_dibayar' => $tahun,
            'id_spp' => $siswa->id_spp,
            'jumlah_bayar' => $request->jumlah_bayar
        ]);


        if ($pembayaranSimpan) {
            return redirect()->route('pembayaran.index')->with(['sukses' => 'Transaksi Berhasil Disimpan']);
        } else {
            return redirect()->back()->with(['Error' => 'Gagal Disimpan']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(view_bayar $pembayaran)
    {
        return view('pembayaran.show', compact('pembayaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(view_bayar $pembayaran)
    {
        return view('pembayaran.edit', compact('pembayaran',));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pembayaran $pembayaran)
    {
        $pembayaran->delete();
        return redirect()->route('pembayaran.index');
    }
    public function getData($nisn)
    {
       
        $siswa = Siswa::where('nisn', $nisn)->first();

        $spp = Spp::find($siswa->id_spp);

        $pembayaran = Pembayaran::where('nisn','=', $siswa->nisn)
        ->latest()
        ->first();
        if($pembayaran == null){
            $data = [
                'harga' => $spp->nominal,
                'bulan' => 'belum pernah bayar',
                'tahun' => ' ',
                
            ];
        }else{
            $data = [
                'harga' => $spp->nominal,
                'siswa' => $siswa, 
                'bulan' => $pembayaran->bulan_dibayar,
                'akhir' => $pembayaran->tahun_dibayar,
                'tahun'=>$pembayaran->tahun_dibayar
            ];
        }
       
        return response()->json($data);

    }
}
