<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\order_list;
use App\Cart;
use App\product;
use App\Country;
use App\City;
use Auth;
use Carbon\Carbon;
class CheckoutController extends Controller
{

  public function __construct()
  {
      $this->middleware('auth');//login varified check
      // $this->middleware('verified');//email_verified check
      // $this->middleware('CheckRole')->except(['edit_profile','change_password']);
  }

function index(Request $request){

return view('frontend.checkout',[
  'total_form_cart'=>$request->total_form_cart,
  'coupon_name_from_cart'=>$request->coupon_name_from_cart,
  'countries'=>Country::all(),
  'cities'=>City::all(),

]);
}
function checkoutpost(Request $request){

  if ($request->payment_method==1) {

    // print_r($request->except('_token')+[
    //   'user_id'=>Auth::id(),
    //   'created_at'=>Carbon::now(),
    // ]);

    $order_id=Order::insertGetId($request->except('_token')+[
      'user_id'=>Auth::id(),
      'created_at'=>Carbon::now(),
    ]);

    foreach (cart_products() as $cart_product) {

    order_list::insert([

    'order_id'=>$order_id,
    'user_id'=>Auth::id(),
    'product_id'=>$cart_product->product_id,
    'product_amount'=>$cart_product->product_amount,
    'created_at'=>Carbon::now(),
    ]);
    product::find($cart_product->product_id)->decrement('product_quantity',$cart_product->product_amount);
    Cart::find($cart_product->id)->delete();
    }
    return redirect('/');
  }
  else {
  
  return view('frontend.onlinepayment',[
    'full_name'=>$request->full_name,
    'email_address'=>$request->email_address,
    'phone_number'=>$request->phone_number,
    'country_id'=>$request->country_id,
    'city_id'=>$request->city_id,
    'address'=>$request->address,
    'note'=>$request->note,
    'sub_total'=>$request->sub_total,
    'total'=>$request->total,
    'coupon_name'=>$request->coupon_name,
  ]);

  }

}


function getcitylist(Request $request){
$dropdown_to_send = "";

$cities =  City::where('country_id',$request->country_id)->get();
foreach ($cities as $city) {
  $dropdown_to_send .="<option value='".$city->id."'>".$city->city_name."</option>";
}
echo $dropdown_to_send;
}


}
