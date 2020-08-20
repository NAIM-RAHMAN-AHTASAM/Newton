@extends('layouts.dashboard')

@section('content')


  <div class="container">
      <div class="row justify-content-center">
          <div class="col-md-12">
              <div class="card">
                  {{-- <div class="card-header">Total users:{{$customer_orders->total()}}</div> --}}

                  <div class="card-body">
                      @if (session('status'))
                          <div class="alert alert-success" role="alert">
                              {{ session('status') }}
                          </div>
                      @endif


                      <table class="table table-dark">
                                    <thead>
                                      <tr>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Fill NAME</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Sub totsl</th>
                                        <th scope="col">total</th>
                                        <th scope="col">CREATED AT</th>
                                        <th scope="col">Download Invoice</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                
                                      @foreach($customer_order as  $index=> $customer_orders)
                                      <tr>
                                        <td>{{$customer_orders->id}}</td>
                                        <td>{{$customer_orders->full_name}}</td>
                                        <td>{{$customer_orders->address}}</td>
                                        <td>{{$customer_orders->sub_total}}</td>
                                        <td>{{$customer_orders->total}}</td>
                                        <td>{{$customer_orders->created_at->format('d/m/Y h:i:s A')}}</td>
                                        {{-- <td>{{$customer_orders->updated_at->format('d/m/Y h:i:s A')}}</td> --}}
                                        <td>
                                          <a href="{{ url('order/download') }}/{{ $customer_orders->id }}"class="btn btn-success">Download</a>
                                          <a href="{{ url('send/sms') }}/{{ $customer_orders->id }}"class="btn btn-info">Send Sms</a>
                                        </td>
                                      </tr>
                                      @endforeach


                                    </tbody>
                                  </table>
                                  {{-- {{$customer_orders->links()}} --}}

                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
