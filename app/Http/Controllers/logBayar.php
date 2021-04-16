<?php

namespace App\Http\Controllers;

use App\Exports\PembayaranExport;
use Illuminate\Http\Request;
use App\Models\view_bayar;
use Maatwebsite\Excel\Facades\Excel;

class logBayar extends Controller
{
    public function index()
    {
        $data = view_bayar::all();
        return view('log.index', compact('data'));
    }

    public function excel()
    {
        return Excel::download(new PembayaranExport, 'Laporan Pembayaran Spp.xls');
    }
}
