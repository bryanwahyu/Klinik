<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pasien;
use App\dokter;
use App\obat;
use App\transaksi;
class DataController extends Controller
{
    public function data_dashboard()
    {
        $json['data']['pasien']=pasien::count();
        $json['data']['dokter']=dokter::count();
        $json['data']['obat']=obat::count();
        $json['data']['transaksi']=transaksi::count();
        $json['kode']=200;

        return response()->json($json);
    }
}
