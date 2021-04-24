<?php

namespace App\Http\Controllers;

use App\Honorer;
use App\Jabatan;
use Illuminate\Http\Request;

class HonorerController extends Controller
{
    public function index()
    {
        $data = Honorer::paginate(5);
        $jabatan = Jabatan::whereTipe(3)->get();
        return view('backend.ppnpn.index', compact('data','jabatan'));
    }

    public function store(Request $request)
    {
        $this->validasiRequest();
        Honorer::create([
            'nama'=> $request->nama,
            'id_jabatan'=> $request->jabatan,
            'aktif'=> 1
        ]);

        return redirect('/ppnpn')->with('status','Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->validasiRequest();
        $update = Honorer::findOrFail($id);
        $update->update([
            'nama'=> $request->nama,
            'id_jabatan'=> $request->jabatan,
            'aktif'=> 1
        ]);

        return redirect('/ppnpn')->with('status','Data berhasil dirubah!');
    }

    public function destroy($id)
    {
        Honorer::destroy($id);
        return redirect('/ppnpn')->with('status','Data berhasil dihapus!');
    }

    public function ajax($id)
    {
        $data = Honorer::findOrFail($id);
        return $data;
    }

    private function validasiRequest()
    {
        $messages = ['required'=>'Field :attribute ini wajib diisi'];

        return request()->validate([
            'nama'=>'required',
            'jabatan'=>'required|numeric'
        ], $messages);
    }
}
