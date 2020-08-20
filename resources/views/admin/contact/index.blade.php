@php
  error_reporting(0);
@endphp
@extends('layouts.dashboard')

@section('contact')
  Add Contact
@endsection
@section('contact')
  active
@endsection
@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-item active">Add Contact page</span>
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
          <h1>Contact List</h1>
          <table class="table table-dark">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Contact address</th>
                            <th scope="col">Contact email</th>
                            <th scope="col">Contact phone</th>
                            <th scope="col">Activation</th>
                            {{-- <th scope="col">created_at</th> --}}

                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>

                          @forelse($contacts as $contact)
                          <tr>





                            <td>{{$loop->index+1}}</td>
                            <td>{{$contact->Contact_address}}</td>
                            {{-- <td>{{App\user::find($category->added_by)->name}}</td> --}}
                            <td>{{$contact->Contact_email}}</td>
                            <td>{{$contact->Contact_phone}}</td>






                            <td>
                              @if ($contact->activation == 1)

                                <a  href="{{ url('contact/activation')}}/{{ $contact->id }}/{{ $contact->activation }}" class="btn btn-success"> Active</a>
                                @else

                                  <a href="{{ url('contact/activation')}}/{{ $contact->id  }}/{{ $contact->activation }}" class="btn btn-danger"> Deactive</a>

                              @endif

                            </td>

                            {{-- <td>
                              @if (isset($category->created_at))
                                {{$category->created_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif
                            </td> --}}
                            {{-- <td>
                              @if (isset($category->updated_at))
                                {{$category->updated_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif


                            </td> --}}

                            <td>


                              <a href="{{route('contact.edit',$contact->id)}}"class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>

                                      <form action="{{ URL::route('contact.destroy',$contact->id) }}" method="post">
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





          <form action="{{route('contact.store')}}"method="post" >
            @csrf






              <div class="form-group">
                <label for="Contact_address">Contact Name</label>
                <input type="text" class="form-control" id="Contact_address" placeholder="Enter Contact Address"name="Contact_address" >
                @error ('Contact_address')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>
              <div class="form-group">
                <label for="Contact_email">Contact Name</label>
                <input type="email" class="form-control" id="Contact_email" placeholder="Enter Mail Address"name="Contact_email" >
                @error ('Contact_email')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>
              <div class="form-group">
                <label for="Contact_phone">Contact Name</label>
                <input type="text" class="form-control" id="Contact_phone" placeholder="Enter  Phone"name="Contact_phone" >
                @error ('Contact_phone')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>



              <button type="submit" class="btn btn-success">Add Category</button>
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
