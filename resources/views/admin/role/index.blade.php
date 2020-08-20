@php
  error_reporting(0);
@endphp
@extends('layouts.dashboard')

 @section('title')
  Add Role
@endsection
@section('role')
  active
@endsection
@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home</a>
        <span class="breadcrumb-item active">Add Role</span>
  </nav>


@endsection




@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-7 offset-3">

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


<!-- ai khan a hobe -->
<div class="card">
  <div class="card-header">
    <h1>Role List</h1>
    <table class="table table-dark">
                  <thead>
                    <tr>

                      <th scope="col">ID</th>
                      <th scope="col">role Name</th>
                      <th scope="col">permission</th>


                    </tr>
                  </thead>
                  <tbody>

                      @forelse($roles as $role)


                      <tr>

                        <td>{{$loop->index+1}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                          @foreach ($role->getPermissionNames() as $permission)
                            <li>{{ $permission }}</li>
                          @endforeach
                        </td>
                      </tr>
                      @empty
                      <td colspan="3"class="text center text-danger">No Data Available</td>
                      @endforelse




                  </tbody>
                </table>
  </div>
                  <div class="card-header">
                  <h1>Assign Role List</h1>
                  <table class="table table-dark">
                  <thead>
                    <tr>

                      <th scope="col">ID</th>
                      <th scope="col">user Name</th>
                      <th scope="col">role</th>
                      <th scope="col">permission</th>
                      <th scope="col">Action</th>

                    </tr>
                  </thead>
                  <tbody>

                      @forelse($users as $user)


                      <tr>

                        <td>{{$loop->index+1}}</td>
                        <td>{{$user->name}}</td>
                        <td>
                          @foreach ($user->getRoleNames() as $role)

                            <li>{{ $role }}</li>
                          @endforeach
                        </td>
                        <td>
                          @foreach ($user->getAllPermissions() as $permission)
                            <li>{{ $permission->name }}</li>
                          @endforeach
                        </td >
                        <td>
                          <a href="{{ url('role/permission/edit') }}/{{ $user->id }}" class="btn btn-info">Edit</a>
                        </td>
                      </tr>
                      @empty
                      <td colspan="3"class="text center text-danger">No Data Available</td>
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


<br>

    </div>



    <div class="col-lg-5">
      <div class="card mb-5">
        <div class="card-header">
          Add Role
          @if ($errors->all())
            <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{  $error}}</li>
          @endforeach

            </div>
          @endif



          <form action="{{route('role.add')}}"method="post">
            @csrf

            <div class="form-group">
                <label for="role_name">Role Name</label>
                <input type="text" class="form-control" id="role_name" placeholder="Enter Role Name" name="role_name" >


              </div>
              <div class="form-group">
                <label >select permission</label>
                @foreach ($permissions as $permission)
                  <label class="ckbox">
                      <input type="checkbox"name="permission[]" value="{{$permission->name}}">
                      <span>{{$permission->name}}</span>
                    </label>

                @endforeach
              </div>

              <button type="submit" class="btn btn-success">Add Role</button>
          </form>
        </div>

      </div>
      <div class="card" >
        <div class="card-header">
          Assign Role

          @if ($errors->all())
            <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{  $error}}</li>
          @endforeach

            </div>
          @endif



          <form action="{{route('role.assign')}}"method="post">
            @csrf
            <div class="form-group">
                <label for="role_name">User Name</label>
              <select class="form-control" name="user_id">
                <option value="">select one</option>
                @foreach ($users as $user)
                  <option value="{{ $user->id}}">{{ $user->name}}</option>
                @endforeach
              </select>
              </div>

            <div class="form-group">
                <label for="role_name">Role Name</label>
              <select class="form-control" name="role_name">
                <option value="">select one</option>
                @foreach ($roles as $role)
                  <option value="{{ $role->name}}">{{ $role->name}}</option>
                @endforeach
              </select>
              </div>

          <button type="submit" class="btn btn-success">Assign Role</button>
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
