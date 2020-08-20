@php
  error_reporting(0);
@endphp

@extends('layouts.dashboard')

@section('breadcrumb')

<nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{route('home')}}">home</a>
      <span class="breadcrumb-item active">Edit profile</span>
    </nav>


@endsection


@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      @if (session('password_change_success'))
        <div class="alert alert-success">
        {{ session('password_change_success') }}
        </div>
      @endif


    </div>

  </div>
  <div class="row">
    <div class="col-md-8 m-auto">
      <div class="card">
        <div class="card-header">
          <h1>Change Password</h1>

      <form action="{{ url('update/profile/post') }}" method="post" enctype="multipart/form-data">
            @csrf

              <div class="form-group">
                <label for="name">Your Name *</label>
                <input type="text" class="form-control" id="name" value="@if(Auth::user()->name != null){{Auth::user()->name}}@endif" name="profile_name">
              </div>

              <div class="form-group">
                <label for="email">Your Email *</label>
                <input type="email" class="form-control" id="email" value="@if(Auth::user()->email != null){{ Auth::user()->email }}@endif" name="profile_email">
              </div>


              <div class="form-group">
                <label for="phone">Phone No *</label>
                <input type="text" class="form-control" value="@if(Auth::user()->contact != null){{ Auth::user()->contact }}@endif" id="phone" placeholder="Enter Your  Phone No"name="profile_phone">
              </div>

              <div class="form-group">
                <label for="address">Address *</label>
                <input type="text" class="form-control" value="@if(Auth::user()->address != null){{ Auth::user()->address }}@endif" id="address" placeholder="Enter  Your Address"name="profile_address">
              </div>


              <div class="form-group">
                <label for="image">Your Image *</label>
                <input type="file" class="form-control" id="image" placeholder="Enter confirm password"name="profile_image">
              </div>

              <button type="submit" class="btn btn-info">Update</button>
          </form>


          <br>
          @if ($errors->all())


          <div class="alert alert-danger">

          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </div>

        @endif
        </div>

      </div>

    </div>

  </div>

</div>

@endsection
