<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('category',['category' => Category::paginate(20)]);
        }
    }

    public function form(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('category-add', ['title' => 'Tambah Kategori']);
        }
    }

    public function edit(Request $request,$id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('category-edit',['category' => Category::where('id',$id)->first()]);
        }
    }

    public function update(Request $request,$id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $category = Category::where('id',$id)->first();
            try{
                if($request->has('images')){
                    $url = URL::to('/');
        
                    $url_image = $category->images;
                    $image_name = str_replace($url.'/uploads/category/','',$url_image);
                    $path = public_path()."/uploads/category/".$image_name;
                    unlink($path);
        
                    $image = $request->file('images');
                    $imagePath = $url.'/uploads/category/'.str::slug(rand()."_".time()).'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/category');
                    $image->move($destinationPath, $imagePath);

                    if($category->update(['name' => $request->name, 'images' => $imagePath])){
                        return redirect()->back()->with('alert','Perubahan berhasil disimpan'); 
                    }else{
                        return redirect()->back()->with('alert-failed','Terjadi kesalahan'); 
                    }
                }else{
                    if($category->update(['name' => $request->name, 'images' => $category->images])){
                        return redirect()->back()->with('alert','Perubahan berhasil disimpan'); 
                    }else{
                        return redirect()->back()->with('alert-failed','Terjadi kesalahan'); 
                    }
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
            $category = new Category();
            try{
                $url = URL::to('/');
        
                $image = $request->file('images');
                $imagePath = $url.'/uploads/category/'.str::slug(rand()."_".time()).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/category');
                $image->move($destinationPath, $imagePath);

                $category->name = $request->name;
                $category->images = $imagePath;

                if($category->save()){
                    return redirect()->back()->with('alert','Berhasil menambahkan kategori'); 
                }else{
                    return redirect()->back()->with('alert-failed','Terjadi kesalahan'); 
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-failed',$e->getMessage());
            }
        }
    }

    public function destroy(Request $request,$id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            try{
                $product = Category::find($id);
                $url_base = URL::to('/');
                $url_image = $product->images;
                $image_name = str_replace($url_base.'/uploads/category/','',$url_image);
    
                $product->delete();
    
                $path = public_path()."/uploads/category/".$image_name;
                unlink($path);
    
                return redirect()->back()->with('alert','Kategori berhasil dihapus');
            }catch(\Exception $e){
                return redirect()->back()->with('alert-failed',$e->getMessage());
            }
        }
    }
}
