<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class LoginController extends Controller
{
    public function data_user()
    {
        $json['kode']=200;
        $json['data']=Auth::user();

        return response()->json($json);
    }
}
