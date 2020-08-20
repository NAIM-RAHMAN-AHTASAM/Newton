@extends('layouts.frontend')

@section('about')
active
@endsection
@section('content')


  <!-- checkout-area start -->
     <div class="checkout-area ptb-100">
         <div class="container">
             <div class="row">
                 <div class="col-lg-8">
                     <div class="checkout-form form-style">
                         <h3>Billing Details</h3>



                         <form action="{{ url('checkout/post') }}" method="post">
                           @csrf
                           <small>Your are logged in as: {{ Auth::User()->name }}</small>
                             <div class="row">

                                 <div class="col-12">
                                     <p>Full Name *</p>
                                     <input type="text" value="{{ Auth::User()->name }}" name="full_name">
                                 </div>
                                 <div class="col-sm-6 col-12">
                                     <p>Email Address *</p>
                                     <input type="email" value="{{ Auth::User()->email }}"name="email_address">
                                 </div>
                                 <div class="col-sm-6 col-12">
                                     <p>Phone No. *</p>
                                     <input type="text" name="phone_number">
                                 </div>


                                 <div class="col-sm-6 col-12">
                                     <p>Country *</p>
                                     <select class="" name="country_id"  id="country_list">
                                       <option value="">select one</option>
                                       @foreach ($countries as $country)

                                         <option value="{{$country->id}}">{{$country->country_name}}</option>
                                       @endforeach

                                     </select>

                                 </div>
                                 <div class="col-sm-6 col-12">
                                     <p>Town/City *</p>
                                     <select class="" name="city_id" id="city_list">
                                       <option value="">select one</option>
                                       

                                          </select>

                                 </div>

                                 <div class="col-12">
                                     <p>Your Address *</p>
                                     <input type="text"name="address">
                                 </div>

                                 <div class="col-12">
                                     <p>Order Notes </p>
                                     <textarea name="note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                 </div>
                             </div>

                     </div>
                 </div>
                 <div class="col-lg-4">
                     <div class="order-area">
                         <h3>Your Order</h3>
                         <ul class="total-cost">
                          @foreach ( cart_products() as $cart_product)

                            <li>  {{ $cart_product->relationBetweenProduct->product_name }} <span class="pull-right">${{ $cart_product->relationBetweenProduct->product_price * $cart_product->product_amount}}</span></li>
                          @endforeach
                          <input type="hidden" name="sub_total" value="{{cart_subtotal()}}">
                          <input type="hidden" name="total" value="{{ $total_form_cart }}">
                          <input type="hidden" name="coupon_name" value="{{$coupon_name_from_cart ?? ""}}">
                          <li>Coupon <span class="pull-right"><strong>{{$coupon_name_from_cart ?? "No Coupon"}}</strong></span></li>
                             <li>Subtotal <span class="pull-right"><strong>${{cart_subtotal()}}</strong></span></li>


                             <li>Total<span class="pull-right">${{ $total_form_cart }}</span></li>
                         </ul>
                         <ul class="payment-method">

                             <li>
                               <li>
                                   <input id="delivery" type="radio" name="payment_method" value="1" checked>
                                   <label for="delivery">Cash on Delivery</label>
                               </li>
                                 <input id="card" type="radio" name="payment_method" value="2" >
                                 <label for="card">Credit Card/paypal</label>
                             </li>
                         </ul>
                         <button type="submit">Place Order</button>
                          </form>

                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- checkout-area end -->

     @section('footer_scripts')
       <script type="text/javascript">
       $(document). ready(function(){
      $('#country_list').change(function(){
        var country_id = $(this).val();

        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
            });
            // ajax request
            $.ajax({
              type:'POST',
              url:'/get/city/list',
              data:{country_id:country_id},
              success:function(data){
                // alert(data);
                $('#city_list').html(data);
              }
            });
          });
       });

       </script>

      @endsection



@endsection
