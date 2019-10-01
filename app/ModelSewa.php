<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelSewa extends Model
{
    protected $table="sewa";
    protected $primarykey="id_sewa";
    public $timestamps=false;
    protected $fillable = [   
        'id_sewa',
        'nama_pelanggan',     
        'id_mobil',       
        'tgl_pinjam',  
        'tgl_kembali'
    ];
}
