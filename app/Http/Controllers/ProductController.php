<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            if($request->has('q')){
                return view('product',['product' => Product::where('name','like',"%{$request->get('q')}%")->orderBy('name','ASC')->paginate(20)]);
            }
            return view('product',['product' => Product::orderBy('name','ASC')->paginate(20)]);
        }
    }

    public function form(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('product-add', ['title' => 'Tambah Produk', 'category' => Category::all()]);
        }
    }
    
    public function destroy(Request $request, $id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            try{
                $product = Product::find($id);
                $url_base = URL::to('/');
                $url_image = $product->images;
                $image_name = str_replace($url_base.'/uploads/products/','',$url_image);
    
                $product->delete();
    
                $path = public_path()."/uploads/products/".$image_name;
                unlink($path);
    
                return redirect()->back()->with('alert','Produk berhasil dihapus');
            }catch(\Exception $e){
                return redirect()->back()->with('alert-failed',$e->getMessage());
            }
        }
    }

    public function edit(Request $request, $id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            return view('product-edit',['product' => Product::where('id',$id)->first(), 
            'category' => Category::all()]);
        }
    }

    public function update(Request $request, $id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $product = Product::where('id',$id)->first();
            $desc = $request->description;
            $discount = $request->discount;
            if($discount == null){
                $discount = "";
            }
            if($desc == null){
                $desc = "";
            }
            try{
                if($request->has('images')){
                    $url = URL::to('/');
        
                    $url_image = $product->images;
                    $image_name = str_replace($url.'/uploads/products/','',$url_image);
                    $path = public_path()."/uploads/products/".$image_name;
                    unlink($path);
        
                    $image = $request->file('images');
                    $imagePath = $url.'/uploads/products/'.str::slug(rand()."_".time()).'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/products');
                    $image->move($destinationPath, $imagePath);
                
                    if($product->update(['name' => $request->name, 'category' => $request->category, 'price' => $request->price, 
                    'discount' => $discount, 'weight' => $request->weight, 'satuan' => $request->satuan, 'description' => $desc, 'images' => $imagePath])){
                        return redirect()->back()->with('alert','Perubahan berhasil disimpan'); 
                    }else{
                        return redirect()->back()->with('alert-failed','Terjadi kesalahan'); 
                    }
                }else{
                    if($product->update(['name' => $request->name, 'category' => $request->category, 'price' => $request->price, 
                    'discount' => $discount, 'weight' => $request->weight, 'satuan' => $request->satuan, 'description' => $desc, 'images' => $product->images])){
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
            $desc = $request->description;
            $discount = $request->discount;
            if($discount == null){
                $discount = "";
            }
            if($desc == null){
                $desc = "";
            }
            try{
                $product = new Product();
                $url = URL::to('/');

                $image = $request->file('images');
                $imagePath = $url.'/uploads/products/'.str::slug(rand()."_".time()).'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/products');
                
                $image->move($destinationPath, $imagePath);

                $product->name = $request->name;
                $product->category = $request->category;
                $product->price = $request->price;
                $product->discount = $discount;
                $product->weight = $request->weight;
                $product->satuan = $request->satuan;
                $product->description = $desc;
                $product->images = $imagePath;

                //for the future
                $product->stock = "";
                $product->tag = "";

                if($product->save()){
                    return redirect()->back()->with('alert',"Produk berhasil ditambahkan");
                }else{
                    return redirect()->back()->with('alert-failed',"Terjadi kesalahan");
                }

            }catch(\Exception $e){
                return redirect()->back()->with('alert-failed',$e->getMessage());
            }
        }
    }
}
