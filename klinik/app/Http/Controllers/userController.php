<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\dokter;
use App\user;
class userController extends Controller
{
    public function login(Request $req)
    {
        if(Auth::attempt(['username' => $req->username, 'password' => $req->password]))
        {
            $json['kode']=200;
            $json['pesan']='welcome to our clinic';
            $json['token']=Auth::user()->createToken('klinik')->accessToken;
        }
        else 
        {
            $json['kode']=204;
            $json['pesan']='sorry wrong password or username';   
        }
        return response()->json($json);
    }
    public function register(Request $req)
    {
        $cek=$user->where('username',$req->username)->count();
          if($cek==1)
          {

                $user=new user;
                $user->username=$req->username;
                $user->password=bcrypt($req->password);
                $user->role=$req->role;
                $user->save();

                $json['kode']=200;
                $json['pesan']='Data sudah disimpan';
            }
         else
          {
              $json['kode']=203;
              $json['pesan']='username sudah digunakan';

              
          }
        return response()->json($json);

    }
    public function lupa_password(User $user)
    {
        $user->password=bcrypt('klinik');
        $user->save();

        $json['kode']=200;
        $json['pesan']="password berhasil diganti";

        return response()->json($json);

    }
    public function ganti_password(User $user,Request $req)
    {
        $user->password=bcrypt($req->password);
        $user->save();
        
        $json['kode']=200;
        $json['pesan']='password berhasil di ganti';

        return response()->json($json);

    }
    
}
