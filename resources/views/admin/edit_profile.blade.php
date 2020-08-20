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
      <div class="col-md-6 m-auto">
        <div class="card">
          <div class="card-header">
            <h1>Change Password</h1>

        <form action="{{ route('change_password') }}" method="post">
              @csrf
              {{-- <input type="hidden" name="faq_id" value=""> --}}
                <div class="form-group">

                  <label for="password1">old Password</label>
                  <input type="password" class="form-control" id="password1" placeholder="Enter old password"name="old_password">
                </div>
                <div class="form-group">

                  <label for="password2">New Password</label>
                  <input type="password" class="form-control" id="password2" placeholder="Enter New password"name="password">
                </div>
                <div class="form-group">

                  <label for="password3">Confirm Password</label>
                  <input type="password" class="form-control" id="password3" placeholder="Enter confirm password"name="password_confirmation">
                </div>

                <button type="submit" class="btn btn-info">Change</button>
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
