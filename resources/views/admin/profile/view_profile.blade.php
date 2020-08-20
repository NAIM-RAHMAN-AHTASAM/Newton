@php
error_reporting(0);
@endphp


@extends('layouts.dashboard')

@section('breadcrumb')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{route('home')}}">home</a>
    <span class="breadcrumb-item active">View profile</span>
</nav>


@endsection



@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mt-3">
                <div class="card-header">
                    <h5>My Profile</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <div class="admin_image">
                              @if($data->image != null)
                                <img src="{{url($data->image)}}" style="height:200px;width:200px;border-radius:50%">
                              @endif
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-lg-12 mb-1">
                            <h5 style="display:inline">Name : </h5>
                            <p style="display:inline">{{Auth::user()->name}}</p>
                        </div>
                        <div class="col-lg-12 mb-1">
                            <h5 style="display:inline">Email : </h5>
                            <p style="display:inline">{{Auth::user()->email}}</p>
                        </div>
                        <div class="col-lg-12 mb-1">
                            <h5 style="display:inline">Contact : </h5>
                            <p style="display:inline">{{Auth::user()->contact}}</p>
                        </div>
                        <div class="col-lg-12 mb-1">
                            <h5 style="display:inline">Address : </h5>
                            <p style="display:inline">{{Auth::user()->address}}</p>
                        </div>
                        <div class="col-lg-12 mt-5 text-center">
                            <a href="{{url('update/profile')}}/{{$id->id}}" class="btn-sm btn-info text-white">Update Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
@endsection
