<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\pelanggan;

class PelangganController extends Controller
{
    public function getpelanggan()
    {
        $dt_pelanggan=pelanggan::get();
        return response()->json($dt_pelanggan);
    }
    
    public function getid_pelanggan($id_pelanggan)
    {
        $dt_pelanggan=pelanggan::where('id_pelanggan','=', $id_pelanggan)->get();
        return response()->json($dt_pelanggan);
    }

    public function createpelanggan(request $req){
        $validate = Validator::make($req->all(),[
            'nama_pelanggan'=>'required',
            'alamat_pelanggan'=>'required',
            'telepon_pelanggan'=>'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->tojson());
        }
        $create = pelanggan::create([
            'nama_pelanggan'=>$req->nama_pelanggan,
            'alamat_pelanggan'=>$req->alamat_pelanggan,
            'telepon_pelanggan'=>$req->telepon_pelanggan
        ]);
        if($create){
            return response()->json(['status'=>true, 'message'=>'Sukses menambahkan data Pelanggan.']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menambahkan data Pelanggan.']);
        }
    }

    public function deletepelanggan($id_pelanggan){
        $delete = pelanggan::where('id_pelanggan',$id_pelanggan)->delete();
        if($delete){
            return response()->json(['status'=>true, 'message'=>'Sukses menghapus data Pelanggan.']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menghapus data Pelanggan.']);
        }
    }

    public function updatepelanggan(Request $req, $id_pelanggan){
        $validate = Validator::make($req->all(),[
            'nama_pelanggan'=>'required',
            'alamat_pelanggan'=>'required',
            'telepon_pelanggan'=>'required'
    
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $update = pelanggan::where('id_pelanggan',$id_pelanggan)->update([
            'nama_pelanggan'=>$req->get('nama_pelanggan'),
            'alamat_pelanggan'=>$req->get('alamat_pelanggan'),
            'telepon_pelanggan'=>$req->get('telepon_pelanggan')
            
        ]);
        if($update){
            return response()->json(['status'=>true,  'message'=>'Berhasil mengubah data Pelanggan']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal mengubah data Pelanggan']);
        }
    }
}
