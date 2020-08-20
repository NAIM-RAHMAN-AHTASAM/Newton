<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\order;
use App\order_list;
use Auth;
use PDF;
use Carbon\Carbon;

class CustomerController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');//login varified check
      $this->middleware('verified');//email_verified check
      $this->middleware('checkrolecustomer');//checkrole check
  }




  function homecustomer(){
    $customer_order = order::where('user_id',Auth::id())->get();
    return view('admin.customer.home',compact('customer_order'));

  }
   function orderdownload($order_id){
     // echo $order_id;
     $order_info = order::findOrFail($order_id);
     $order_pdf = PDF::loadView('admin.customer.download.order', compact('order_info'));
     $daynamic_name ="order-".$order_info->id.'-'.Carbon::now()->format('d-m-Y').'-'.".pdf";
     return $order_pdf->download($daynamic_name);

   }
    function sendsms($order_id){
     $order_info = order::findOrFail($order_id);
     // SMS gateway start
     $url = "http://66.45.237.70/api.php";
$number=" $order_info->phone_number";
$text="Hello Your Order id:".$order_info->id.".Tatal payment Done:".$order_info->total;
$data= array(
'username'=>"01620614803",
'password'=>"G5TDV2MY",
'number'=>"$number",
'message'=>"$text"
);

$ch = curl_init(); // Initialize cURL
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$smsresult = curl_exec($ch);
$p = explode("|",$smsresult);
$sendstatus = $p[0];
if ($sendstatus=1101) {
  echo "SMS SEND SUCCESSFULLY";
  }

// SMS gateway end



    }

    function addreview(Request $request){

      order_list::where('user_id',Auth::id())->where('product_id',$request->product_id)->whereNull('review')->first()->update([
        'review'=>$request->review,
        'star'=>$request->star,

      ]);

        // return back();
    }


    // function totalreview(){
    //   $total_review = order_list::where('product_id',$product_info->id)->whereNotNull('review')->count();
    //
    //   // return view('admin.customer.home',compact('total_review'));
    //
    // }

}
