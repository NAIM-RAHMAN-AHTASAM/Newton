@extends('layouts.dashboard')

@section('title')
Home
@endsection
@section('home')
active
@endsection

@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">

      <span class="breadcrumb-item active">Home Page</span>
  </nav>


@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Total users:{{$users->total()}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <table class="table table-dark">
                                  <thead>
                                    <tr>
                                      <th scope="col">ID</th>
                                      <th scope="col">NAME</th>
                                      <th scope="col">EMAIL</th>
                                      <th scope="col">CREATED AT</th>
                                      <th scope="col">UPDATED AT</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    @foreach($users as $index => $user)
                                    <tr>
                                      <td>{{$users->firstItem() + $index}}</td>
                                      <td>{{$user->name}}</td>
                                      <td>{{$user->email}}</td>
                                      <td>{{$user->created_at->format('d/m/Y h:i:s A')}}</td>
                                      <td>{{$user->updated_at->format('d/m/Y h:i:s A')}}</td>

                                    </tr>
                                    @endforeach


                                  </tbody>
                                </table>
                                {{$users->links()}}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
