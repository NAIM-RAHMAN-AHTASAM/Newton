<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Cart;
use App\Coupon;
use App\product;
use DB;

class CartController extends Controller
{
  function  viewcartpage($coupon_name = ""){
    if ($coupon_name) {
      if (Coupon::where('coupon_name',$coupon_name)->exists()) {
        if (Coupon::where('coupon_name',$coupon_name)->first()->coupon_validity>=Carbon::now()->format('Y-m-d')) {
        $discount_amount = Coupon::where('coupon_name',$coupon_name)->first()->coupon_discount;
        return view ('frontend.cart',[
          'discount_amount' => $discount_amount,
          'coupon_name' => $coupon_name,
        ]);

        }
        else {

          return redirect('view/cart/page')->withErrors('coupon date over');

        }
      }
      else {

        return redirect('view/cart/page')->withErrors('You provide an invalid Coupon');
      }
    }
    else {
          return view ('frontend.cart');
    }


  }






function addtocart(Request $request){
  if (Cart::where('ip_address',$request->ip())->where('product_id',$request->product_id)->exists()) {
    $stock = product::where('id',$request->product_id)->first();
    if($stock->product_quantity < $request->product_amount){
      return back()->with('stock_Msg','Stock is not enough');
    }
    Cart::where('ip_address',$request->ip())->where('product_id',$request->product_id)->increment('product_amount',$request->product_amount);
  }
    else{
      $stock = product::where('id',$request->product_id)->first();
      if($stock->product_quantity < $request->product_amount){
        return back()->with('stock_Msg','Stock is not enough');
      }

    DB::table('carts')->insert([
      'ip_address'=>$request->ip(),
      'product_id'=>$request->product_id,
      'product_amount'=>$request->product_amount,
      'created_at'=>Carbon::now(),
    ]);
  }
return back()->with('cart_status','product added to cart!');
}




function deletefromcart($cart_id){

  Cart::find($cart_id)->delete();
  return back()->with('deletestatus','Deleted successfully');

}





function  updatecart (Request $request){

  foreach ($request->cart_id as $key => $id) {

    Cart::find($id)->update([
      'product_amount'=>$request->product_amount[$key]
    ]);
  }
  return back();

}



}
