<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            if($request->has('q')){
                return view('user',['user' => Account::where('name','like',"%{$request->get('q')}%")
                ->orWhere('number','like',"%{$request->get('q')}%")->orderBy('name','ASC')->paginate(20)]);
            }else{
                return view('user',['user' => Account::orderBy('name','ASC')->paginate(20)]);
            }
        }
    }

    public function destroy(Request $request,$id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $account = Account::find($id);
            if($account->delete()){
                return redirect()->back()->with('alert','Pengguna berhasil dihapus');
            }else{
                return redirect()->back()->with('alert-failed','Pengguna berhasil dihapus');
            }
        }
    }
}
