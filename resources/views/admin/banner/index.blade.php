@extends('layouts.dashboard')

@section('title')
  Add banner
@endsection
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



            <div class="card">
                <div class="card-header">
                    <h1>Banner List</h1>
                    <table class="table table-dark">
                        <thead>
                            <tr>

                                <th scope="col">ID</th>
                                <th scope="col">Banner Title</th>
                                <th scope="col">Banner Description</th>
                                <th scope="col">Banner image</th>
                                <th scope="col">created</th>
                                <th scope="col">updated</th>
                                <th scope="col">Action</th>

                            </tr>
                        </thead>
                        <tbody>

                      @forelse($banners as $banner)
                      <tr>

                        <td>{{$loop->index+1}}</td>
                        <td>{{$banner->banner_title}}</td>
                        <td>{{Str::limit($banner->banner_description,10)}}</td>
                        <td>
                            <img width="50" src="{{ asset('uploads/banner') }}/{{ $banner->banner_image }}" alt="{{ $banner->banner_image }}">
                        </td>



                        <td>

                            @if (isset($banner->created_at))
                            {{$banner->created_at->format('d/m/y h/i/s A')}}
                            @else

                            @endif
                        </td>
                        <td>
                            @if (isset($banner->updated_at))
                            {{$banner->updated_at->format('d/m/y h/i/s A')}}
                            @else

                            @endif


                        </td>
                        <td>


                          <a href="{{route('banner.edit',$banner->id)}}"class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>

                                  <form action="{{ URL::route('banner.destroy',$banner->id) }}" method="post">
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



        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">

                    @if ($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error}}</li>
                        @endforeach

                    </div>
                    @endif



                    <form action="{{route('banner.store')}}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="banner_title">Banner Title</label>
                            <input type="text" class="form-control" id="banner_title" placeholder="Enter Banner Title" name="banner_title">
                            @error ('banner_title')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="banner_description"> Banner Description</label>
                            <input type="text" class="form-control" id="banner_description" placeholder="Banner Description" name="banner_description">
                            @error ('banner_description')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="banner_image">Banner image</label>
                            <input type="file" class="form-control" id="banner_image" name="banner_image">
                        </div>



                        <button type="submit" class="btn btn-success">Add Banner</button>
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
