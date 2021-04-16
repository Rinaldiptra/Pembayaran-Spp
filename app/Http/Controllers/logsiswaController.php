<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\view_bayar;
use App\Models\Pembayaran;
use App\Models\view_siswa;

class logsiswaController extends Controller
{
    public function index()
    {
        $data = view_bayar::where('nisn', Auth::user()->nio)->get();
        return view('log.siswa', compact('data'));
    }
}
