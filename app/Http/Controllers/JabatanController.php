<?php

namespace App\Http\Controllers;

use App\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function index()
    {
        $data = Jabatan::paginate(5);
        return view('backend.setelan.jabatan.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validasiRequest();
        Jabatan::create([
            'jabatan'=> $request->jabatan,
            'tipe'=> $request->tipe
        ]);

        return redirect('/setelan/jabatan')->with('status','Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->validasiRequest();
        $update = Jabatan::findOrFail($id);
        $update->update([
            'jabatan'=> $request->jabatan,
            'tipe'=> $request->tipe
        ]);

        return redirect('/setelan/jabatan')->with('status','Data berhasil dirubah!');
    }

    public function destroy($id)
    {
        Jabatan::destroy($id);
        return redirect('/setelan/jabatan')->with('status','Data berhasil dihapus!');
    }

    public function ajax($id)
    {
        $data = Jabatan::findOrFail($id);
        return $data;
    }

    private function validasiRequest()
    {
        $messages = ['required'=>'Field :attribute ini wajib diisi'];

        return request()->validate([
            'jabatan'=>'required',
            'tipe'=>'required'
        ], $messages);
    }
}
