<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $data = Menu::paginate(5);
        return view('backend.setelan.menu.index', compact('data'));
    }

    public function store(Request $request)
    {
        $this->validasiRequest();
        Menu::create([
            'nama_menu'=> $request->nama_menu,
            'link'=> $request->link,
            'icon'=> $request->icon,
            'letak'=> $request->letak
        ]);

        return redirect('/setelan/menu')->with('status','Data berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $this->validasiRequest();
        $update = Menu::findOrFail($id);
        $update->update([
            'nama_menu'=> $request->nama_menu,
            'link'=> $request->link,
            'icon'=> $request->icon,
            'letak'=> $request->letak
        ]);

        return redirect('/setelan/menu')->with('status','Data berhasil dirubah!');
    }

    public function destroy($id)
    {
        Menu::destroy($id);
        return redirect('/setelan/menu')->with('status','Data berhasil dihapus!');
    }

    public function ajax($id)
    {
        $data = Menu::findOrFail($id);
        return $data;
    }

    private function validasiRequest()
    {
        $messages = ['required'=>'Field :attribute ini wajib diisi'];

        return request()->validate([
            'nama_menu'=>'required',
            'link'=>'required',
            'icon'=>'required',
            'letak'=>'required'
        ], $messages);
    }
}
