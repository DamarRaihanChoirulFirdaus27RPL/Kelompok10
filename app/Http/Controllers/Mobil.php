<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModelMobil;
use App\ModelSewa;
use Validator;
use Session;
use Auth;

class Mobil extends Controller
{
    public function index()
    {    
            //mengambil data dari table kategori
            $data['datas']=ModelMobil::join('jenis','jenis.id_jenis','mobil.id_jenis')->get(); 
            //mengirim data
            return view("car",$data);
    }
    public function pricing()
    {    
            //mengambil data dari table kategori
            $data['datas']=ModelMobil::join('jenis','jenis.id_jenis','mobil.id_jenis')->get(); 
            //mengirim data
            return view("pricing",$data);
    }
    public function create()
    {
        return view('mobil_create');
    }
    public function store(Request $request)
    {
        ModelMobil::create([
            'nama_mobil'        => $request->nama_mobil,
            'nomor_mobil'       => $request->nomor_mobil,
            'merk'              => $request->merk,
            'warna'             => $request->warna,
            'tahun_pembuatan'   => $request->tahun_pembuatan,
            'biaya_perhari'     => $request->biaya_perhari,
            'images'            => $request->images,
            'deskripsi'         => $request->deskripsi,
            'id_jenis'          =>$request->id_jenis
        ]);
        
        return redirect()->action('Mobil@index')->with('alert_message', 'Berhasil Menambah Data Baru!');
    }
    public function edit($id)
    {
        $data = ModelMobil::where('id_mobil', $id)->get();
        return view('mobil_edit', compact('data'));
    }
    //update Data
    public function update(Request $request)
    {

        ModelMobil::where('id_mobil', $request->id)->update([
            'nama_mobil'        => $request->nama_mobil,
            'nomor_mobil'       => $request->nomor_mobil,
            'merk'              => $request->merk,
            'warna'             => $request->warna,
            'tahun_pembuatan'   => $request->tahun_pembuatan,
            'biaya_perhari'     => $request->biaya_perhari,
            'images'            => $request->images,
            'deskripsi'         => $request->deskripsi
        ]);
        
        return redirect()->action('Mobil@index')->with('alert_message', 'Berhasil Mengubah Data');

    }
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function hapus($id)
    {
        ModelMobil::where('id_mobil', $id)->delete();

        return redirect()->action('Mobil@index')->with('alert_message', 'Berhasil Menghapus Data');
    }
    public function kembali($id)
    {
        ModelSewa::where('id_sewa', $id)->delete();

        return redirect()->action('Mobil@pricing')->with('alert_message', 'Berhasil Menghapus Data');
    }
    public function detail($id)
    {
        //mengamil data dari table kategori
        $data=ModelMobil::where('id_mobil', $id)->join('jenis', 'jenis.id_jenis', 'mobil.id_jenis')->get(); 
        //mengirim data
        return view('mobil_detail',compact('data'));
    }

    public function sewa(Request $request)
    {

        ModelSewa::create([
            'nama_pelanggan'          => $request->nama_pelanggan,
            'id_mobil'                => $request->id_mobil,
            'tgl_pinjam'              => $request->tgl_pinjam,
            'tgl_kembali'             => $request->tgl_kembali
        ]);
        
        return redirect()->action('Mobil@pricing')->with('alert_message', 'Berhasil Menambah Data Baru!');
    }
    public function pinjam()
    {    
            //mengambil data dari table kategori
            $data['datas']=ModelSewa::join('mobil','mobil.id_mobil','sewa.id_mobil')->get(); 
            //mengirim data
            return view("peminjam",$data);
    }
    public function logout()
    {
        Auth::logout();
  return redirect('/login');
    }
    

}
