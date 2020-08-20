@extends('layouts.frontend')


@section('content')

  <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="breadcumb-wrap text-center">
                         <h2>Shopping Cart</h2>
                         <ul>
                             <li><a href="index.html">Home</a></li>
                             <li><span>Shopping Cart</span></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- .breadcumb-area end -->
     <!-- cart-area start -->
     <div class="cart-area ptb-100">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                   @if ($errors->all())
                     <div class="alert alert-danger">
                       @foreach ($errors->all() as $error)
                         <li>{{ $error }}</li>
                       @endforeach
                     </div>
                   @endif
                     <form action="{{ url('update/cart') }}" method="post">
                       @csrf
                         <table class="table-responsive cart-wrap">
                             <thead>
                                 <tr>
                                     <th class="images">Image</th>
                                     <th class="product">Product</th>
                                     <th class="ptice">Price</th>
                                     <th class="quantity">Quantity</th>
                                     <th class="total">Total</th>
                                     <th class="remove">Remove</th>
                                 </tr>
                             </thead>
                             <tbody>
                               @foreach (cart_products() as $cart_product)

                                 <tr>
                                     <td class="images"><img src="{{ asset('uploads\product_thumbnail') }}/{{ $cart_product->relationBetweenProduct->product_thumbnail_image }}" alt=""></td>
                                     <td class="product"><a href="{{url('product')}}/{{ $cart_product->relationBetweenProduct->product_slug }}"target="_blank">{{ $cart_product->relationBetweenProduct->product_name }}</a></td>
                                     <td class="ptice">${{ $cart_product->relationBetweenProduct->product_price }}</td>
                                     <input type="hidden" value="{{ $cart_product->id}}" name="cart_id[]" />
                                     <td class="quantity cart-plus-minus">
                                         <input type="text" value="{{ $cart_product->product_amount}}" name="product_amount[]" />

                                     </td>
                                     <td class="total">${{ $cart_product->relationBetweenProduct->product_price * $cart_product->product_amount }}</td>
                                     <td class="remove">
                                       <a href="{{ url('delete/from/cart') }}/{{ $cart_product->id }}"> <i class="fa fa-times"></i></a>

                                     </td>
                                 </tr>

                               @endforeach

                             </tbody>
                         </table>
                         <div class="row mt-60">
                             <div class="col-xl-4 col-lg-5 col-md-6 ">
                                 <div class="cartcupon-wrap">
                                     <ul class="d-flex">
                                         <li>

                                           <button type="submit" class="btn btn-danger">Update Cart</button>
                                              </form>
                                         </li>

                                         <li>  <a href="{{ url('/') }}" class="btn btn-danger">Continue Shopping</a></li>
                                     </ul>
                                     <h3>Cupon</h3>
                                     <p>Enter Your Cupon Code if You Have One</p>
                                     <div>
                                         <input type="text" placeholder="Cupon Code" id="coupon_text" value="{{ $coupon_name ?? '' }}">
                                         <a class="btn btn-danger" id="coupon_btn">Apply Cupon</a>

                                     </div>


                                 </div>
                             </div>
                             <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                 <div class="cart-total text-right">
                                     <h3>Cart Totals</h3>
                                     <ul>
                                         <li><span class="pull-left">Subtotal </span>$ {{cart_subtotal()}}</li>
                                         <li><span class="pull-left"> Coupon Discount </span> {{ $discount_amount ?? '00'}} %</li>
                                         <li><span class="pull-left"> Total</span>
                                           @isset($discount_amount)
                                             ${{$total_form_cart = (cart_subtotal()-(( $discount_amount * cart_subtotal())/ 100))}}
                                             @else
                                               {{ $total_form_cart = cart_subtotal()  }}
                                           @endisset
                                         </li>
                                     </ul>
                                     <form  action="{{ url('checkout') }}" method="post">
                                       @csrf
                                       <input type="hidden" name="coupon_name_from_cart" value="{{ $coupon_name ?? '' }}">
                                       <input type="hidden" name="total_form_cart" value="{{$total_form_cart}}">
                                       <button type="submit"class="btn btn-danger">Proceed to Checkout</button>
                                     </form>
                                 </div>
                             </div>
                         </div>

                 </div>
             </div>
         </div>
     </div>
     <!-- cart-area end -->

@endsection


@section('footer_scripts')
  <script type="text/javascript">
      $(document).ready(function(){
        $('#coupon_btn').click(function(){
          var coupon_text = $('#coupon_text').val();
          var link_to_go = "{{ url('view/cart/page') }}/"+coupon_text;
          window.location.href = link_to_go;



    });
  });


  </script>

@endsection
