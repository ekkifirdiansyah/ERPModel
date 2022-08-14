<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import lib session
use Illuminate\Support\Facades\Session;

//import lib JWT
use \Firebase\JWT\JWT;

//import lib response
use Illuminate\Http\Response;

//import lib validator
use Illuminate\Support\Facades\Validator;

//import lib enkripsi
use Illuminate\Contracts\Encryption\DecryptExeption;

//import model supplier
use App\M_Supplier;

// import model admin
use App\M_Admin;

class Supplier extends Controller
{
    //
    public function index()
    {
        return view('supplier.login');
    }

    public function loginSupplier(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required'
            ]
        );

        $cek = M_Supplier::where('email', $request->email)->count();
        $sup = M_Supplier::where('email', $request->email)->get();

        if ($cek > 0) {
            foreach ($sup as $s) {
                if (decrypt($s->password) == $request->password) {
                    $key = env('APP_KEY');
                    $data = array(
                        "id_supplier" => $s->id_supplier
                    );

                    $jwt = JWT::encode($data, $key, 'HS256');

                    M_Supplier::where('id_supplier', $s->id_supplier)->update(
                        [
                            'token' => $jwt
                        ]
                    );
                    Session::put('token', $jwt);
                    return redirect('/listSupplier');
                } else {
                    return redirect('/loginSupplier')->with('gagal', 'Password Anda Salah');
                }
            }
        } else {
            return redirect('/loginSupplier')->with('gagal', 'Email Tidak Terdaftar');
        }
    }

    public function logoutSupplier()
    {
        $token = Session::get('token');

        if (M_Supplier::where('token', $token)->update(
            [
                'token' => 'keluar',
            ]
        )) {
            Session::put('token', "");
            return redirect('/');
        } else {
            return redirect('/logoutSupplier')->with('gagal', 'Anda gagal logout');
        }
    }

    public function listSup(){
        $token = Session::get('token');

        $tokenDb = M_Admin::where('token', $token)->count();

        if($tokenDb > 0){
            $data['adm'] = M_Admin::where('token', $token)->first();
            $data['supplier'] = M_Supplier::paginate(15);
            return view('admin.listSup', $data);
        }else{
            return redirect('/loginAdmin')->with('gagal', 'Anda sudah logout, silahkan login kembali!');
        }
    }

    public function Aktif($id){
        $token = Session::get('token');

        $tokenDb = M_Admin::where('token', $token)->count();

        if($tokenDb > 0){
            if(M_Supplier::where('id_supplier', $id)->update(
                [
                    "status" == "1"
                ]
            )){
                return redirect('/listSup')->with('berhasil', 'Data Berhasil Di Update');
            }else{
                return redirect('/listSup')->with('gagal', 'Data Gagal Di Update');
            }
        }else{
            return redirect('/loginAdmin')->with('gagal', 'Anda sudah logout, silahkan login kembali!');
        }
    }

    public function nonAktif($id){
        $token = Session::get('token');

        $tokenDb = M_Admin::where('token', $token)->count();

        if($tokenDb > 0){
            if(M_Supplier::where('id_supplier', $id)->update(
                [
                    "status" == "0"
                ]
            )){
                return redirect('/listSup')->with('berhasil', 'Data Berhasil Di Update');
            }else{
                return redirect('/listSup')->with('gagal', 'Data Gagal Di Update');
            }
        }else{
            return redirect('/loginAdmin')->with('gagal', 'Anda sudah logout, silahkan login kembali!');
        }
    }

    public function ubahPasswordSup(Request $request){
        $token = Session::get('token');
        $tokenDb = M_Supplier::where('token', $token)->count();

        if($tokenDb > 0){
            $key = env('APP_KEY');
            $sup = M_Supplier::where('token', $token)->first();

            $decode = JWT::decode($token, new Key($key, 'HS256'));
            $decode_array = (array) $decode;

            if(decrypt($sup->password) == $request->passwordLama){
                if(M_Supplier::where('id_supplier', $decode_array['id_supplier'])->update(
                    [
                        "password" => encrypt($request->password)
                    ]
                )){
                    return redirect('/loginSupplier')->with('gagal', 'Password berhasil DiUbah');
                }else{
                    return redirect('/listSupplier')->with('gagal', 'Password Gagal Diubah');
                }
            }else{
                return redirect('/listSupplier')->with('gagal', 'Password Gagal Diubah, Password Lama Tidak Sama');
            }
            
        }else{
            return redirect('/loginSupplier')->with('gagal', 'Anda Sudah LogOut, Silahkan Login Kembali');
        }
    }
}
