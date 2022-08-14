<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import lib fungsi validasi laravel
use Illuminate\Support\Facades\Validator;

//import model supplier
use App\M_Supplier;

//import lib
use Illuminate\Http\Response;

//import lib encryp
use Illuminate\Contracts\Encryption\DecryptExeption;

class Registrasi extends Controller
{
    //

    public function index(){
        return view('registrasi.registrasi');
    }

    public function registrasi(Request $request){

        $this->validate($request,
            [
                'nama_supplier' => 'required',
                'email' => 'required',
                'alamat' => 'required',
                'no_npwp' => 'required',
                'password' => 'required'
            ]

        );

        if(
            M_Supplier::create(
                [
                    "nama_supplier" => $request->nama_supplier,
                    "email"=> $request->email,
                    "alamat" => $request->alamat,
                    "no_npwp" => $request->no_npwp,
                    "password" => encrypt($request->password)
                ]
            )
        ){
            return redirect('/registrasi')->with('berhasil','Data berhasil disimpan');
        }else{
            return redirect('/registrasi')->with('gagal','Data gagal disimpan');
        }
    }
}
