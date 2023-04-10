<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primarykey = 'id_transaksi';
    public $timestamps = false;
    public $fillable = [
        'id_pelanggan', 'id_kasir', 'id_paket', 'berat', 'tgl_laundry', 'tgl_diambil', 'status', 'total'
    ];
}
