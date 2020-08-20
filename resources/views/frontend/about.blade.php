@extends('layouts.frontend')

@section('admin_about')
active
@endsection
@section('content')

  <!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>About us</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>About</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- about-area start -->
    <div class="about-area ptb-100">
        <div class="container">
            <div class="row">
              @foreach ($abouts as $about)
                @if ($about->activation == 1)
                <div class="col-12">
                    <div class="about-wrap text-center">
                        <h3>{{$about->about_title}}</h3>
                        <p>{{ $about->about_discription }}</p>

                    </div>
                  </div>
                @endif
              @endforeach
            </div>
        </div>
    </div>
    <!-- about-area end -->
   <!-- product-area start -->
    <div class="product-area product-area-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title">
                        <h2>Best Seller</h2>


                        <img src="  {{ asset('frontend_assets/images/section-title.png') }}" alt="">
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
                                    <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="{{ route('product.show', App\product::find($best_salling_product->product_id)->product_slug) }}">{{ App\product::find($best_salling_product->product_id)->product_name }}</a></h3>
                            {{-- {{ App\product::find($best_salling_product->product_id)->product_name }} --}}
                            <p class="pull-left">${{ App\product::find($best_salling_product->product_id)->product_price }}
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
                </li>
              @endforeach

                {{-- <li class="col-xl-3 col-lg-4 col-sm-6 col-12">
                    <div class="product-wrap">
                        <div class="product-img">
                            <img src="{{ asset('frontend_assets/images/product/1.jpg') }}"alt="">
                            <div class="product-icon flex-style">
                                <ul>
                                    <li><a data-toggle="modal" data-target="#exampleModalCenter" href="javascript:void(0);"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="wishlist.html"><i class="fa fa-heart"></i></a></li>
                                    <li><a href="cart.html"><i class="fa fa-shopping-bag"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-content">
                            <h3><a href="single-product.html">Nature Honey</a></h3>
                            <p class="pull-left">$125

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
                </li> --}}

            </ul>
        </div>
    </div>
    <!-- product-area end -->
@endsection
