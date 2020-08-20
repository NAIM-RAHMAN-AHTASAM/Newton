@extends('layouts.dashboard')

@section('title')
  Add Faq
@endsection
@section('contact')
  active
@endsection
@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
        <a class="breadcrumb-item" href="{{ route('category.index') }}">Category</a>

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





          <form action="{{route('contact.update',$contact->id)}}" method="post">

          {{ method_field('PUT') }}

            @csrf

                          <div class="form-group">
                            <label for="Contact_address">Contact Name</label>
                            <input type="text" class="form-control" id="Contact_address" value="{{$contact->Contact_address}}" name="Contact_address">
                            @error ('Contact_address')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                          </div>
                          <div class="form-group">
                            <label for="Contact_email">Contact Email</label>
                            <input type="email" class="form-control" id="Contact_email" value="{{$contact->Contact_email}}" name="Contact_email">
                            @error ('Contact_email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                          </div>
                          <div class="form-group">
                            <label for="Contact_phone">Contact Phone</label>
                            <input type="text" class="form-control" id="Contact_phone" value="{{$contact->Contact_phone}}" name="Contact_phone">
                            @error ('Contact_phone')
                                <small class="text-danger">{{$message}}</small>
                            @enderror

                          </div>

              <button type="submit" class="btn btn-success">Update Contact</button>
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
