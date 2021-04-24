<?php

namespace App\Http\Controllers;

use App\Pangkat;
use Illuminate\Http\Request;

class PangkatController extends Controller
{
    public function index()
    {
        $data = Pangkat::paginate(5);
        return view('backend.setelan.pangkat.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validasiRequest();
        Pangkat::create([
            'pangkat'=> $request->pangkat
        ]);

        return redirect('/setelan/pangkat')->with('status','Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->validasiRequest();
        $update = Pangkat::findOrFail($id);
        $update->update([
            'pangkat'=> $request->pangkat
        ]);

        return redirect('/setelan/pangkat')->with('status','Data berhasil dirubah!');
    }

    public function destroy($id)
    {
        Pangkat::destroy($id);
        return redirect('/setelan/pangkat')->with('status','Data berhasil dihapus!');
    }

    public function ajax($id)
    {
        $data = Pangkat::findOrFail($id);
        return $data;
    }

    private function validasiRequest()
    {
        $messages = ['required'=>'Field :attribute ini wajib diisi'];

        return request()->validate([
            'pangkat'=>'required'
            
        ], $messages);
    }
}
