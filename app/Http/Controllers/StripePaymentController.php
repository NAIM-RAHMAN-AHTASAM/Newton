<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe;
use App\Order;
use Auth;
use App\order_list;
use App\product;
use App\Cart;
use Carbon\Carbon;
class StripePaymentController extends Controller
{


  /**
       * success response method.
       *
       * @return \Illuminate\Http\Response
       */
      public function stripe()
      {
          return view('stripe');
      }

      /**
       * success response method.
       *
       * @return \Illuminate\Http\Response
       */
      public function stripePost(Request $request)
      {
          Stripe\Stripe::setApiKey('sk_test_XiBZ4FFZuqG0Byz9IOhP6fGc00tKipR5My');
          Stripe\Charge::create ([
                  "amount" => $request->total * 100,
                  "currency" => "usd",
                  "source" => $request->stripeToken,
                  "description" => "Test Amount from Newton"
          ]);
          // order table   insert 2nd way
          $order_id=Order::insertGetId([
            'user_id'=>Auth::id(),
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
            'payment_method'=>2,
            'paid_status'=>2,
            'created_at'=>carbon::now(),
          ]);
          // order list table insert
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
          return redirect('/')->with('successstatus', 'Your payment successfully Done!!');


      }
}
