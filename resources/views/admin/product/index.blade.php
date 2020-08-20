@extends('layouts.dashboard')

 @section('title')
  Add product
@endsection
@section('product')
  active
@endsection
@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-item active">Add product</span>
  </nav>


@endsection




@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-9 offset-3">

    @if (session('status') )

      <div class="alert alert-success">
        {{session('status') }}
      </div>
    @endif
   @if (session('deletestatus') )

      <div class="alert alert-danger">
        {{session('deletestatus') }}
      </div>
    @endif




@can('see product')


<div class="card">

  <div class="card-header">
    <h1>Product List</h1>
    <table class="table table-dark">
                  <thead>
                    <tr>

                      <th scope="col">ID</th>
                      <th scope="col">Prod Name</th>
                      <th scope="col">Prod Price</th>
                      <th scope="col">Prod Quantity</th>
                      <th scope="col">Category name</th>
                      {{-- <th scope="col">long Desc</th> --}}
                      <th scope="col">Thumbnail  Image</th>
                      <th scope="col"> Multiple image</th>
                      <th scope="col">created</th>
                      {{-- <th scope="col">updated</th> --}}
                      <th scope="col">Action</th>

                    </tr>
                  </thead>
                  <tbody>

                      @forelse($products as $product)

                      <tr>

                        <td>{{$loop->index+1}}</td>
                        <td>{{$product->product_name}}</td>
                        <td>{{$product->product_price}}</td>
                        <td>{{$product->product_quantity}}</td>
                        <td>{{ App\category::find($product->category_id)->category_name}}</td>
                        {{-- <td>{{Str::limit($product->product_long_description,10)}}</td> --}}
                        <td>
                        <img width="50"src="{{ asset('uploads/product_thumbnail') }}/{{ $product->product_thumbnail_image }}" alt="{{ $product->product_thumbnail_image }}">
                      </td>

                      <td>
                        @foreach ($product->get_multiple_photos as $multiple_image)

                          <img width="50"src="{{ asset('uploads/product_multiple') }}/{{ $multiple_image->product_multiple_image_name }}" alt="{{ $product->product_thumbnail_image }}">
                        @endforeach

                      </td>



                        <td>

                          @if (isset($product->created_at))
                            {{$product->created_at->format('d/m/y h/i/s A')}}
                            @else

                          @endif
                        </td>
                        {{-- <td>
                          @if (isset($product->updated_at))
                            {{$product->updated_at->format('d/m/y h/i/s A')}}
                            @else

                          @endif


                        </td> --}}
                        <td>
                          @can('edit product')

                          <a href="{{route('product.edit',$product->id)}}"class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>

                        @endcan


                        @can('delete product')
                                  <form action="{{ URL::route('product.destroy',$product->id) }}" method="post">
                                      {{ method_field('delete') }}
                                      {{ csrf_field() }}

                                      <button class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>
                                    </form>


                        @endcan
                          {{-- <a href="{{route('category.destroy',$category->id)}}"class="btn btn-danger btn-sm">Delete</a> --}}
                        </td>



                      </tr>
                      @empty
                      <td colspan="3"class="text center text-danger">No Data Available</td>
                      @endforelse




                  </tbody>
                </table>
  </div>
</div>
  @else
    you can not see product list
@endcan



      @if (session('deletestatus') )

        <div class="alert alert-danger text-center">
          {{session('deletestatus') }}
        </div>
      @endif


<br>

    </div>

    @can('add product')

    <div class="col-lg-3">
      <div class="card">
        <div class="card-header">

          @if ($errors->all())
            <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{  $error}}</li>
          @endforeach

            </div>
          @endif



          <form action="{{route('product.store')}}"method="post" enctype="multipart/form-data">
            @csrf


            <div class="form-group">
              <label>category name</label>
          <select class="form-control" name="category_id">
            <option value="">select one</option>
            @foreach ($categories as $category)
              <option value="{{$category->id}}">{{$category->category_name}}</option>
            @endforeach

          </select>


            </div>


              <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" class="form-control" id="product_name" placeholder="Enter product name"name="product_name" >
                @error ('product_name')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>
              <div class="form-group">
                <label for="product_quantity">Product Quantity</label>
                <input type="text" class="form-control" id="product_quantity" placeholder="Enter product quantity"name="product_quantity" >
                @error ('product_quantity')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>
              <div class="form-group">
                <label for="product_price">Product price</label>
                <input type="text" class="form-control" id="product_price" placeholder="Enter product price"name="product_price" >
                @error ('product_price')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>
              <div class="form-group">
                <label for="product_short_description">product_short_description </label>
              <textarea name="product_short_description" class="form-control" ></textarea>
                @error ('product_short_description')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>
              <div class="form-group">
                <label for="product_long_description">product_long_descriptione</label>
              <textarea name="product_long_description" class="form-control" ></textarea>
                @error ('product_long_description')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>

              <div class="form-group">
                <label for="product_thumbnail_image">Product Thumbnail Image</label>
                <input type="file" class="form-control" id="product_thumbnail_image" name="product_thumbnail_image" >


              </div>
              <div class="form-group">
                <label for="product_multiple_image">Product Multiple Image</label>
                <input type="file" class="form-control" id="product_multiple_image" name="product_multiple_image[]" multiple>


              </div>


              <button type="submit" class="btn btn-success">Add Poduct</button>
          </form>
        </div>

      </div>
      @if (session('status') )

        <div class="alert alert-success">
          {{session('status') }}
        </div>
      @endif
    </div>
  @else
      you don't have this permission

  @endcan

  </div>

</div>
@endsection
