<?php

namespace App\Http\Controllers;

use App\Pegawai;
use App\Jabatan;
use App\Pangkat;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        $data = Pegawai::paginate(5);
        $pangkat = Pangkat::orderBy('id','ASC')->get();
        $jabatan = Jabatan::whereTipe(2)->orderBy('id','ASC')->get();
        return view('backend.pegawai.index', compact('data','pangkat','jabatan'));
    }

    public function store(Request $request)
    {
        $this->validasiRequest();
        Pegawai::create([
            'nama'=> $request->nama,
            'nip'=> $request->nip,
            'id_pangkat'=> $request->pangkat,
            'id_jabatan'=> $request->jabatan,
            'aktif'=> 1
        ]);

        return redirect('/pegawai')->with('status','Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->validasiRequest();
        $update = Pegawai::findOrFail($id);
        $update->update([
            'nama'=> $request->nama,
            'nip'=> $request->nip,
            'id_pangkat'=> $request->pangkat,
            'id_jabatan'=> $request->jabatan,
            'aktif'=> 1
        ]);

        return redirect('/pegawai')->with('status','Data berhasil dirubah!');
    }

    public function destroy($id)
    {
        Pegawai::destroy($id);
        return redirect('/pegawai')->with('status','Data berhasil dihapus!');
    }

    public function ajax($id)
    {
        $data = Pegawai::findOrFail($id);
        return $data;
    }

    private function validasiRequest()
    {
        $messages = ['required'=>'Field :attribute ini wajib diisi'];

        return request()->validate([
            'nama'=>'required',
            'nip'=>'required|numeric',
            'pangkat'=>'required|numeric',
            'jabatan'=>'required|numeric',
        ], $messages);
    }
}
