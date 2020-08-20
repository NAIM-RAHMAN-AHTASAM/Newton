@php
  error_reporting(0);
@endphp

@extends('layouts.dashboard')

@section('title')
  Add about
@endsection
@section('about')
  active
@endsection
@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-item active">Add About page</span>
  </nav>


@endsection




@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8">

    {{-- @if (session('status') )

      <div class="alert alert-success">
        {{session('status') }}
      </div>
    @endif --}}
    {{-- @if (session('deletestatus') )

      <div class="alert alert-danger">
        {{session('deletestatus') }}
      </div>
    @endif --}}


      <div class="card">
        <div class="card-header">
          <h1>Category List</h1>
          <table class="table table-dark">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">about title</th>
                            <th scope="col">about discription</th>
                            <th scope="col">activation</th>
                            {{-- <th scope="col">created_at</th>
                            <th scope="col">Last updated_at</th> --}}
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>

                          @forelse($abouts as $about)
                          <tr>

                            <td>{{$loop->index+1}}</td>
                            <td>{{$about->about_title}}</td>
                            <td>{{$about->about_discription}}</td>

                            <td>
                              @if ($about->activation == 1)

                                <a  href="{{ url('about/activation')}}/{{ $about->id }}/{{ $about->activation }}" class="btn btn-success"> Active</a>
                                @else

                                  <a href="{{ url('about/activation')}}/{{ $about->id  }}/{{ $about->activation }}" class="btn btn-danger"> Deactive</a>

                              @endif

                            </td>






                            {{-- <td>
                              @if (isset($about->created_at))
                                {{$about->created_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif
                            </td> --}}
                            {{-- <td>
                              @if (isset($about->updated_at))
                                {{$about->updated_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif


                            </td> --}}

                            <td>


                              <a href="{{route('about.edit',$about->id)}}"class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>

                                      <form action="{{ URL::route('about.destroy',$about->id) }}" method="post">
                                          {{ method_field('delete') }}
                                          {{ csrf_field() }}

                                          <button class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>
                                        </form>

                              {{-- <a href="{{route('category.destroy',$category->id)}}"class="btn btn-danger btn-sm">Delete</a> --}}
                            </td>

                          </tr>
                          @empty
                          <td colspan="50"class="text center text-danger">No Data Available</td>
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








    </div>
    <div class="col-lg-4">



      {{-- @can('see category') --}}


      <div class="card">
        <div class="card-header">
          @if ($errors->all())
            <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{  $error}}</li>
          @endforeach

            </div>
          @endif





          <form action="{{route('about.store')}}"method="post" >
            @csrf
              <div class="form-group">
                <label for="about_title">About Title</label>
                <input type="text" class="form-control" id="about_title" placeholder="Enter About Title"name="about_title" >
                @error ('about_title')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>
              {{-- <div class="form-group">
                <label for="about_discription">About Discription </label>
              <textarea name="about_discription" placeholder="Enter  About Discription" class="form-control" id="about_discription"></textarea>
              </div> --}}


              <div class="form-group">
                <label for="about_discription">About Discription</label>
              <textarea name="about_discription" class="form-control" ></textarea>
                @error ('about_discription')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>


              <button type="submit" class="btn btn-success">Add About</button>
          </form>
        </div>

      </div>
      {{-- @else
        you don't have this permission
    @endcan --}}
      @if (session('status') )

        <div class="alert alert-success">
          {{session('status') }}
        </div>
      @endif
    </div>

  </div>

</div>
@endsection
