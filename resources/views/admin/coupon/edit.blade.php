@extends('layouts.dashboard')

{{-- @section('title')
  Add Faq
@endsection  --}}
@section('coupon')
active
@endsection
@section('breadcrumb')

<nav class="breadcrumb sl-breadcrumb">
    <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
    <span class="breadcrumb-item active">Add Coupon</span>
</nav>


@endsection




@section('content')
<div class="container">
    <div class="row">




        <div class="col-lg-5 m-auto">
            <div class="card">
                <div class="card-header">

                    @if ($errors->all())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error}}</li>
                        @endforeach

                    </div>
                    @endif



                    <form action="{{route('coupon.update',$coupon->id)}}" method="post">
                      {{ method_field('PUT') }}
                        @csrf

                        <div class="form-group">
                            <label for="coupon_name">Coupon Name </label>
                            <input type="text" class="form-control" id="coupon_name" placeholder="Enter Coupon Name" name="coupon_name" value="{{$coupon->coupon_name}}">

                        </div>

                        <div class="form-group">
                            <label for="coupon_discount"> Coupon Discount (%)</label>
                            <input type="text" class="form-control" id="coupon_discount" placeholder="Coupon Description" name="coupon_discount" value="{{$coupon->coupon_discount}}">

                        </div>
                        <div class="form-group">
                            <label for="coupon_validity"> Coupon Validity</label>
                            <input type="date" class="form-control" id="coupon_validity" name="coupon_validity"  value="{{ $coupon->coupon_validity}}" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">

                        </div>




                        <button type="submit" class="btn btn-success">Update Coupon</button>
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
