<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Agenda;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Config;
use App\Models\Faq;
use App\Models\Material;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ApiController extends Controller
{
    public function account(Request $request){
        $account = Account::where('number',$request->get('number'))->first();
        if($account != null){
            return $account;
        }else{
            return ['response' => 'Akun tidak terdaftar', 'status_code' => 200];
        }
    }

    public function passwordUpdate(Request $request){
        $account = Account::where('number', $request->get('number'))->first();
        if($account->update(['password' => sha1($request->get('password')), 'security_question'=>null, 'security_answer'=>null])){
            return ['response' => 'Password berhasil diperbarui', 'status_code' => 200];
        }else{
            return ['response' => 'Terjadi kesalahan', 'status_code' => 404];
        }
    }

    public function addressUpdate(Request $request){
        $account = Account::where('number', $request->get('number'))->first();
        if($account->update(['address' => $request->get('address')])){
            return ['response' => 'Alamat berhasil diperbarui', 'status_code' => 200];
        }else{
            return ['response' => 'Terjadi kesalahan', 'status_code' => 404];
        }
    }

    public function accountUpdate(Request $request){
        $account = Account::where('number', $request->get('number'))->first();
        $imagePath = null;
        if($request->hasFile('part')){
            if($account->image != null){
                try{
                    $url_base = URL::to('/');
                    $url_image = $account->image;
                    $image_name = str_replace($url_base.'/uploads/pict/','',$url_image);
        
                    $path = public_path()."/uploads/pict/".$image_name;
                    unlink($path);
                    
                    $imagePath = $this->uploadImage($request);
                    if($imagePath == null){
                        return ['response' => 'Terjadi kesalahan', 'status_code' => 404];
                    }
                }catch(\Exception $e){
                    return ['response' => 'Terjadi kesalahan', 'status_code' => 404];
                }
            }else{
               $imagePath = $this->uploadImage($request);
               if($imagePath == null){
                return ['response' => 'Terjadi kesalahan', 'status_code' => 404];
               }
            }
        }
        if($account->update(['name'=>$request->get('name'),'address' => $request->get('address'),'image'=>$imagePath])){
            return ['response' => 'Profil berhasil diperbarui', 'status_code' => 200];
        }else{
            return ['response' => 'Terjadi kesalahan', 'status_code' => 404];
        }
    }

    public function uploadImage($request){
        try{
            $url = URL::to('/');
            $image = $request->file('part');
            $name = $url.'/uploads/pict/'.str::slug(rand()."_".time()."_".$request->get('bid')).'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/uploads/pict');
            
            $image->move($destinationPath, $name);
            return $name;
        }catch(\Exception $e){
            return null;
        }
    }

    public function securityUpdate(Request $request){
        $account = Account::where('number', $request->get('number'))->first();
        if($account->update(['security_question' => $request->get('question'), 'security_answer'=>$request->get('answer')])){
            return ['response' => 'Keamanan berhasil diperbarui', 'status_code' => 200];
        }else{
            return ['response' => 'Terjadi kesalahan', 'status_code' => 404];
        }
    }

    public function addTransaction(Request $request){
        $order = new Order();
        $config = Config::orderBy('id','DESC')->first();
        $lastorder = Order::orderBy('id','DESC')->first();
        if(is_null($lastorder)){
            $merchantRef = 'INV'.str_pad(1, 8, "0", STR_PAD_LEFT);
        }else{
            $merchantRef = 'INV'.str_pad($lastorder->id + 1, 8, "0", STR_PAD_LEFT);
        }
        $imagePath = "-";
        if($request->get('payment') == "Transfer"){
            try{
                $url = URL::to('/');
                $imagePath = null;
                if ($request->hasFile('part')) {
                    if(str_contains($url, '10.0.2.2')){
                        $url = str_replace("10.0.2.2", "localhost", $url);
                    }
    
                    $image = $request->file('part');
                    $name = $url.'/uploads/pict/'.str::slug(rand()."_".time()."_".$request->get('bid')).'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/uploads/pict');
                    
                    $image->move($destinationPath, $name);
                    $imagePath = $name;
    
                }else{
                    return ['response' => 'Terjadi kesalahan: images content!', 'status_code' => 404];
                }
            }catch(\Exception $e){
                return ['response' => 'Error when adding :'.$e->getMessage(), 'status_code' => 404];
            }
        }
        $order->bname = $request->get('bname');
        $order->bid = $request->get('bid');
        $order->pname = $this->validateStringArray($request->get('pname'));
        $order->amount = $this->validateStringArray($request->get('amount'));
        $order->pprice = $this->validateStringArray($request->get('pprice'));
        $order->status = "pending";
        $order->order_id = $merchantRef;
        $order->address = $request->get('address');
        $order->odate = $request->get('odate');
        $order->payment = $request->get('payment');
        $order->courier = $request->get('courier');
        $order->service = $request->get('service');
        $order->images = $imagePath;
        $order->nav = '0';
        $order->show = '1';
        $order->total = $request->get('total');

        if($config->wa_active == 1){
            if(strpos($config->wa_phone, ',') !== false){
                $numArray = explode(',',$config->wa_phone);
                for($i=0;$i<sizeof($numArray);$i++){
                    $this->sendNotification($config,$merchantRef,$numArray[$i]);
                }
            }else{
                $this->sendNotification($config,$merchantRef,$config->wa_phone);
            }
        }

        if($order->save()){
            return ['response' => 'Pesanan berhasil diantrikan', 'status_code' => 200];
        }else{
            return ['response' => 'Terjadi kesalahan', 'status_code' => 404];
        }
    }
    
    public function getRajaOngkir(Request $request){
        if($request->get('request') == 'province'){
            $url = "https://api.rajaongkir.com/starter/province";
        }else if($request->get('request') == 'city'){
            $province_id = $request->get('province_id');
            $url = "https://api.rajaongkir.com/starter/city?province=$province_id";
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: {$request->get('key')}"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);

        return !empty($err) ? $err : $response;
    }

    public function getOngkirCost(Request $request){
        $curl = curl_init();

        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS => "origin={$request->get('origin')}&destination={$request->get('destination')}&weight={$request->get('weight')}&courier={$request->get('courier')}",
        CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: {$request->get('key')}"
        ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        return !empty($err) ? $err : $response;
    }

    public function register(Request $request){
        $check = Account::where('number',$request->get('number'))->get();
        if($check->isEmpty()){
            $account = new Account();
            $account->name = $request->get('name');
            $account->number = $request->get('number');
            $account->password = sha1($request->get('password'));
            $account->address = $request->get('address');
            if($account->save()){
                return ['response' => 'Pendaftaran berhasil','security'=>false, 'status_code' => 200];
            }
        }else{
            return ['response' => 'Akun telah terdaftar', 'status_code' => 400];
        }
    }

    public function search(Request $request){
        if($request->get('by') == 'Search'){
            return Product::where('name','like',"%{$request->get('query')}%")->get();
        }else if($request->get('by') == 'Category'){
            return Product::where('category',$request->get('query'))->get();
        }
    }

    public function login(Request $request){
        $user = Account::where(['number' => $request->get('number'), 'password' => sha1($request->password)])->first();
        if($user == null){
            return ['response' => 'Akun tidak terdaftar','status_code' => 404];
        }else{
            return ['response' => 'Login berhasil','security'=>$user->security_answer!=null,'status_code' => 200];
        }
    }

    public function order_handler(Request $request){
        $order = Order::where('order_id',$request->get('id'))->first();
        if($request->get('method') == 'delete'){
            if($order->payment == "Transfer"){
                try{
                    $url_base = URL::to('/');
                    $url_image = $order->images;
                    $image_name = str_replace($url_base.'/uploads/pict/','',$url_image);
                    $path = public_path()."/uploads/pict/".$image_name;
                    unlink($path);
        
                    if($order->update(['show' => '0'])){
                        return ['response' => 'Berhasil menghapus riwayat','status_code' => 200];
                    }else{
                        return ['response' => 'Error when delete data!','status_code' => 404];
                    }
                }catch(\Exception $e){
                    return ['response' => 'Error when delete data: '.$e->getMessage(),'status_code' => 404];
                }
            }else{
                if($order->update(['show' => '0'])){
                    return ['response' => 'Berhasil menghapus riwayat','status_code' => 200];
                }else{
                    return ['response' => 'Error when delete data!','status_code' => 404];
                }
            }
        }else if($request->get('method') == 'done'){
            if($order->update(['status' => 'done'])){
                return ['response' => 'Konfirmasi berhasil','status_code' => 200];
            }else{
                return ['response' => 'Error when delete data!','status_code' => 404];
            }
        }
        
    }

    public function validateStringArray($string){
        if(substr($string, -1) == ','){
            return substr($string, 0, -1);
        }else{
            return $string;
        }
    }

    public function nav_order(Request $request){
        $user = Account::where('number',$request->get('number'))->first();
        return sizeof(Order::where(['bid'=>$user->id, 'nav'=>'0'])->get());
    }

    public function find_phone(Request $request){
        $user = Account::where('number',$request->get('number'))->first();
        if($user!=null){
            if($user->security_question == null){
                return ['success'=>false, 'response'=>'Pertanyaan keamanan tidak tersedia'];
            }else{
                return ['success'=>true, 'security_question'=>$user->security_question, 'security_answer'=>$user->security_answer];
            }
        }else{
            return ['success'=>false, 'response'=>'Nomor tidak terdaftar'];
        }
    }

    public function sendNotification($config,$invoice,$number){
        $curl = curl_init();
        $token = $config->wa_token;
        $data = [
            'phone' => $number,
            'message' => 'Pesanan baru masuk dengan nomor faktur '.$invoice. '. Segera periksa dan proses pesanan.',
            'secret' => false, // or true
            'priority' => true, // or true
        ];

        curl_setopt($curl, CURLOPT_HTTPHEADER,
            array(
                "Authorization: $token",
            )
        );
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_URL, $config->wa_url.'/api/send-message');
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $result = curl_exec($curl);
        curl_close($curl);
    }

    public function order(Request $request){
        $user = Account::where('number',$request->get('number'))->first();
        Order::where(['bid'=>$user->id, 'nav'=>'0'])->update(['nav'=>'1']);
        return Order::where(['bid'=>$user->id, 'show'=>'1'])->orderBy('id','DESC')->get();
    }

    public function product(){
        return Product::orderBy('id','DESC')->limit(20)->get();
    }

    public function faq(){
        return Faq::all();
    }

    public function category(){
        return Category::all();
    }

    public function banner(){
        return Banner::all();
    }

    public function agenda(){
        return Agenda::orderBy('id','DESC')->get();
    }

    public function search_agenda(Request $request){
        return Agenda::where('name','like',"%{$request->get('query')}%")
        ->orWhere('date','like',"%{$request->get('query')}%")
        ->orWhere('time','like',"%{$request->get('query')}%")
        ->orWhere('location','like',"%{$request->get('query')}%")
        ->orderBy('id','DESC')->get();
    }

    public function material(){
        return Material::orderBy('id','DESC')->get();
    }

    public function search_material(Request $request){
        return Material::where('title','like',"%{$request->get('query')}%")
        ->orderBy('id','DESC')->get();
    }
}
