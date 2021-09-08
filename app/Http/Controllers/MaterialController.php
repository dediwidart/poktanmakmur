<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class MaterialController extends Controller
{
    public function index(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('material',['material'=>Material::orderBy('id','DESC')->paginate(20)]);
        }
    }

    public function show(Request $request,$id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('material-edit',['material'=>Material::where('id',$id)->first()]);
        }
    }

    public function create(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('material-add');
        }
    }

    public function store(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $url = URL::to('/');
        
            $image = $request->file('images');
            $imagePath = $url.'/uploads/material/'.str::slug(rand()."_".time()).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/material');
            $image->move($destinationPath, $imagePath);

            $material = new Material();
            $material->title = $request->get('name');
            $material->description = $request->get('description');
            $material->images = $imagePath;
            return $material->save() ? redirect()->back()->with('alert','Berhasil menambahkan materi') : redirect()->back()->with('alert-failed','Terjadi kesalahan');
        }
    }

    public function update(Request $request,$id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $material = Material::where('id',$id)->first();
            $url = URL::to('/');
        
            if($request->has('images')){
                $url_image = $material->images;
                $image_name = str_replace($url.'/uploads/material/','',$url_image);
                $path = public_path()."/uploads/material/".$image_name;
                unlink($path);
    
                $image = $request->file('images');
                $imagePath = $url.'/uploads/material/'.str::slug(rand()."_".time()).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/material');
                $image->move($destinationPath, $imagePath);
                $material->images = $imagePath;
            }

            $material->title = $request->get('name');
            $material->description = $request->get('description');
            return $material->update() ? redirect()->back()->with('alert','Berhasil memperbarui materi') : redirect()->back()->with('alert-failed','Terjadi kesalahan');
        }
    }

    public function destroy(Request $request,$id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $material = Material::where('id',$id)->first();
            $url = URL::to('/');
        
            $url_image = $material->images;
            $image_name = str_replace($url.'/uploads/material/','',$url_image);
            $path = public_path()."/uploads/material/".$image_name;
            unlink($path);
            return $material->delete() ? redirect()->back()->with('alert','Berhasil menghapus materi') : redirect()->back()->with('alert-failed','Terjadi kesalahan');
        }
    }
}
