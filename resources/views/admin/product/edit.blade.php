{{-- @php
  error_reporting(0);
@endphp --}}
@extends('layouts.dashboard')

 @section('title')
  Add Faq
@endsection
@section('product')
  active
@endsection
@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
        <a class="breadcrumb-item" href="{{ route('category.index') }}">Category</a>

        <span class="breadcrumb-item active">{{ $product->product_name }}</span>
  </nav>


@endsection




@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-6 m-auto">
      <div class="card">
        <div class="card-header">

          @if ($errors->all())
            <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{  $error}}</li>
          @endforeach

            </div>
          @endif



          <form action="{{route('product.update',$product->id)}}"method="post" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            @csrf


            <div class="form-group">
              <label>category name</label>
              <input type="text" class="form-control" id="category_id" placeholder="Enter product name" name="product_name" value="{{ App\Category::find($product->category_id)->category_name}}">
            </div>
              {{-- find example --}}
            {{-- App\Product::find($cart_product->product_id)->product_price) --}}




            {{-- <div class="form-group">
              <label>category name</label>
          <select class="form-control" name="category_id">
            <option value="">{{ App\Category::find($product->category_id)->category_name}}</option>
            @foreach ( App\Category::find($product->category_id)->category_name as $category)
              <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach
          </select>
            </div> --}}





              <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" placeholder="Enter product name"name="product_name" value="{{ $product->product_name }}">


              </div>


              <div class="form-group">
                <label for="product_quantity">Product Quantity</label>
                <input type="text" class="form-control" id="product_quantity" name="product_quantity" value="{{ $product->product_quantity}}" >
              </div>


              <div class="form-group">
                <label for="product_price">Product price</label>
                <input type="text" class="form-control" id="product_price" name="product_price" value="{{ $product->product_price}}"  >
              </div>


              <div class="form-group">
                <label for="product_short_description">product_short_description </label>
              <textarea name="product_short_description" class="form-control" requiredautofocus>{{ ucfirst($product->product_short_description) }}</textarea>

              </div>


              <div class="form-group">
                <label for="product_long_description">product_long_descriptione</label>
              <textarea name="product_long_description" class="form-control"  requiredautofocus>{{ ucfirst($product->product_long_description) }}</textarea>


              </div>



              <div class="form-group">
                <label for="product_thumbnail_image">Product Thumbnail Image</label>
                @if("/uploads/product_thumbnail/{{ $product->product_thumbnail_image }}")
                <img src="/uploads/product_thumbnail/{{ $product->product_thumbnail_image }}"  width="150" height="120">
                 @else
                 <p>No image found</p>
                   @endif
                <input type="file" class="form-control" id="product_thumbnail_image" name="product_thumbnail_image" value="{{ $product->product_thumbnail_image }} ">


              </div>






              <button type="submit" class="btn btn-success">update Poduct</button>
          </form>
        </div>

      </div>
      @if (session('status') )

        <div class="alert alert-success">
          {{session('status') }}
        </div>
      @endif
    </div>

  </div>

</div>
@endsection
