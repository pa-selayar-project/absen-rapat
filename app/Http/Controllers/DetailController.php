<?php

namespace App\Http\Controllers;

use App\Absen;
use App\Detail;
use App\Pegawai;
use App\Honorer;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index()
    {
        return view('frontend.absen-rapat.index');
    }

    public function store(Request $request, Detail $detail)
    {
        $nama_rapat = Absen::findOrFail($request->peserta);
        $peserta_pegawai = Pegawai::all();
        $peserta_honorer = Honorer::all();

        foreach($peserta_pegawai as $pegawai){
           Detail::create([
                'nama_peserta'=> $pegawai->nama,
                'jabatan'=> $pegawai->jabatan->jabatan,
                'id_absen' => $nama_rapat->id
            ]);     
        }
        foreach($peserta_honorer as $honorer){
            Detail::create([
                'nama_peserta'=> $honorer->nama,
                'jabatan'=> $honorer->jabatan->jabatan,
                'id_absen' => $nama_rapat->id
             ]);     
        }
        return redirect('absen')->with('status','Peserta berhasil ditambahkan!');
    }
    
    public function show(Detail $detail, $id)
    {
        $pegawai = Pegawai::all();
        $honorer = Honorer::all();
        $data = Detail::where('id_absen', $id)->paginate(10);
        $rapat = Absen::whereId($id)->first();
        if($rapat){
            return view('frontend/absen-rapat/show', compact('data','rapat','pegawai','honorer'));
        }else{
            return redirect(url('/'));
        }
    }
   
    public function update(Request $request, Detail $detail, $id)
    {
        // dd($request);
        $update = Detail::findOrFail($id);
        if($request->signed == null){
            return redirect()->back()->with('status','Form belum ditandatangani');
        }else{
            $data_uri = $request->signed;
            $encoded_image = explode(",", $data_uri)[1];
            $decoded_image = base64_decode($encoded_image);
            $nama_file = uniqid().".png";
            $file = file_put_contents($nama_file, $decoded_image);
            
            $update->update(['ttd'=>$request->signed]);
            return redirect()->back();
        }
    }

    public function destroy(Detail $detail)
    {
        //
    }
}
