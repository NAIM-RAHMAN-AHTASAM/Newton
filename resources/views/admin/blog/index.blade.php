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
        <div class="col-lg-8 offset-3">

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



            <div class="card">
                <div class="card-header">
                    <h1>Blog List</h1>
                    <table class="table table-dark">
                        <thead>
                            <tr>

                                <th scope="col">ID</th>
                                <th scope="col">Blog Title</th>
                                <th scope="col">Blog Description</th>
                                <th scope="col">Blog image</th>
                                <th scope="col">created</th>
                                <th scope="col">updated</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                      @forelse($blogs as $blog)
                      <tr>

                        <td>{{$loop->index+1}}</td>
                        <td>{{$blog->blog_title}}</td>
                        <td>{{Str::limit($blog->blog_description,10)}}</td>
                        <td>
                            <img width="50" src="{{ asset('uploads/blog') }}/{{ $blog->blog_image }}" alt="{{ $blog->blog_image }}">
                        </td>

                        </td>
                        <td>

                            @if (isset($blog->created_at))
                            {{$blog->created_at->format('d/m/y')}}
                            @else

                            @endif
                        </td>
                        <td>
                            @if (isset($blog->updated_at))
                            {{$blog->updated_at->format('d/m/y h/i/s A')}}
                            @else

                            @endif


                        </td>
                        <td>


                          <a href="{{route('blog.edit',$blog->id)}}"class="btn btn-info "><i class="fa fa-pencil"></i></a>

                                  <form action="{{ URL::route('blog.destroy',$blog->id) }}" method="post">
                                      {{ method_field('delete') }}
                                      {{ csrf_field() }}

                                      <button class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>
                                    </form>

                          {{-- <a href="{{route('category.destroy',$category->id)}}"class="btn btn-danger btn-sm">Delete</a> --}}
                        </td>



                        </tr>
                        @empty
                        <td colspan="3" class="text center text-danger">No Data Available</td>
                        @endforelse




                        </tbody>
                    </table>
                </div>

            </div>



            @if (session('deletestatus') )

            <div class="alert alert-danger text-center">
                {{session('deletestatus') }}
            </div>
            @endif


            <br>

        </div>



        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">

                    @if ($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error}}</li>
                        @endforeach

                    </div>
                    @endif



                    <form action="{{route('blog.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="blog_title">Blog Title</label>
                            <input type="text" class="form-control" id="blog_title" placeholder="Enter Blog Title" name="blog_title">
                            @error ('blog_title')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="blog_description"> Blog Description</label>
                            <textarea name="blog_description" class="form-control" id="blog_description" placeholder="Blog Description"></textarea>

                            @error ('blog_description')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="blog_image">Blog image</label>
                            <input type="file" class="form-control" id="blog_image" name="blog_image">
                        </div>
                        <button type="submit" class="btn btn-success">Add Blog</button>
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
