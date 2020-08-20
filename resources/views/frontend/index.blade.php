 @php
  error_reporting(0);
@endphp
@extends('layouts.frontend')
  @section('home')
   active
  @endsection


  @section('content')





    <!-- slider-area start -->
    <div class="slider-area">
        <div class="swiper-container">
          @if (session('successstatus'))
        <div class="alert alert-success">
            {{ session('successstatus') }}
              </div>
            @endif
            <div class="swiper-wrapper">
              @forelse($banners as $banner)
                <div class="swiper-slide overlay">
                    <div class="single-slider slide-inner slide-inner1" style="  background: url({{ asset('uploads/banner') }}/{{ $banner->banner_image }});">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-12 col-lg-9 col-12">
                                    <div class="slider-content">
                                        <div class="slider-shape">
                                            <h2 data-swiper-parallax="-500">{{$banner->banner_title}}</h2>
                                            <p data-swiper-parallax="-400">{{ $banner->banner_description }}</p>
                                            <a href="{{ route('shop', $banner->product_slug) }}" data-swiper-parallax="-300">Shop Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              @endforeach

            </div>
            {{-- <div class="swiper-pagination"></div> --}}
        </div>
    </div>
    <!-- slider-area end -->




    @include('frontend.frontend_includes.category',['categories'=>$categories])

    <!-- start count-down-section -->
    <div class="count-down-area count-down-area-sub">
        <section class="count-down-section section-padding parallax" data-speed="7">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-12 text-center">
                        <h2 class="big">Deal Of the Day <span>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin</span></h2>
                    </div>
                    <div class="col-12 col-lg-12 text-center">
                        <div class="count-down-clock text-center">
                            <div id="clock">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
    </div>
    <!-- end count-down-section -->
    <!-- product-area start -->
    <div class="product-area product-area-2">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Best Seller</h2>
                        <img src="assets/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
            <ul class="row">
              @foreach ($best_salling_products as $best_salling_product)

                <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="product-wrap">
                        <div class="product-img">
                            <img src="{{ asset('uploads/product_thumbnail') }}/{{  App\product::find($best_salling_product->product_id)->product_thumbnail_image }}" alt="">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a data-toggle="modal" data-target="#exampleModalCenter{{ App\product::find($best_salling_product->product_id)->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                    {{-- <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li> --}}
                                    <li><a href="{{url('view/cart/page')}}"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{ route('product.show', App\product::find($best_salling_product->product_id)->product_slug) }}">{{ App\product::find($best_salling_product->product_id)->product_name }}</a></h3>
                            {{-- {{ App\product::find($best_salling_product->product_id)->product_name }} --}}
                            <p class="pull-left">${{ App\product::find($best_salling_product->product_id)->product_price }}
                            </p>
                            <ul class="pull-right d-flex">


                                                             @if (review_star_amount( App\product::find($best_salling_product->product_id)->id)== 1)

                                                               <li><i class="fa fa-star"></i></li>

                                                             @elseif (review_star_amount(App\product::find($best_salling_product->product_id)->id) == 2)

                                                               <li><i class="fa fa-star"></i></li>
                                                               <li><i class="fa fa-star"></i></li>

                                                              @elseif (review_star_amount(App\product::find($best_salling_product->product_id)->id) == 3)

                                                               <li><i class="fa fa-star"></i></li>
                                                               <li><i class="fa fa-star"></i></li>
                                                               <li><i class="fa fa-star"></i></li>

                                                             @elseif (review_star_amount(App\product::find($best_salling_product->product_id)->id) == 4)

                                                               <li><i class="fa fa-star"></i></li>
                                                               <li><i class="fa fa-star"></i></li>
                                                               <li><i class="fa fa-star"></i></li>
                                                               <li><i class="fa fa-star"></i></li>

                                                           @elseif (review_star_amount(App\product::find($best_salling_product->product_id)->id) == 5)

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
    </div>
    <!-- product-area end -->
    <!-- product-area start -->
    <div class="product-area">
        <div class="fluid-container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Our Latest Product</h2>
                        <img src="assets/images/section-title.png" alt="">
                    </div>
                </div>
            </div>
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
                                <li><a data-toggle="modal" data-target="#exampleModalCenter{{$product->id}}" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                {{-- <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li> --}}
                                <li><a href="{{url('view/cart/page')}}"><i class="fa fa-shopping-bag"></i></a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-content">
                        <h3><a href="{{ route('product.show', $product->product_slug) }}">{{ $product->product_name }}</a></h3>
                        <p class="pull-left">${{ $product->product_price }}

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



                {{-- <li class="col-xl-3 col-lg-4 col-sm-6 col-12  moreload">
                  <div class="product-wrap">
                      <div class="product-img">
                          <span>Sale</span>
                          <img src="assets/images/product/10.jpg" alt="">
                          <div class="product-icon flex-style">
                              <ul>
                                  <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                  <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                  <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                              </ul>
                          </div>
                      </div>
                      <div class="product-content"

                          </p>
                          <ul class="pull-right d-flex">
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star"></i></li>
                              <li><i class="fa fa-star-half-o"></i></li>
                          </ul>
                      </div>
                  </div>
              </li>  --}}



                {{-- @empty
                <td colspan="3"class="text center text-danger">No Data Available</td>
                @endforelse --}}








                <li class="col-12 text-center">
                    <a class="loadmore-btn" href="javascript:void(0);">Load More</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- product-area end -->
    <!-- testmonial-area start -->
    <div class="testmonial-area testmonial-area2 bg-img-2 black-opacity">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="test-title text-center">
                        <h2>What Our client Says</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 offset-md-1 col-12">
                    <div class="testmonial-active owl-carousel">
                      @foreach (App\order_list::all() as $order_list_all_data)

                        <div class="test-items test-items2">
                            <div class="test-content">
                                <p>{{ $order_list_all_data->review }}</p>
                                <h2>{{ App\User::find($order_list_all_data->user_id)->name}}</h2>
                                @if ( App\User::find($order_list_all_data->user_id)->role == 1)
                                  <p>Admin Of This Application</p>
                                  @else
                                    <p>Customer Of This Application</p>
                                @endif

                            </div>
                            <div class="test-img2">
                                <img src="assets/images/test/1.png" alt="">
                            </div>
                        </div>
                      @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testmonial-area end -->
@endsection
