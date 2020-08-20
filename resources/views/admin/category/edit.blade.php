@extends('layouts.dashboard')

@section('title')
  Add Faq
@endsection
@section('category')
  active
@endsection
@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
        <a class="breadcrumb-item" href="{{ route('category.index') }}">Category</a>
        <span class="breadcrumb-item active">{{$category->category_name}}</span>
  </nav>


@endsection




@section('content')
<div class="container">
  <div class="row">

    <div class="col-lg-8">
      <div class="card">
        <div class="card-header">

          {{-- @if ($errors->all())
            <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{  $error}}</li>
          @endforeach

            </div>
          @endif --}}





          <form action="{{route('category.update',$category->id)}}"method="post" enctype="multipart/form-data">

          {{ method_field('PUT') }}


            @csrf
              <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" placeholder="Enter category name"name="category_name"value="{{$category->category_name}}" >
                @error ('category_name')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>
              <div class="form-group">
                <label for="category_image">Category Image</label>

                @if("/uploads/category/{{ $category->category_image }}")
                <img src="/uploads/category/{{ $category->category_image }}" width="150" height="120">
                 @else
                 <p>No image found</p>
                   @endif


                <input type="file" class="form-control" id="category_image" name="category_image" value="{{ $category->category_image }}">


              </div>


              <button type="submit" class="btn btn-success">Add Category</button>
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
