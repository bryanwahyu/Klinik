<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pasien;
use App\rekam_medis;
use Auth;
class pasienController extends Controller
{
    public function new_pasien(Request $req)
    {
        $this->validate($req,[
            'nama'=>'required',
            'gender'=>'required',
            'alamat'=>'required',
            'tanggal_lahir'=>'required',
            'telepon'=>'required'
        ]);
        $pasien=new pasien;
        $pasien->nama=$req->nama;
        $pasien->no_bpjs=$req->no_bpjs;
        $pasien->alamat=$req->alamat;
        $pasien->telepon=$req->telepon;
        $pasien->gender=$req->gender;
        $pasien->tanggal_lahir=$req->tanggal_lahir;
        $pasien->save();
        
        $json['kode']=200;
        $json['pesan']="Pasien sudah ditambahkan";

        return response()->json($json);

    }
    public function edit_pasien(pasien $pasien,Request $req)
    {
        
        $this->validate($req,[
            'nama'=>'required',
            'gender'=>'required',
            'alamat'=>'required',
            'tanggal_lahir'=>'required',
            'telepon'=>'required'
        ]);

        $pasien->nama=$req->nama;
        $pasien->no_bpjs=$req->no_bpjs;
        $pasien->alamat=$req->alamat;
        $pasien->telepon=$req->telepon;
        $pasien->gender=$req->gender;
        $pasien->tanggal_lahir=$req->tanggal_lahir;
        $pasien->save();

        $json['kode']=200;
        $json['pesan']="Pasien sudah edit ";
        
        return response()->json($json); 
    }
    public function delete_pasien(pasien $pasien)
    {
        $pasien->delete();


        $json['kode']=200;
        $json['pesan']='Pasien sudah dihapus';

        return response()->json($json);
    }
    
    public function find_pasien(pasien $pasien)
    {
        $json['kode']=200;
        $json['item']=$pasien->load('rekam');

        return response()->json($json);

    }
    public function new_rekam(Request $req)
    {
        $this->validate($req,[
            'pasien_id'=>'required',
            'diagonosis'=>'required',
            'jenis_rawat'=>'required',
            'tindakan'=>'required'
        ]);

        $rekam= new rekam_medis;
        $rekam->pasien_id=$req->pasien_id;
        $rekam->dokter_id=Auth::user()->dokter->id;
        $rekam->diagonosis=$req->diagonosis;
        $rekam->jenis_rawat=$req->jenis_rawat;
        $rekam->tindakan=$req->tindakan;
        $rekam->save();

        $json['kode']=200;
        $json['pesan']="Rekam medis sudah ditambahkan";

        return response()->json($json);
    }
    public function edit_rekam( rekam_medis $rekam,Request $req)
    {
        $this->validate($req,[
            'diagonosis'=>'required',
            'jenis_rawat'=>'required',
            'tindakan'=>'required'
        ]);
        
        $rekam->diagonosis=$req->diagonosis;
        $rekam->jenis_rawat=$req->jenis_rawat;
        $rekam->tindakan=$req->tindakan;
        $rekam->save();

        $json['kode']=200;
        $json['pesan']="Rekam Medis sudah diedit";

        return response()->json($json);
    }
    public function delete_rekam(rekam_medis $rekam)
    {
        $rekam->delete();

        $json['kode']=200;
        $json['pesan']='Rekam Medis sudah dihapus';

        return response()->json($json);

    }  
    public function find_rekam(rekam_medis $rekam)
    {


        $json['kode']=200;
        $json['item']=$rekam->load('pasien');

        return response()->json($json);
    }
    
    
}
