<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import lib session
use Illuminate\Support\Facades\Session;

//import lib JWT
use \Firebase\JWT\JWT;

//import model supplier
use App\M_Supplier;

//import model pengadaan
use App\M_Pengadaan;

class Home extends Controller
{
    //

    public function index(){
        $key = env('APP_KEY');
        $token = Session::get('token');

        $tokenDb = M_Supplier::where('token', $token)->count();

        if($tokenDb > 0){
            $data['token'] = $token;

        }else{
            $data['token'] = "kosong";
        }

        $data['pengadaan'] = M_Pengadaan::where('status', '1')->paginate(15);
        return view('home.home', $data);
    }
}
