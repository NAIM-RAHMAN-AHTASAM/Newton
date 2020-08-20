@extends('layouts.frontend')

@section('shop')
active
@endsection
@section('content')



  <!-- .breadcumb-area start -->
   <div class="breadcumb-area bg-img-4 ptb-100">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="breadcumb-wrap text-center">
                       <h2>Shop Page</h2>
                       <ul>
                           <li><a href="index.html">Home</a></li>
                           <li><span>Shop</span></li>
                       </ul>
                   </div>
               </div>
           </div>
       </div>
   </div>
   <!-- .breadcumb-area end -->
   <!-- product-area start -->
   <div class="product-area pt-100">
       <div class="container">
           <div class="row">
               <div class="col-sm-12 col-lg-12">
                   <div class="product-menu">
                       <ul class="nav justify-content-center">
                           <li>
                               <a class="active" data-toggle="tab" href="#all">All product</a>
                           </li>
                           @foreach ($categories as $category)
                             <li>
                                 <a  data-toggle="tab" href="#category_id_{{ $category->id }}">{{$category->category_name}}</a>
                             </li>
                           @endforeach


                       </ul>
                   </div>
               </div>
           </div>
           <div class="tab-content">
               <div class="tab-pane active" id="all">
                   <ul class="row">
                     @php
                   $flag = 1;
                 @endphp
                  @foreach ($products as $product)
                    <li class="col-xl-3 col-lg-4 col-sm-6 col-12 {{ ($flag > 4) ? 'moreload' : '' }}">
                           <div class="product-wrap">
                               <div class="product-img">
                                   <span>Sale</span>
                                   <img src="{{ asset('uploads/product_thumbnail') }}/{{ $product->product_thumbnail_image }}" alt="">
                                   <div class="product-icon flex-style">
                                       <ul>
                                           <li><a data-toggle="modal" data-target="#exampleModalCenter{{ $product->id }}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                           <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                           <li><a href="{{url('view/cart/page')}}"><i class="fa fa-shopping-bag"></i></a></li>
                                       </ul>
                                   </div>
                               </div>
                               <div class="product-content">
                                   <h3><a href="{{ route('product.show', $product->product_slug) }}">{{ $product->product_name }}</a></h3>
                                   <p class="pull-left">${{$product->product_price}}

                                   </p>
                                   <ul class="pull-right d-flex">


                                                                    @if (review_star_amount($product->id)== 1)

                                                                      <li><i class="fa fa-star"></i></li>

                                                                    @elseif (review_star_amount($product->id) == 2)

                                                                      <li><i class="fa fa-star"></i></li>
                                                                      <li><i class="fa fa-star"></i></li>

                                                                     @elseif (review_star_amount($product->id) == 3)

                                                                      <li><i class="fa fa-star"></i></li>
                                                                      <li><i class="fa fa-star"></i></li>
                                                                      <li><i class="fa fa-star"></i></li>

                                                                    @elseif (review_star_amount($product->id) == 4)

                                                                      <li><i class="fa fa-star"></i></li>
                                                                      <li><i class="fa fa-star"></i></li>
                                                                      <li><i class="fa fa-star"></i></li>
                                                                      <li><i class="fa fa-star"></i></li>

                                                                  @elseif (review_star_amount($product->id) == 5)

                                                                      <li><i class="fa fa-star"></i></li>
                                                                      <li><i class="fa fa-star"></i></li>
                                                                      <li><i class="fa fa-star"></i></li>
                                                                      <li><i class="fa fa-star"></i></li>
                                                                      <li><i class="fa fa-star"></i></li>
                                                                    @else
                                                                      <li>No Review Yet!!</li>


                                                                    @endif



                                   </ul>
                               </div>
                           </div>
                       </li>
                       @php
                         $flag++;
                       @endphp







                       <!-- Modal area start -->
                       <div class="modal fade" id="exampleModalCenter{{$product->id}}" tabindex="-1">
                           <div class="modal-dialog modal-dialog-centered">
                               <div class="modal-content">
                                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                       <span aria-hidden="true">&times;</span>
                                   </button>
                                   <div class="modal-body d-flex">
                                       <div class="product-single-img w-50">
                                           <img src="{{ asset('uploads/product_thumbnail') }}/{{ $product->product_thumbnail_image }}" alt="">
                                       </div>
                                       <div class="product-single-content w-50">
                                           <h3>{{ $product->product_name }}</h3>
                                           <div class="rating-wrap fix">
                                               <span class="pull-left">${{ $product->product_price }}</span>
                                               <ul class="rating pull-right">
                                                 <ul class="rating pull-right">
                                                   @if (review_star_amount($product->id)==1)

                                                     <li><i class="fa fa-star"></i></li>

                                                   @elseif (review_star_amount($product->id)==2)

                                                     <li><i class="fa fa-star"></i></li>
                                                     <li><i class="fa fa-star"></i></li>

                                                    @elseif (review_star_amount($product->id)==3)

                                                     <li><i class="fa fa-star"></i></li>
                                                     <li><i class="fa fa-star"></i></li>
                                                     <li><i class="fa fa-star"></i></li>

                                                   @elseif (review_star_amount($product->id)==4)

                                                     <li><i class="fa fa-star"></i></li>
                                                     <li><i class="fa fa-star"></i></li>
                                                     <li><i class="fa fa-star"></i></li>
                                                     <li><i class="fa fa-star"></i></li>

                                                 @elseif (review_star_amount($product->id)==5)

                                                     <li><i class="fa fa-star"></i></li>
                                                     <li><i class="fa fa-star"></i></li>
                                                     <li><i class="fa fa-star"></i></li>
                                                     <li><i class="fa fa-star"></i></li>
                                                     <li><i class="fa fa-star"></i></li>
                                                   @else
                                                     <li>No Review Yet</li>


                                                   @endif

                                                   <li>({{App\order_list::where('product_id',$product->id)->whereNotNull('review')->count()}} Customar Review)</li>
                                               </ul>
                                           </div>
                                           <p>{{ $product->product_short_description }}</p>
                                           {{-- <ul class="input-style">
                                               <li class="quantity cart-plus-minus">
                                                   <input type="text" value="1" />
                                               </li>
                                               <li><a href="{{url('view/cart/page')}}">Add to Cart</a></li>
                                           </ul> --}}




                                           <ul class="input-style">
                                             <form class="" action="{{ url('add/to/cart') }}" method="post">
                                               @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                               <li class="quantity cart-plus-minus">

                                                   <input type="text" value="1"name="product_amount" />
                                               </li>
                                               <li><button type="submit" class="btn btn-danger"> Add to Cart</button></li>
                                             </form>
                                           </ul>









                                           <ul class="cetagory">
                                               <li>Categories:</li>

                                               <li><a href="#">{{ App\category::find($product->category_id)->category_name }}</a></li>

                                           </ul>
                                           <ul class="socil-icon">
                                               <li>Share :</li>
                                               <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                               <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                               <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                               <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                               <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                           </ul>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                       <!-- Modal area end -->







                  @endforeach
                  <li class="col-12 text-center">
                           <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                       </li>
                   </ul>
               </div>
               @foreach ($categories as $category)

                 <div class="tab-pane" id="category_id_{{ $category->id }}">
                   <ul class="row">
                     @foreach ($category->connect_to_priduct_table as $category_wise_product)

                       <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                           <div class="product-wrap">
                               <div class="product-img">
                                   <span>Sale</span>
                                   <img src="{{ asset('uploads/product_thumbnail') }}/{{ $category_wise_product->product_thumbnail_image }}" alt="">
                                   <div class="product-icon flex-style">
                                       <ul>
                                           <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                           <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                           <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                                       </ul>
                                   </div>
                               </div>
                               <div class="product-content">

                                   <h3><a href="single-product.html">{{ $category_wise_product->product_name }}</a></h3>
                                   <p class="pull-left">${{ $category_wise_product->product_price }}

                                   </p>
                                   <ul class="pull-right d-flex">



                                     @if (review_star_amount($category_wise_product->id)== 1)

                                       <li><i class="fa fa-star"></i></li>

                                     @elseif (review_star_amount($category_wise_product->id) == 2)

                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>

                                      @elseif (review_star_amount($category_wise_product->id) == 3)

                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>

                                     @elseif (review_star_amount($category_wise_product->id) == 4)

                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>

                                   @elseif (review_star_amount($category_wise_product->id) == 5)

                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                       <li><i class="fa fa-star"></i></li>
                                     @else
                                       <li>No Review Yet!!</li>


                                     @endif


                                   </ul>
                               </div>
                           </div>
                       </li>
                     @endforeach

                   </ul>
               </div>
               @endforeach


           </div>
       </div>
   </div>
   <!-- product-area end -->
@endsection
