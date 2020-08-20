
@extends('layouts.frontend')
  @section('home')
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
                             <li><a href="{{url('/')}}">Home</a></li>
                             <li><span>Shop</span></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- .breadcumb-area end -->
     <!-- single-product-area start-->
     <div class="single-product-area ptb-100">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6">
                     <div class="product-single-img">
                         <div class="product-active owl-carousel">
                           <?php foreach ($product_info->get_multiple_photos as $multiple_image): ?>

                             <div class="item">
                                 <img src="{{asset('uploads\product_multiple')}}/{{$multiple_image->product_multiple_image_name}}" alt="no image">
                             </div>
                           <?php endforeach; ?>

                         </div>
                         <div class="product-thumbnil-active  owl-carousel">
                           <?php foreach ($product_info->get_multiple_photos as $multiple_image): ?>

                             <div class="item">
                                 <img src="{{asset('uploads\product_multiple')}}/{{$multiple_image->product_multiple_image_name}}" alt="no image">
                             </div>
                           <?php endforeach; ?>
                         </div>
                     </div>
                 </div>
                 <div class="col-lg-6">
                     <div class="product-single-content">
                         <h3>{{$product_info->product_name}}</h3>
                         <h6>Available Quantity:{{$product_info->product_quantity}}</h6>

                         <div class="rating-wrap fix">
                             <span class="pull-left">$ {{$product_info->product_price}}</span>

                             <ul class="rating pull-right">



                               @if (review_star_amount($product_info->id)== 1)

                                 <li><i class="fa fa-star"></i></li>

                               @elseif (review_star_amount($product_info->id) == 2)

                                 <li><i class="fa fa-star"></i></li>
                                 <li><i class="fa fa-star"></i></li>

                                @elseif (review_star_amount($product_info->id) == 3)

                                 <li><i class="fa fa-star"></i></li>
                                 <li><i class="fa fa-star"></i></li>
                                 <li><i class="fa fa-star"></i></li>

                               @elseif (review_star_amount($product_info->id) == 4)

                                 <li><i class="fa fa-star"></i></li>
                                 <li><i class="fa fa-star"></i></li>
                                 <li><i class="fa fa-star"></i></li>
                                 <li><i class="fa fa-star"></i></li>

                             @elseif (review_star_amount($product_info->id) == 5)

                                 <li><i class="fa fa-star"></i></li>
                                 <li><i class="fa fa-star"></i></li>
                                 <li><i class="fa fa-star"></i></li>
                                 <li><i class="fa fa-star"></i></li>
                                 <li><i class="fa fa-star"></i></li>
                               @else
                                 <li>No Review Yet!!</li>


                               @endif



                                 <li>({{App\order_list::where('product_id',$product_info->id)->whereNotNull('review')->count()}} Customar Review)</li>
                             </ul>
                         </div>
                         <p>{{$product_info->product_short_description}}</p>

                         <ul class="input-style">
                           <form class="" action="{{ url('add/to/cart') }}" method="post">
                             @csrf
                                  <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                             <li class="quantity cart-plus-minus">

                                 <input type="text" value="1"name="product_amount" />
                             </li>
                             <li><button type="submit" class="btn btn-danger">Add to Cart</button></li>
                           </form>
                         </ul>
                            @if(session('stock_Msg'))
                                <p class="alert alert-danger" style="color:black;font-size:15px;font-weight:500">{{session('stock_Msg')}}</p>
                            @endif
                         <ul class="cetagory">
                             <li>Categories:</li>
                             <li><a href="#">{{App\Category::find($product_info->category_id)->category_name}}</a></li>
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
             <div class="row mt-60">
                 <div class="col-12">
                     <div class="single-product-menu">
                         <ul class="nav">
                             <li><a class="active" data-toggle="tab" href="#description">Description</a> </li>
                             <li><a data-toggle="tab" href="#tag">Faq</a></li>
                             <li><a data-toggle="tab" href="#review">Review</a></li>

                         </ul>
                     </div>
                 </div>
                 <div class="col-12">
                     <div class="tab-content">
                         <div class="tab-pane active" id="description">
                             <div class="description-wrap">
                                <p>{{$product_info->product_long_description}} </p>
                             </div>
                         </div>
                         <div class="tab-pane" id="tag">
                             <div class="faq-wrap" id="accordion">
                               @foreach (App\Faq::all() as $faq)

                                 <div class="card">
                                     <div class="card-header" id="headingOne">
                                         <h5><button data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">{{ $faq->faq_question }}</button> </h5>
                                     </div>
                                     <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                         <div class="card-body">{{ $faq->faq_answer }}</div>
                                     </div>
                                 </div>
                               @endforeach
                                 {{-- <div class="card">
                                     <div class="card-header" id="headingTwo">
                                         <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">How To Use ?</button></h5>
                                     </div>
                                     <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                                         <div class="card-body">
                                             Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                         </div>
                                     </div>
                                 </div>
                                 <div class="card">
                                     <div class="card-header" id="headingThree">
                                         <h5><button class="collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Shipping & Delivery ?</button></h5>
                                     </div>
                                     <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                                         <div class="card-body">
                                             Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                         </div>
                                     </div>
                                 </div>
                                 <div class="card">
                                     <div class="card-header" id="headingfour">
                                         <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">Additional Information ?</button></h5>
                                     </div>
                                     <div id="collapsefour" class="collapse" aria-labelledby="headingfour" data-parent="#accordion">
                                         <div class="card-body">
                                             Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                         </div>
                                     </div>
                                 </div>
                                 <div class="card">
                                     <div class="card-header" id="headingfive">
                                         <h5><button class="collapsed" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">Return Policy ?</button></h5>
                                     </div>
                                     <div id="collapsefive" class="collapse" aria-labelledby="headingfive" data-parent="#accordion">
                                         <div class="card-body">
                                             Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                         </div>
                                     </div>
                                 </div> --}}
                             </div>
                         </div>
                         <div class="tab-pane" id="review">
                             <div class="review-wrap">
                                 <ul>
                                   @foreach (App\order_list::where('product_id',$product_info->id)->whereNotNull('review')->get() as $review)

                                     <li class="review-items">
                                         <div class="review-img">
                                             <img src="assets/images/comment/1.png" alt="">
                                         </div>
                                         <div class="review-content">
                                             <h3><a href="#">{{App\User::find($review->user_id)->name}}</a></h3>
                                             {{-- <span>{{ $review->updated_at->format('d/m/Y H:i:s A') }}</span> --}}
                                             <p>{{ $review->review }}</p>
                                             <ul class="rating">
                                               @if ($review->star==1)

                                                 <li><i class="fa fa-star"></i></li>

                                               @elseif ($review->star ==2)

                                                 <li><i class="fa fa-star"></i></li>
                                                 <li><i class="fa fa-star"></i></li>

                                                @elseif ($review->star==3)

                                                 <li><i class="fa fa-star"></i></li>
                                                 <li><i class="fa fa-star"></i></li>
                                                 <li><i class="fa fa-star"></i></li>

                                               @elseif ($review->star==4)

                                                 <li><i class="fa fa-star"></i></li>
                                                 <li><i class="fa fa-star"></i></li>
                                                 <li><i class="fa fa-star"></i></li>
                                                 <li><i class="fa fa-star"></i></li>

                                             @elseif ($review->star==5)

                                                 <li><i class="fa fa-star"></i></li>
                                                 <li><i class="fa fa-star"></i></li>
                                                 <li><i class="fa fa-star"></i></li>
                                                 <li><i class="fa fa-star"></i></li>
                                                 <li><i class="fa fa-star"></i></li>
                                               @else
                                                 <li>No Review Yet</li>


                                               @endif

                                             </ul>
                                         </div>
                                     </li>
                                   @endforeach

                                 </ul>
                             </div>
                             <div class="add-review">
                                 <h4>Add A Review</h4>
                                 @Auth
                                   @if (App\order_list::where('user_id',Auth::id())->where('product_id',$product_info->id)->whereNull('review')->exists())
                                     <form class="" action="{{ route('add_review') }}" method="post">
                                       @csrf
                                       <input type="hidden" name="product_id" value="{{ $product_info->id }}">
                                     <div class="ratting-wrap">
                                         <table>
                                             <thead>
                                                 <tr>
                                                     <th>task</th>
                                                     <th>1 Star</th>
                                                     <th>2 Star</th>
                                                     <th>3 Star</th>
                                                     <th>4 Star</th>
                                                     <th>5 Star</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <tr>
                                                     <td>How Many Stars?</td>
                                                     <td>
                                                         <input type="radio" name="star"value="1" />
                                                     </td>
                                                     <td>
                                                         <input type="radio" name="star" value="2"/>
                                                     </td>
                                                     <td>
                                                         <input type="radio" name="star"value="3" />
                                                     </td>
                                                     <td>
                                                         <input type="radio" name="star"value="4" />
                                                     </td>
                                                     <td>
                                                         <input type="radio" name="star"value="5" />
                                                     </td>
                                                 </tr>
                                             </tbody>
                                         </table>
                                     </div>
                                     <div class="row">
                                         <div class="col-md-6 col-12">
                                             <h4>Name:</h4>
                                             <input type="text" value="{{ Auth::user()->name }}" disabled/>
                                         </div>
                                         <div class="col-md-6 col-12">
                                             <h4>Email:</h4>
                                             <input type="email" value="{{ Auth::user()->email }}" disabled/>
                                         </div>
                                         <div class="col-12">
                                             <h4>Your Review:</h4>
                                             <textarea name="review" starid="massage" cols="30" rows="10" placeholder="Your review here..."></textarea>
                                         </div>
                                         <div class="col-12">
                                             <button class="btn-style"type="submit">Submit</button>
                                         </div>
                                     </div>
                                   </form>

                                   @else
                                     you already provide your rating or you can not buy this product yet!!!
                                   @endif

                                 @else
                                   <h1>Please Login First</h1>
                               @endauth

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- single-product-area end-->
     <!-- featured-product-area start -->
     <div class="featured-product-area">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="section-title text-left">
                         <h2>Related Product</h2>
                     </div>
                 </div>
             </div>
             <div class="row">
            @forelse($related_product as $related_products)

                 <div class="col-lg-3 col-sm-6 col-12">
                     <div class="featured-product-wrap">
                         <div class="featured-product-img">
                             <img src="{{asset('uploads/product_thumbnail')}}/{{$related_products->product_thumbnail_image}}" alt="">
                         </div>
                         <div class="featured-product-content">
                             <div class="row">
                                 <div class="col-7">
                                     <h3><a href="{{route('product.show',$related_products->product_slug)}}">{{$related_products->product_name}}</a></h3>
                                     <p>${{$related_products->product_price}}</p>
                                 </div>
                                 <div class="col-5 text-right">
                                     <ul>
                                         <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li>
                                         <li><a href="cart.html"><i class="fa fa-heart"></i></a></li>
                                     </ul>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
                 @empty
                 <td colspan="5"class="text-center text-info">No Product Available</td>
                 @endforelse

             </div>
         </div>
     </div>
     <!-- featured-product-area end -->



@endsection
