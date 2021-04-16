<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\view_bayar;
use Maatwebsite\Excel\Concerns\WithUpserts;

class PembayaranExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return view_bayar::all();
    }

    public function headings(): array
    {
        return [
            'id',
            'id_petugas',
            'nisn',
            'tanggal_bayar',
            'bulan_dibayar',
            'tahun_dibayar',
            'id_spp',
            'jumlah_bayar',
            'created_at',
            'update_at',
            'name',
            'role',
            'nio',
            'email',
            'nis',
            'nama',
            'alamat',
            'tahun',
            'nominal',
        ];
    }
}
