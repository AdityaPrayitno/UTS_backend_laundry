<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\kasir;

class KasirController extends Controller
{
    public function getkasir()
    {
        $dt_kasir=kasir::get();
        return response()->json($dt_kasir);
    }
    
    public function getid_kasir($id_kasir)
    {
        $dt_kasir=kasir::where('id_kasir','=', $id_kasir)->get();
        return response()->json($dt_kasir);
    }

    public function createkasir(request $req){
        $validate = Validator::make($req->all(),[
            'jenis_kasir'=>'required',
            'alamat_kasir'=>'required',
            'telepon_kasir'=>'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->tojson());
        }
        $create = kasir::create([
            'jenis_kasir'=>$req->jenis_kasir,
            'alamat_kasir'=>$req->alamat_kasir,
            'telepon_kasir'=>$req->telepon_kasir
        ]);
        if($create){
            return response()->json(['status'=>true, 'message'=>'Sukses menambahkan data kasir.']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menambahkan data kasir.']);
        }
    }

    public function deletekasir($id_kasir){
        $delete = kasir::where('id_kasir',$id_kasir)->delete();
        if($delete){
            return response()->json(['status'=>true, 'message'=>'Sukses menghapus data kasir.']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menghapus data kasir.']);
        }
    }

    public function updatekasir(Request $req, $id_kasir){
        $validate = Validator::make($req->all(),[
            'jenis_kasir'=>'required',
            'alamat_kasir'=>'required',
            'telepon_kasir'=>'required'
    
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $update = kasir::where('id_kasir',$id_kasir)->update([
            'jenis_kasir'=>$req->get('jenis_kasir'),
            'alamat_kasir'=>$req->get('alamat_kasir'),
            'telepon_kasir'=>$req->get('telepon_kasir')
            
        ]);
        if($update){
            return response()->json(['status'=>true,  'message'=>'Berhasil mengubah data kasir']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal mengubah data kasir']);
        }
    }
}
