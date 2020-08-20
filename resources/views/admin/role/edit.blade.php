
@extends('layouts.dashboard')

<!-- @section('title')
  Add Faq
@endsection -->
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
    <div class="col-lg-5 m-auto">
      <div class="card mb-5 ">
        <div class="card-header">
          Change Permission -{{ $users->name }}
        </div>
        <div class="card-header">


          @if ($errors->all())
            <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{  $error}}</li>
          @endforeach

            </div>
          @endif



          <form action="{{route('role.permission.edit.post')}}" method="post">
            @csrf


              <div class="form-group">
                <label >select permission</label>
                <input type="hidden" name="user_id" value="{{$users->id}}">
                @foreach ($permissions as $permission)

                  <label class="ckbox">
                      <input {{ ($users->hasPermissionTo($permission->name)) ? "checked":"" }} type="checkbox"name="permission[]" value="{{$permission->name}}">
                      <span>{{$permission->name}}</span>
                    </label>

                @endforeach
              </div>

              <button type="submit" class="btn btn-success">Add Role</button>
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
