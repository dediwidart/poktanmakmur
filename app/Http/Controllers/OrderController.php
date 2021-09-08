<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request,$status){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            if($status == "pending"){
                $requestStatus = "Pesanan Pending";
            }else if($status == "sended"){
                $requestStatus = "Pesanan Dikirim";
            }else if($status == "done"){
                $requestStatus = "Pesanan Selesai";
            }else if($status == "cancel"){
                $requestStatus = "Pesanan Dibatalkan";
            }
            return view('order', ['order' => Order::where('status',$status)->orderBy('id','DESC')->paginate(20), 'request'=>$requestStatus]);
        }
    }

    public function detail(Request $request, $id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            $order = Order::where('id',$id)->first();
            return view('order-detail', ['order' => $order,
            'account' => Account::where('id',$order->bid)->first()]);
        }
    }

    public function send(Request $request, $id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            try{
                $order = Order::where('id',$id)->first();
                if($order->update(['status' => 'sended', 'nav'=>'0'])){
                    return redirect()->back()->with('alert','Pesanan berhasil dikirim');
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-failed',$e->getMessage());
            }
        }
    }

    public function cancel(Request $request, $id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            try{
                $order = Order::where('id',$id)->first();
                if($order->update(['status' => 'cancel', 'nav'=>'0'])){
                    return redirect()->back()->with('alert','Pesanan berhasil dibatalkan');
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-failed',$e->getMessage());
            }
        }
    }

    public function end(Request $request, $id){
        $value = $request->session()->get('session',null);
        if($value == null){
            return redirect('/login');
        }else{
            try{
                $order = Order::where('id',$id)->first();
                if($order->update(['status' => 'done'])){
                    return redirect()->back()->with('alert','Pesanan berhasil diselesaikan');
                }
            }catch(\Exception $e){
                return redirect()->back()->with('alert-failed',$e->getMessage());
            }
        }
    }
}
