@extends('layouts.dashboard')

{{-- @section('title')
  Add Faq
@endsection  --}}
@section('banner')
active
@endsection
@section('breadcrumb')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <span class="breadcrumb-item active">Add banner</span>
</nav>


@endsection




@section('content')
<div class="container">
    <div class="row">




        <div class="col-lg-7 m-auto">
            <div class="card">
                <div class="card-header">

                    @if ($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error}}</li>
                        @endforeach

                    </div>
                    @endif



                    <form action="{{route('banner.update',$banner->id)}}" method="post" enctype="multipart/form-data">
                        {{ method_field('PUT') }}
                        @csrf

                        <div class="form-group">
                            <label for="banner_title">Banner Title</label>
                            <input type="text" class="form-control" id="banner_title" placeholder="Enter Banner Title" name="banner_title" value="{{ $banner->banner_title }}">

                        </div>

                        <div class="form-group">
                            <label for="banner_description"> Banner Description</label>
                            <textarea name="banner_description" class="form-control" requiredautofocus>{{ ucfirst($banner->banner_description) }}</textarea>
                            {{-- <input type="text" class="form-control" id="banner_description" placeholder="Banner Description" name="banner_description" value="{{ $banner->banner_description }}"> --}}

                        </div>

                        <div class="form-group">
                            <label for="banner_image">Banner image</label>

                          @if("/uploads/banner/{{ $banner->banner_image }}")
                          <img src="/uploads/banner/{{ $banner->banner_image }}" width="150" height="120">
                          @else
                          <p>No image found</p>
                          @endif

                            <input type="file" class="form-control" id="banner_image" name="banner_image" value="{{ $banner->banner_image }}">
                        </div>



                        <button type="submit" class="btn btn-success">Update Banner</button>
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
