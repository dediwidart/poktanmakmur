<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('faq',['faq' => Faq::paginate(20)]);
        }
    }

    public function form(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('faq-add', ['title' => 'Tambah Faq']);
        }
    }
    
    public function edit(Request $request,$id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('faq-edit', ['faq' => Faq::where('id',$id)->first()]);
        }
    }

    public function update(Request $request, $id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $faq = Faq::find($id);
            try{
                if($faq->update(['questions' => $request->questions, 'answer' => $request->answer])){
                    return redirect()->back()->with('alert','Perubahan berhasil disimpan'); 
                }else{
                    return redirect()->back()->with('alert-failed','Terjadi kesalahan'); 
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-failed',$e->getMessage());
            }
        }
    }

    public function store(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $faq = new Faq();
            try{
                $faq->questions = $request->questions;
                $faq->answer = $request->answer;
                if($faq->save()){
                    return redirect()->back()->with('alert','Faq berhasil ditambahkan'); 
                }else{
                    return redirect()->back()->with('alert-failed','Terjadi kesalahan'); 
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-failed',$e->getMessage());
            }
        }
    }

    public function destroy(Request $request, $id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $faq = Faq::find($id);
            try{
                if($faq->delete()){
                    return redirect()->back()->with('alert','Faq berhasil dihapus'); 
                }else{
                    return redirect()->back()->with('alert-failed','Terjadi kesalahan'); 
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-failed',$e->getMessage());
            }
        }
    }
}
