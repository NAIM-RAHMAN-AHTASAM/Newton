<?php
function total_cart_products(){
  echo App\Cart::where('ip_address',request()->ip())->count();
}
function cart_products(){
  return App\Cart::where('ip_address',request()->ip())->get();
}
function cart_subtotal(){
  $total_price =0;
  foreach (cart_products() as $cart_product) {
        $total_price =  $total_price + ( $cart_product->product_amount *App\product::find($cart_product->product_id)->product_price);

  }
  return $total_price;
}





function review_star_amount($product_id){



if (!App\order_list::where('product_id',$product_id)->exists())
   {
        return 0;
   }

// elseif (App\order_list::where('product_id',$product_id)->whereNull('star'))
//      {
//         return 0;
//      }

else
     {
     $star_amount = (App\order_list::where('product_id',$product_id)->whereNotNull('star')->sum('star'))/(App\order_list::where('product_id',$product_id)->whereNotNull('star')->count('star'));
     return ceil ($star_amount);

     }





//
// echo App\order_list::where('product_id',$product_id)->whereNotNull('star')->sum('star');
// echo App\order_list::where('product_id',$product_id)->whereNotNull('star')->count();
//
// $star_amount =(App\order_list::where('product_id',$product_id)->whereNotNull('star')->sum('star'))/(App\order_list::where('product_id',$product_id)->whereNotNull('star')->count());
//  return ceil ($star_amount);

 }


 ?>
