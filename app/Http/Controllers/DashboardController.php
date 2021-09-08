<?php

namespace App\Http\Controllers;

use App\Models\Config;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index(Request $request){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect(url('/login'));
        }else{
            $order_lastest = Order::orderBy('id','DESC')->limit(7)->get();
            $order_pending = Order::where('status','pending')->get();
            $order_sended = Order::where('status','sended')->get();
            $order_done = Order::where('status','done')->get();
            $order_cancel = Order::where('status','done')->get();
            $product = Product::orderBy('id','DESC')->limit(6)->get();
            return view('dashboard',['title' => 'Dashboard','order_lastest' => $order_lastest,
                'product' => $product,'order_pending' => $order_pending,'order_sended' => $order_sended,
                'order_done' => $order_done,'order_cancel' => $order_cancel]);
        }
    }

    public function login(Request $request){
        $config = Config::orderBy('id','DESC')->first();
        $pass = Hash::make($config->admin_password);
        if($request->get('username') == $config->admin_username 
            && Hash::check($request->get('password'), $pass)){
            $request->session()->put('session',true);
            return redirect(url('/dashboard'));
        }else{
            return redirect()->back();
        }
    }

    public function logout(Request $request){
        $request->session()->forget('session');
        return redirect(url('/login'));
    }
}
