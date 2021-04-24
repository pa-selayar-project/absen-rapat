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

    public function edit(Detail $detail)
    {
        //
    }

    public function update(Request $request, Detail $detail, $id )
    {
        $update = Detail::findOrFail($id);
        if($request->signed == "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2aWV3Qm94PSIwIDAgNDAwIDIwMCIgd2lkdGg9IjQwMCIgaGVpZ2h0PSIyMDAiPjwvc3ZnPg=="){
            return redirect()->back()->with('status','Form belum ditandatangani');
        }else{
            $update->update(['ttd'=>$request->signed]);
    
            return redirect()->back();
        }

    }

    public function destroy(Detail $detail)
    {
        //
    }
}
