<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\obat;
use App\transaksi;
use App\stok;
class obatController extends Controller
{
    public function index_obat()
    {
        $json['kode']=200;
        $json['data']=obat::with('stok','transaksi')->get();

        return response()->json($json);
    }
    public function new_obat(Request $req)
    {
        
        $obat=new obat;
        $obat->nama=$req->nama;
        $obat->bpjs=$req->bpjs;
        $obat->kode=$req->kode;
        $obat->save();

        $json['kode']=200;
        $json['pesan']="Obat Sudah didaftarkan ";

        return response()->json($json);
    }
    public function edit_obat(Obat $obat,Request $req)
    {
        $obat->nama=$req->nama;
        $obat->bpjs=$req->bpjs;
        $obat->save();

        $json['kode']=200;
        $json['pesan']='Obat berhasil diganti';

        return response()->json($json);

    }
    public function show_obat(obat $obat)
    {   
        $json['kode']=200;
        $json['item']=$obat->load('stok');

        return response()->json($json);

    }
    public function delete_obat(obat $obat)
    {
        
        $obat->delete();

        $json['kode']=200;
        $json['pesan']="OBat sudah dihapus";

        return response()->json($json);

    }

    //bagian isi stok
    public function new_stok(obat $obat,Request $req)
    {
        $stok=new stok;
        $stok->obat_id=$obat->id;
        $stok->stok=$req->stok;
        $stok->kadaluarsa=$req->kadarluarsa;
        $stok->save();

        $transaksi=new transaksi;
        $transaksi->kode=0;
        $transaksi->obat_id=$obat->id;
        $transaksi->jumlah=$req->stok;
        $transaksi->save();

    

        $json['kode']=200;
        $json['pesan']='Item Sudah distok';
    
        return response()->json($json);
    }

    public function keluar_data(stok $stok,Request $req)
    {
        $transaksi=new transaksi;
        $transaksi->kode=1;
        $transaksi->obat_id=$stok->obat_id;
        $transaksi->jumlah=$req->keluar;

        $stok->stok=$stok->stok-$req->keluar;
        $stok->save();

        $json['kode']=200;
        $json['pesan']='Obat telah keluar';

        return response()->json($json);
    }
    
    public function index_masuk(transaksi $trans)
    {
        $json['kode']=200;
        $json['data']=$trans->where('kode',0)->with('obat')->get();
        
        return response()->json($json);

    }
    public function index_keluar(transasksi $trans)
    {
        $json['kode']=200;
        $json['data']=$trans->where('kode',1)->with('obat')->get();

        return response()->json($json);
    }
    public function hapus_stok(stok $stok)
    {
        $stok->delete();
        
        $json['kode']=200;
        $json['pesan']='stok sudah dihapus';

        return response()->json($json);
    }
    
}
