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
        $update = Detail::findOrFail($id);
        $fail = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAASwAAACWCAYAAABkW7XSAAAEYklEQVR4Xu3UAQkAAAwCwdm/9HI83BLIOdw5AgQIRAQWySkmAQIEzmB5AgIEMgIGK1OVoAQIGCw/QIBARsBgZaoSlAABg+UHCBDICBisTFWCEiBgsPwAAQIZAYOVqUpQAgQMlh8gQCAjYLAyVQlKgIDB8gMECGQEDFamKkEJEDBYfoAAgYyAwcpUJSgBAgbLDxAgkBEwWJmqBCVAwGD5AQIEMgIGK1OVoAQIGCw/QIBARsBgZaoSlAABg+UHCBDICBisTFWCEiBgsPwAAQIZAYOVqUpQAgQMlh8gQCAjYLAyVQlKgIDB8gMECGQEDFamKkEJEDBYfoAAgYyAwcpUJSgBAgbLDxAgkBEwWJmqBCVAwGD5AQIEMgIGK1OVoAQIGCw/QIBARsBgZaoSlAABg+UHCBDICBisTFWCEiBgsPwAAQIZAYOVqUpQAgQMlh8gQCAjYLAyVQlKgIDB8gMECGQEDFamKkEJEDBYfoAAgYyAwcpUJSgBAgbLDxAgkBEwWJmqBCVAwGD5AQIEMgIGK1OVoAQIGCw/QIBARsBgZaoSlAABg+UHCBDICBisTFWCEiBgsPwAAQIZAYOVqUpQAgQMlh8gQCAjYLAyVQlKgIDB8gMECGQEDFamKkEJEDBYfoAAgYyAwcpUJSgBAgbLDxAgkBEwWJmqBCVAwGD5AQIEMgIGK1OVoAQIGCw/QIBARsBgZaoSlAABg+UHCBDICBisTFWCEiBgsPwAAQIZAYOVqUpQAgQMlh8gQCAjYLAyVQlKgIDB8gMECGQEDFamKkEJEDBYfoAAgYyAwcpUJSgBAgbLDxAgkBEwWJmqBCVAwGD5AQIEMgIGK1OVoAQIGCw/QIBARsBgZaoSlAABg+UHCBDICBisTFWCEiBgsPwAAQIZAYOVqUpQAgQMlh8gQCAjYLAyVQlKgIDB8gMECGQEDFamKkEJEDBYfoAAgYyAwcpUJSgBAgbLDxAgkBEwWJmqBCVAwGD5AQIEMgIGK1OVoAQIGCw/QIBARsBgZaoSlAABg+UHCBDICBisTFWCEiBgsPwAAQIZAYOVqUpQAgQMlh8gQCAjYLAyVQlKgIDB8gMECGQEDFamKkEJEDBYfoAAgYyAwcpUJSgBAgbLDxAgkBEwWJmqBCVAwGD5AQIEMgIGK1OVoAQIGCw/QIBARsBgZaoSlAABg+UHCBDICBisTFWCEiBgsPwAAQIZAYOVqUpQAgQMlh8gQCAjYLAyVQlKgIDB8gMECGQEDFamKkEJEDBYfoAAgYyAwcpUJSgBAgbLDxAgkBEwWJmqBCVAwGD5AQIEMgIGK1OVoAQIGCw/QIBARsBgZaoSlAABg+UHCBDICBisTFWCEiBgsPwAAQIZAYOVqUpQAgQMlh8gQCAjYLAyVQlKgIDB8gMECGQEDFamKkEJEDBYfoAAgYyAwcpUJSgBAgbLDxAgkBEwWJmqBCVAwGD5AQIEMgIGK1OVoAQIGCw/QIBARsBgZaoSlACBB1YxAJfjJb2jAAAAAElFTkSuQmCC";
        
        if($request->ttd == $fail){
            return redirect()->back()->with('status','Form belum ditandatangani');
        }else{         
            $update->update(['ttd'=>$request->ttd]);
            return redirect()->back();
        }
    } 
}
