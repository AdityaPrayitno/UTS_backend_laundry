<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;
    protected $table = 'kasir';
    protected $primarykey = 'id_kasir';
    public $timestamps = false;
    public $fillable = [
        'nama_kasir', 'alamat_kasir', 'telepon_kasir'
    ];
}
