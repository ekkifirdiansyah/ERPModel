<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//import lib session
use Illuminate\Support\Facades\Session;

//import lib JWT
use \Firebase\JWT\JWT;

//import lib response
use Illuminate\Http\Response;

//import lib validation
use Illuminate\Support\Facades\Validator;

//import lib enkripsi
use Illuminate\Contracts\Encryption\DecryptExeption;

//import storage
use Illuminate\Support\Facades\Storage;

//import model admin
use App\M_Admin;

//import model pengadaan
use App\M_Pengadaan;

//import model supplier
use App\M_Supplier;

class Pengadaan extends Controller
{
    //
    public function index(){
        $token = Session::get('token');
        
        $tokenDb = M_Admin::where('token', $token)->count();
        if($tokenDb > 0){
            $data['adm'] = M_Admin::where('token', $token)->first();
            $data['pengadaan'] = M_Pengadaan::where('status', '1')->paginate(4);

            return view('pengadaan.list', $data);
        }else{
            return redirect('/masukAdmin')->with('gagal','Anda sudah logout, silahkan login kembali');
        }
    }

    public function tambahPengadaan(Request $request){
        $token = Session::get('token');

        $tokenDb = M_Admin::where('token', $token)->count();

        if($tokenDb > 0){
            $this->validate($request,
            [
                'nama_pengadaan' => 'required',
                'deskripsi' => 'required',
                'gambar' => 'required|image|mimes:jpg,jpeg,png|max:10000',
                'anggaran' => 'required'
            ]
            );

            $path = $request->file('gambar')->store('public/gambar');
            
            if(M_Pengadaan::create(
                [
                    "nama_pengadaan" => $request->nama_pengadaan,
                    "deskripsi" => $request->deskripsi,
                    "gambar" => $path,
                    "anggaran" => $request->anggaran
                ]
            )){
                return redirect('/listPengadaan')->with('berhasil', 'Data Berhasil Disimpan');
            }else{
                return redirect('/listPengadaan')->with('gagal', 'Data Gagal Disimpan');
            }

        }else{
            return redirect('/masukAdmin')->with('gagal', 'Anda sudah logout, silahkan login kembali');
        }
    }

    public function hapusGambar($id){

        $token = Session::get('token');

        $tokenDb = M_Admin::where('token', $token)->count();

        if($tokenDb > 0){
            $pengadaan = M_Pengadaan::where('id_pengadaan', $id)->count();

            if($pengadaan > 0){
                $dataPengadaan = M_Pengadaan::where('id_pengadaan', $id)->first();
                
                if(Storage::delete($dataPengadaan->gambar)){
                    if(M_Pengadaan::where('id_pengadaan', $id)->update(["gambar" => "-"])){
                        return redirect('/listPengadaan')->with('berhasil', 'Gambar Berhasil Dihapus');
                    
                    }else{
                        return redirect('/listPengadaan')->with('gagal', 'Gambar Gagal Dihapus');
                    }
                }else{
                    return redirect('/listPengadaan')->with('gagal', 'Gambar Gagal Dihapus');
                }
            }else{
                return redirect('/listPengadaan')->with('gagal', 'Data Tidak Ditemukan');
            }
        }else{
            return redirect('/masukAdmin')->with('gagal', 'Anda sudah logout, silahkan login kembali');
        }
    }

    public function uploadGambar(Request $request){
        $token = Session::get('token');

        $tokenDb = M_Admin::where('token', $token)->count();

        if($tokenDb > 0){
            $this->validate($request,
            [
                'gambar' => 'required|image|mimes:jpg,jpeg,png|max:10000',
            ]
            );

            $path = $request->file('gambar')->store('public/gambar');
            
            if(M_Pengadaan::where('id_pengadaan', $request->id_pengadaan)->update(
                [
                    "gambar" => $path,
                ]
            )){
                return redirect('/listPengadaan')->with('berhasil', 'Data Berhasil Disimpan');
            }else{
                return redirect('/listPengadaan')->with('gagal', 'Data Gagal Disimpan');
            }

        }else{
            return redirect('/masukAdmin')->with('gagal', 'Anda sudah logout, silahkan login kembali');
        }
    }

    public function hapusPengadaan($id){

        $token = Session::get('token');

        $tokenDb = M_Admin::where('token', $token)->count();

        if($tokenDb > 0){
            $pengadaan = M_Pengadaan::where('id_pengadaan', $id)->count();

            if($pengadaan > 0){
                $dataPengadaan = M_Pengadaan::where('id_pengadaan', $id)->first();
                
                if(Storage::delete($dataPengadaan->gambar)){
                    if(M_Pengadaan::where('id_pengadaan', $id)->delete()){
                        return redirect('/listPengadaan')->with('berhasil', 'Data Berhasil Dihapus');
                    
                    }else{
                        return redirect('/listPengadaan')->with('gagal', 'Data Gagal Dihapus');
                    }
                }else{
                    return redirect('/listPengadaan')->with('gagal', 'Data Gagal Dihapus');
                }
            }else{
                return redirect('/listPengadaan')->with('gagal', 'Data Tidak Ditemukan');
            }
        }else{
            return redirect('/masukAdmin')->with('gagal', 'Anda sudah logout, silahkan login kembali');
        }
    }

    public function ubahPengadaan(Request $request){
        $token = Session::get('token');

        $tokenDb = M_Admin::where('token', $token)->count();

        if($tokenDb > 0){
            $this->validate($request,
            [
                'u_nama_pengadaan' => 'required',
                'u_deskripsi' => 'required',
                'u_anggaran' => 'required'
            ]
            );

            if(M_Pengadaan::where("id_pengadaan", $request->id_pengadaan)->update(
                [
                    "nama_pengadaan" => $request->u_nama_pengadaan,
                    "deskripsi" => $request->u_deskripsi,
                    "anggaran" => $request->u_anggaran
                ]
            )){
                return redirect('/listPengadaan')->with('berhasil', 'Data Berhasil Disimpan');
            }else{
                return redirect('/listPengadaan')->with('gagal', 'Data Gagal Disimpan');
            }

        }else{
            return redirect('/masukAdmin')->with('gagal', 'Anda sudah logout, silahkan login kembali');
        }
    }

    public function listSupplier(){
        $token = Session::get('token');
        
        $tokenDb = M_Supplier::where('token', $token)->count();
        if($tokenDb > 0){
            
            $data['sup'] = M_Supplier::where('token', $token)->first();

            $data['pengadaan'] = M_Pengadaan::where('status', '1')->paginate(2);

            return view('supplier.pengadaan', $data);
        }else{
            return redirect('/loginSupplier')->with('gagal', 'Password Anda Salah');
        }
    }
}
