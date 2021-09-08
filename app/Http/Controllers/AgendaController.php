<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function index(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('agenda',['agenda'=>Agenda::orderBy('id','DESC')->paginate(20)]);
        }
    }

    public function show(Request $request,$id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('agenda-edit',['agenda'=>Agenda::where('id',$id)->first()]);
        }
    }

    public function create(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('agenda-add');
        }
    }

    public function store(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            
            $agenda = new Agenda();
            $agenda->name = $request->get('name');
            $agenda->date = $request->get('date');
            $agenda->time = $request->get('time_start') . " " . $request->get('time_zone') . " - " . $this->getEndTime($request);
            $agenda->location = $request->get('location');
            return $agenda->save() ? redirect()->back()->with('alert','Berhasil menambahkan agenda') : redirect()->back()->with('alert-failed','Terjadi kesalahan');
        }
    }

    public function getEndTime($request){
        if($request->get('time_end') != null){
            return $request->get('time_end') . " " . $request->get('time_zone');
        }else{
            return "Selesai";
        }
    }

    public function update(Request $request,$id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $agenda = Agenda::where('id',$id)->first();
            $agenda->name = $request->get('name');
            $agenda->date = $request->get('date');
            $agenda->time = $request->get('time_start') . " " . $request->get('time_zone') . " - " . $this->getEndTime($request);
            $agenda->location = $request->get('location');
            return $agenda->update() ? redirect()->back()->with('alert','Berhasil memperbarui agenda') : redirect()->back()->with('alert-failed','Terjadi kesalahan');
        }
    }

    public function destroy(Request $request,$id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $agenda = Agenda::where('id',$id)->first();
            return $agenda->delete() ? redirect()->back()->with('alert','Berhasil menghapus agenda') : redirect()->back()->with('alert-failed','Terjadi kesalahan');
        }
    }
}
