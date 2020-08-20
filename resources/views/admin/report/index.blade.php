@php
  error_reporting(0);
@endphp


@extends('layouts.dashboard')

 @section('title')
  Add product
@endsection
@section('view_report')
  active
@endsection
@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-item active">Add product</span>
  </nav>


@endsection




@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-12 offset-3">

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




{{-- @can('see product') --}}


<div class="card">

  <div class="card-header">
    <h1>Order  List</h1>
    <table class="table table-dark">
                  <thead>
                    <tr>

                      <th scope="col">ID</th>
                      <th scope="col">Customer name</th>
                      <th scope="col">product name</th>
                      <th scope="col">phone no</th>
                      <th scope="col">address</th>
                      <th scope="col">coupon name</th>
                      <th scope="col">payment method</th>
                      <th scope="col">Product quantity</th>
                      <th scope="col"> in Stock</th>
                      <th scope="col">sub total</th>
                      <th scope="col">total</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- {{ $orders_list }} --}}
                      @forelse($orders_list as $report_genarate)

                      <tr>

                        <td>{{$loop->index+1}}</td>
                        <td>{{ App\order::find($report_genarate->order_id)->full_name}}</td>
                        <td>{{ App\product::find($report_genarate->product_id)->product_name}}</td>
                        <td>{{ App\order::find($report_genarate->order_id)->phone_number}}</td>
                        <td>{{App\order::find($report_genarate->order_id)->address}}</td>
                        <td>{{App\order::find($report_genarate->order_id)->coupon_name}}</td>
                        <td>
                        @if (App\order::find($report_genarate->order_id)->payment_method == 1)
                          Cash on Delivery

                          @else
                            Credit Card/paypal
                        @endif
                        </td>
                        <td>{{$report_genarate->product_amount}}</td>
                        <td>{{App\product::find($report_genarate->product_id)->product_quantity}}</td>
                        <td>{{App\order::find($report_genarate->order_id)->sub_total}}</td>
                        <td>{{App\order::find($report_genarate->order_id)->total}}</td>






                        {{-- <td>{{ App\category::find($product->category_id)->category_name}}</td> --}}


                        {{-- <td>{{ App\order_list::find($product->product_id)->total}}</td> --}}






{{--
                        <td>
                          @can('edit product')

                          <a href="{{route('product.edit',$product->id)}}"class="btn btn-info btn-sm"><i class="fa fa-pencil"></i></a>

                        @endcan


                        @can('delete product')
                                  <form action="{{ URL::route('product.destroy',$product->id) }}" method="post">
                                      {{ method_field('delete') }}
                                      {{ csrf_field() }}

                                      <button class="btn btn-danger text-white"><i class="fa fa-trash"></i></button>
                                    </form>


                        @endcan

                        </td> --}}



                      </tr>
                      @empty
                      <td colspan="3"class="text center text-danger">No Data Available</td>
                      @endforelse




                  </tbody>
                </table>
                {{ $orders_list->links() }}

  </div>
</div>
  {{-- @else
    you can not see product list
@endcan --}}



      @if (session('deletestatus') )

        <div class="alert alert-danger text-center">
          {{session('deletestatus') }}
        </div>
      @endif


<br>

    </div>



  </div>

</div>
@endsection
