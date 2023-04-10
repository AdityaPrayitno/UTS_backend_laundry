<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\paket;

class PaketController extends Controller
{
    public function getpaket()
    {
        $dt_paket=paket::get();
        return response()->json($dt_paket);
    }
    
    public function getid_paket($id_paket)
    {
        $dt_paket=paket::where('id_paket','=', $id_paket)->get();
        return response()->json($dt_paket);
    }

    public function createpaket(request $req){
        $validate = Validator::make($req->all(),[
            'jenis_paket'=>'required',
            'harga'=>'required',
            'durasi'=>'required'
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->tojson());
        }
        $create = paket::create([
            'jenis_paket'=>$req->jenis_paket,
            'harga'=>$req->harga,
            'durasi'=>$req->durasi
        ]);
        if($create){
            return response()->json(['status'=>true, 'message'=>'Sukses menambahkan data paket.']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menambahkan data paket.']);
        }
    }

    public function deletepaket($id_paket){
        $delete = paket::where('id_paket',$id_paket)->delete();
        if($delete){
            return response()->json(['status'=>true, 'message'=>'Sukses menghapus data paket.']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menghapus data paket.']);
        }
    }

    public function updatepaket(Request $req, $id_paket){
        $validate = Validator::make($req->all(),[
            'jenis_paket'=>'required',
            'harga'=>'required',
            'durasi'=>'required'
    
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $update = paket::where('id_paket',$id_paket)->update([
            'jenis_paket'=>$req->get('jenis_paket'),
            'harga'=>$req->get('harga'),
            'durasi'=>$req->get('durasi')
            
        ]);
        if($update){
            return response()->json(['status'=>true,  'message'=>'Berhasil mengubah data paket']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal mengubah data paket']);
        }
    }
}
