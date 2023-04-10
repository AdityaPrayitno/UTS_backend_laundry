<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\carbon;
use Illuminate\Http\Request;
use App\Models\transaksi;
use App\Models\paket;

class TransaksiController extends Controller
{
    public function gettransaksi(Request $req)
    {
        $data_transaksi=transaksi::
        join('pelanggan','pelanggan.id_pelanggan','=','transaksi.id_pelanggan')
        ->join('kasir','kasir.id_kasir','=','transaksi.id_kasir')
        ->join('paket','paket.id_paket','=','transaksi.id_paket')
        ->get();
      return Response()->json($data_transaksi);
    }

    public function getid_transaksi($id_transaksi)
    {
        $dt_transaksi=transaksi::where('id_transaksi','=', $id_transaksi)
        ->join('pelanggan','pelanggan.id_pelanggan','=','transaksi.id_pelanggan')
        ->join('kasir','kasir.id_kasir','=','transaksi.id_kasir')
        ->join('paket','paket.id_paket','=','transaksi.id_paket')
        ->get();
        return response()->json($dt_transaksi);
    }

    public function createtransaksi(Request $req)
    {
        $hargapaket = paket::where('id_paket', $req->id_paket)->first();
        $validator = Validator::make($req->all(),[
            'id_pelanggan'=>'required',
            'id_kasir'=>'required',
            'id_paket'=>'required'
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors()->toJson());   
        }

        $total = $req->berat * $hargapaket->harga;
        $create = transaksi::create([
            'id_pelanggan' =>$req->get('id_pelanggan'),
            'id_kasir' =>$req->get('id_kasir'),
            'id_paket' =>$req->get('id_paket'),
            'berat'=>$req->berat,
            'tgl_laundry' =>date('Y-m-d H:i:s'),
            'tgl_diambil' =>date('Y-m-d H:i:s'),
            'total' =>$total,
            'status' => 'Dicuci'
        ]);
        if($create){
            return Response()->json(['status'=>true,'message' => 'Sukses Menambah transaksi']);
        } else {
            return Response()->json(['status'=>false,'message' => 'Gagal Menambah transaksi']);
        }
    }

    public function updatetransaksi(Request $req, $id_transaksi)
    {
        $hargapaket = paket::where('id_paket', $req->id_paket)->first();
        $validate = Validator::make($req->all(),[
            'id_pelanggan'=>'required',
            'id_kasir'=>'required',
            'id_paket'=>'required'
    
        ]);
        if($validate->fails()){
            return response()->json($validate->errors()->toJson());
        }
        $total = $req->berat * $hargapaket->harga;
        $update = transaksi::where('id_transaksi',$id_transaksi)->update([
            'id_pelanggan'=>$req->get('id_pelanggan'),
            'id_kasir'=>$req->get('id_kasir'),
            'id_paket'=>$req->get('id_paket'),
            'tgl_diambil'=>$req->get('tgl_diambil'),
            'berat'=>$req->get('berat'),
            'total' =>$total,
            'status'=>$req->get('status')
            
        ]);
        if($update){
            return response()->json(['status'=>true,  'message'=>'Berhasil mengubah data transaksi']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal mengubah data transaksi']);
        }
    }

    public function deletetransaksi($id_transaksi){
        $delete = transaksi::where('id_transaksi',$id_transaksi)->delete();
        if($delete){
            return response()->json(['status'=>true, 'message'=>'Sukses menghapus data transaksi.']);
        }else{
            return response()->json(['status'=>false, 'message'=>'Gagal menghapus data transaksi.']);
        }
    }
}
