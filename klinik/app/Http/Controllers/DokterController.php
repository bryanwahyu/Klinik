<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\dokter;
use App\jadwal;
use App\janji;
use Carbon\Carbon;
class DokterController extends Controller
{
    public function jadwal_hari_ini()
    {
         $json['data']=jadwal::whereDate('tanggal',Carbon::now())->with('dokter.janji')->get();
         $json['kode']=200;

         return response()->json($json);
    }
    public function store_jadwal(Request $req)
    {
        $cekjad=jadwal::whereDate('tanggal',$req->tanggal)->where('dokter_id',$req->dokter_id)->count();
        if($cekjad==0)
        {
            $jad=new jadwal;
            $jad->dokter_id=$req->dokter_id;
            $jad->tanggal=$req->tanggal;
            $jad->jam_mulai=$req->jam_mulai;
            $jad->jam_selesai=$req->jam_selesai;
            $jad->save();

            $json['kode']=200;
            $json['pesan']='Jadwal sudah ditambahkan';
        }
        else
        {
            $json['kode']=204;
            $json['pesan']='dokter sudah dijadwalkan';    
        }

        return response()->json($json);
    }

    public function update_jadwal(Request $req,jadwal $jad)
    {
        $jad->tanggal=$req->tanggal;
        $jad->jam_mulai=$req->jam_mulai;
        $jad->jam_selesai=$req->jam_selesai;
        $jad->save();

        $json['kode']=200;
        $json['pesan']='Berhasil diupdate';

        return response()->json($json);
    }
    public function index_jadwal()
    {
        $json['data']=jadwal::with('dokter')->get();
        $json['kode']=200;

        return response()->json($json);

    }
    public function show_jadwal(jadwal $jad)
    {
        $json['data']=$jad->load('dokter.janji');
        $json['kode']=200;

        return response()->json($json);

    }
    public function store_dokter(Request $req)
    {
        $dok=new dokter;
        $dok->nama=$req->nama;
        $dok->bidang=$req->bidang;
        $dok->gender=$req->gender;
        $dok->notelp=$req->notelp;
        $dok->alamat=$req->alamat;
        $dok->save();

        $json['kode']=200;
        $json['pesan']='Data Dokter berhasil disimpan';

        return response()->json($json);
        
    }
    public function update_dokter(dokter $dok,Request $req)
    {
        $dok->nama=$req->nama;
        $dok->bidang=$req->bidang;
        $dok->notelp=$req->notelp;
        $dok->alamat=$req->alamat;
        $dok->gender=$req->gender;
        $dok->save();

        $json['kode']=200;
        $json['pesan']='Dokter ditelah di edit';

        return response()->json($json);

    }
    public function show_dokter(dokter $dok)
    {
        $json['data']=$dok->load('jadwal','janji.pasien','rekam.pasien');
        $json['kode']=200;

        return response()->json($json);
    }
    public function index_dokter()
    {
        $json['data']=dokter::with('janji.pasien','jadwal','rekam.pasien')->get();
        $json['kode']=200;

        return response()->json($json);
    }
    public function delete_dokter(dokter $dok)
    {
        
        $dok->delete();

        $json['pesan']='Dokter sudah dihapus';
        $json['kode']=200;

        return response()->json($json);
    }
    public function index_janji()
    {
        $json['kode']=200;
        $json['data']=janji::with('dokter','pasien')->get();

        return response()->json($json);

    }
    public function store_janji(Request $req)
    {
        $janji=new janji;
        $janji->tanggal=$req->tanggal;
        $janji->dokter_id=$req->dokter_id;
        $janji->pasien_id=$req->pasien_id;
        $janji->save();

        $json['kode']=200;
        $json['pesan']='janji sudah di tambahkan';

        return response()->json($json);
    }
    public function update_janji(janji $janji ,Request $req)
    {
         $janji->tanggal=$req->tanggal;
         $janji->dokter_id=$req->dokter_id;
         $janji->save();

         $json['kode']=200;
         $json['pesan']='data sudah di update';

    }   
    public function delete_janji(janji $janji)
    {
        $janji->delete();

        $json['kode']=200;
        $json['pesan']='janji dibatalkan';

        return response()->json($json);

    }

    
}
