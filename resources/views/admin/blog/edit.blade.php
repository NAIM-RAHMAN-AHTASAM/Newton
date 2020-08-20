@extends('layouts.dashboard')

{{-- @section('title')
  Add Faq
@endsection  --}}
@section('blog')
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



                    <form action="{{route('blog.update',$blog->id)}}" method="post" enctype="multipart/form-data">
                      {{ method_field('PUT') }}
                        @csrf

                        <div class="form-group">
                            <label for="blog_title">Blog Title</label>
                            <input type="text" class="form-control" id="blog_title" placeholder="Enter Blog Title" name="blog_title" value="{{ $blog->blog_title }}">

                        </div>

                        <div class="form-group">
                            <label for="blog_description"> Blog Description</label>
                            <textarea name="blog_description" class="form-control" id="blog_description" placeholder="Blog Description" requiredautofocus>{{ ucfirst($blog->blog_description) }} </textarea>


                        </div>

                        <div class="form-group">
                            <label for="blog_image">Blog image</label>
                            @if("/uploads/blog/{{ $blog->blog_image }}")
                            <img src="/uploads/blog/{{ $blog->blog_image }}"  width="150" height="120">
                             @else
                             <p>No image found</p>
                               @endif
                            <input type="file" class="form-control" id="blog_image" name="blog_image">
                        </div>
                        <button type="submit" class="btn btn-success">Update Blog</button>
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
