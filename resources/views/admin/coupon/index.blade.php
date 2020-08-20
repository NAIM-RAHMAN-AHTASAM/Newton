@extends('layouts.dashboard')

@section('title')
  Add Coupon
@endsection
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


            @can('see coupon')
            <div class="card">
                <div class="card-header">
                    <h1>Coupon list</h1>
                    <table class="table table-dark">
                        <thead>
                            <tr>

                                <th scope="col">ID</th>
                                <th scope="col">Coupon Name</th>
                                <th scope="col">Coupon Discount</th>
                                <th scope="col">Coupon Validity </th>
                                <th scope="col">Validity status</th>
                                <th scope="col">Validity Date</th>
                                <th scope="col">created_at</th>
                                @can('delete coupon')
                                <th scope="col">Action</th>
                              @endcan
                            </tr>
                        </thead>
                        <tbody>
                      @forelse($coupons as $coupon)
                      <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$coupon->coupon_name}}</td>
                        <td>{{$coupon->coupon_discount}}%</td>
                        <td>{{$coupon->coupon_validity}}</td>
                        <td>

                        @if ($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d') )
                          <h6 class="btn btn-success">OK</h6>
                          @else
                            <h6 class="btn btn-danger">Date Over</h6>
                        @endif
                        </td>
                        <td>
                          @if ($coupon->coupon_validity >= Carbon\Carbon::now()->format('Y-m-d') )
                            <h6 class="btn btn-success">{{ \Carbon\Carbon::parse($coupon->coupon_validity)->diffInDays(Carbon\Carbon::now()->format('Y-m-d'))  }} Days Left</h6>
                            @else
                              <h6 class="btn btn-danger">Expaired{{ \Carbon\Carbon::parse($coupon->coupon_validity)->diffInDays(Carbon\Carbon::now()->format('Y-m-d')) }} Days ago</h6>
                          @endif

                        </td>
                        <td>
                            @if (isset($coupon->created_at))
                            {{$coupon->created_at->format('d/m/y h/i/s A')}}
                            @else

                            @endif
                        </td>
                        <td>

                          @can('edit coupon')
                          <a href="{{route('coupon.edit',$coupon->id)}}"class="btn btn-info "><i class="fa fa-pencil"></i></a>

                        @endcan

                        @can('delete coupon')
                                  <form action="{{ URL::route('coupon.destroy',$coupon->id) }}" method="post">
                                      {{ method_field('delete') }}
                                      {{ csrf_field() }}

                                      <button class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>
                                    </form>
                        @endcan
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

          @endcan



            @if (session('deletestatus') )

            <div class="alert alert-danger text-center">
                {{session('deletestatus') }}
            </div>
            @endif


            <br>

        </div>

        @can('add coupon')

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



                    <form action="{{route('coupon.store')}}" method="post">
                        @csrf

                        <div class="form-group">
                            <label for="coupon_name">Coupon Name </label>
                            <input type="text" class="form-control" id="coupon_name" placeholder="Enter Coupon Name" name="coupon_name">
                            @error ('coupon_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="coupon_discount"> Coupon Discount (%)</label>
                            <input type="text" class="form-control" id="coupon_discount" placeholder="Coupon Description" name="coupon_discount">
                            @error ('coupon_discount')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="coupon_validity"> Coupon Validity</label>
                            <input type="date" class="form-control" id="coupon_validity" name="coupon_validity" min="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                            @error ('coupon_validity')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>




                        <button type="submit" class="btn btn-success">Add Coupon</button>
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
