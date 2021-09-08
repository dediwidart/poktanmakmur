<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function index(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('banner',['banner' => Banner::paginate(20)]);
        }
    }

    public function form(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('banner-add', ['title' => 'Tambah Banner']);
        }
    }

    public function store(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $banner = new Banner();
            try{
                $url = URL::to('/');
        
                $image = $request->file('images');
                $imagePath = $url.'/uploads/banners/'.str::slug(rand()."_".time()).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/banners');
                $image->move($destinationPath, $imagePath);

                $banner->images = $imagePath;

                if($banner->save()){
                    return redirect()->back()->with('alert','Berhasil menambahkan banner'); 
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
            try{
                $banner = Banner::find($id);
                $url_base = URL::to('/');
                $url_image = $banner->images;
                $image_name = str_replace($url_base.'/uploads/banners/','',$url_image);
    
                $banner->delete();
    
                $path = public_path()."/uploads/banners/".$image_name;
                unlink($path);
    
                return redirect()->back()->with('alert','Banner berhasil dihapus');
            }catch(\Exception $e){
                return redirect()->back()->with('alert-failed',$e->getMessage());
            }
        }
    }
}
