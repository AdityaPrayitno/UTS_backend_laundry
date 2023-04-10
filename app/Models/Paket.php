<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paket extends Model
{
    use HasFactory;
    protected $table = 'paket';
    protected $primarykey = 'id_paket';
    public $timestamps = false;
    public $fillable = [
        'jenis_paket', 'harga', 'durasi'
    ];
}
