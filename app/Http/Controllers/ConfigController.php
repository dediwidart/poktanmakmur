<?php

namespace App\Http\Controllers;

use App\Models\Config;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index(){
        return view('config', ['config'=>Config::orderBy('id','DESC')->first()]);
    }

    public function update(Request $request){
        $validate = $this->isValidate($request);
        if($validate['valid'] == true){
            $config = Config::orderBy('id','DESC')->first();
            $config->app_name = $request->get('app_name');
            $config->admin_username = $request->get('admin_username');
            $config->admin_password = $request->get('admin_password');
            $config->wa_active = $this->isActive($request);
            $config->wa_token = $request->get('weblas_token');
            $config->wa_url = $request->get('weblas_url');
            $config->wa_phone = $request->get('number_receiver');
            if($config->update()){
                return redirect()->back()->with('alert','Perubahan berhasil disimpan'); 
            }else{
                return redirect()->back()->with('alert-failed','Terjadi kesalahan'); 
            }
        }else{
            return redirect()->back()->with('alert-failed',$validate['response']);
        }
    }

    public function isActive($request){
        if($request->has('weblas')){
            return 1;
        }else{
            return 0;
        }
    }

    public function isValidate($request){
        if($request->has('weblas')){
            if($request->get('weblas_url') != null 
                    && $request->get('weblas_token') != null 
                    && $request->get('number_receiver') != null
                    && $request->get('app_name') != null 
                    && $request->get('admin_username') != null 
                    && $request->get('admin_password') != null){
                if(strpos($request->get('weblas_url'), 'http://') !== false
                    || strpos($request->get('weblas_url'), 'https://') !== false){
                        if(substr($request->get('weblas_url'),-1) == '/'){
                            return ['valid'=>false, 'response'=>'Url tidak sesuai format (Karakter terakhir tidak boleh mengandung /)'];
                        }else{
                            return ['valid'=>true];
                        }
                }else{
                    return ['valid'=>false, 'response'=>'Url tidak sesuai format (Tidak ditemukan http:// atau https://)'];;
                }
            }else{
                return ['valid'=>false, 'response'=>'Field tidak boleh kosong'];
            }
        }else{
            if($request->get('app_name') != null && $request->get('admin_username') != null 
                && $request->get('admin_password') != null){
                    return ['valid'=>true];
            }else{
                return ['valid'=>false, 'response'=>'Field tidak boleh kosong'];
            }
        }
        
    }
}
