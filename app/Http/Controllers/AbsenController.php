<?php

namespace App\Http\Controllers;

use App\Absen;
use App\Detail;
use Illuminate\Http\Request;

class AbsenController extends Controller
{
    public function index()
    {
        $data = Absen::paginate(5);
        return view('backend.absen.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validasiRequest();
        Absen::create([
            'nama_rapat'=> $request->nama_rapat,
            'hari'=> $request->hari,
            'jam'=> $request->jam,
            'tempat'=> $request->tempat,
            'aktif'=> 1
        ]);

        return redirect('/absen')->with('status','Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->validasiRequest();
        $update = Absen::findOrFail($id);
        $update->update([
            'nama_rapat'=> $request->nama_rapat,
            'hari'=> $request->hari,
            'jam'=> $request->jam,
            'tempat'=> $request->tempat,
            'aktif'=> 1
        ]);

        return redirect('/absen')->with('status','Data berhasil dirubah!');
    }

    public function destroy($id)
    {
        Detail::where('id_absen', $id)->delete();
        Absen::destroy($id);
        return redirect('/absen')->with('status','Data berhasil dihapus!');
    }

    public function ajax($id)
    {
        $data = Absen::findOrFail($id);
        return $data;
    }

    private function validasiRequest()
    {
        $messages = ['required'=>'Field :attribute ini wajib diisi'];

        return request()->validate([
            'nama_rapat'=>'required',
            'hari'=>'required',
            'jam'=>'required',
            'tempat'=>'required',
        ], $messages);
    }
}
