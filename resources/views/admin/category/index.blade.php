@extends('layouts.dashboard')

@section('title')
  Add Categpry
@endsection
@section('category')
  active
@endsection
@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-item active">Add Category page</span>
  </nav>


@endsection




@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8">



      @can('see category')

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
                            <th scope="col">Category_Name</th>
                            <th scope="col">Added_By</th>
                            <th scope="col">Category Image</th>
                            <th scope="col">created_at</th>
                            <th scope="col">Last updated_at</th>
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>

                          @forelse($categories as $category)
                          <tr>

                            <td>{{$loop->index+1}}</td>
                            <td>{{$category->category_name}}</td>

                            <td>{{$category->connect_to_user_table->name}}</td>
                            <td>
                              <img width="50"src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt="{{ $category->category_image }}">
                            </td>
                            <td>
                              @if (isset($category->created_at))
                                {{$category->created_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif
                            </td>
                            <td>
                              @if (isset($category->updated_at))
                                {{$category->updated_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif


                            </td>

                            <td>
                              @can('edit category')

                              <a href="{{route('category.edit',$category->id)}}"class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>

                            @endcan


                            @can('delete category')
                                      <form action="{{ URL::route('category.destroy',$category->id) }}" method="post">
                                          {{ method_field('delete') }}
                                          {{ csrf_field() }}

                                          <button class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>
                                        </form>
                            @endcan
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
    @else
      you don't have this permission
  @endcan



      @if (session('deletestatus') )

        <div class="alert alert-danger text-center">
          {{session('deletestatus') }}
        </div>
      @endif


<br>


 {{-- start Faq List for Soft --}}




      {{-- <div class="card">
        <div class="card-header">
          <h1>Faq List for Soft delete</h1>
          <table class="table table-dark">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">question</th>
                            <th scope="col">Answer</th>
                            <th scope="col">created_at</th>
                            <th scope="col">Last updated_at</th>
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>

                          {{-- @forelse($soft_deleted_faqs as $soft_deleted_faq)
                          <tr>

                            <td>{{$loop->index+1}}</td>
                            <td>{{$soft_deleted_faq->faq_question}}</td>
                            <td>{{$soft_deleted_faq->faq_answer}}</td>
                            <td>
                              @if (isset($soft_deleted_faq->created_at))
                                {{$soft_deleted_faq->created_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif
                            </td>
                            <td>
                              @if (isset($soft_deleted_faq->updated_at))
                                {{$soft_deleted_faq->updated_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif


                            </td>
                            <td>

                              <a href="{{ url('faq/restore') }}/{{ $soft_deleted_faq->id }}"class="btn btn-success btn-sm">Restore</a>
                              <a href="{{ url('/faq/hard/delete') }}/{{ $soft_deleted_faq->id }}"class="btn btn-danger btn-sm"><h1></h1>Haed Delete</a>
                            </td>


                          </tr>
                          @empty
                          <td colspan="3"class="text center text-danger">No Data Available</td>
                          @endforelse


                        {{-- </tbody>
                      </table>
        </div>

      </div> --}}




{{-- End  Faq List for Soft --}}







    </div>



    @can('add category')

    <div class="col-lg-4">




      <div class="card">
        <div class="card-header">
          @if ($errors->all())
            <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{  $error}}</li>
          @endforeach

            </div>
          @endif





          <form action="{{route('category.store')}}"method="post" enctype="multipart/form-data">
            @csrf
              <div class="form-group">
                <label for="category_name">Category Name</label>
                <input type="text" class="form-control" id="category_name" placeholder="Enter category name"name="category_name" >
                @error ('category_name')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>
              <div class="form-group">
                <label for="category_image">Category Image</label>
                <input type="file" class="form-control" id="category_image" name="category_image" >


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


    @else
      you don't have this permission
  @endcan

  </div>

</div>
@endsection
