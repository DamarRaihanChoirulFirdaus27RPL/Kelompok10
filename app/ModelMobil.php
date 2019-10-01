<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ModelMobil extends Model
{
    protected $table="mobil";
    protected $primarykey="id_mobil";
    public $timestamps=false;
    protected $fillable = [   
        'id_mobil',
        'nomor_mobil',     
        'nama_mobil',         
        'merk',  
        'warna',    
        'tahun_pembuatan',   
        'biaya_perhari',
        'images',
        'deskripsi',
        'id_jenis'
    ];
}
