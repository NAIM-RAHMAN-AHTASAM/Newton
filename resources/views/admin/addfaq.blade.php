@extends('layouts.dashboard')

@section('title')
  Add Faq
@endsection
@section('addfaq')
  active
@endsection
@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ route('home') }}">Home Page</a>
        <span class="breadcrumb-item active">Add Faq  Page</span>
  </nav>


@endsection




@section('content')
<div class="container">
  <div class="row">
    <div class="col-lg-8">

    {{-- @if (session('status') )

      <div class="alert alert-success">
        {{session('status') }}
      </div>
    @endif --}}
    {{-- @if (session('deletestatus') )

      <div class="alert alert-danger">
        {{session('deletestatus') }}
      </div>
    @endif --}}


      <div class="card">
        <div class="card-header">
          <h1>Faq List</h1>
          <table class="table table-dark">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">question</th>
                            <th scope="col">Answer</th>
                            <th scope="col">created_at</th>
                            <th scope="col">Last updated_at</th>
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>

                          @forelse($faqs as $faq)
                          <tr>

                            <td>{{$loop->index+1}}</td>
                            <td>{{$faq->faq_question}}</td>
                            <td>{{$faq->faq_answer}}</td>
                            <td>
                              @if (isset($faq->created_at))
                                {{$faq->created_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif
                            </td>
                            <td>
                              @if (isset($faq->updated_at))
                                {{$faq->updated_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif


                            </td>
                            <td>

                              <a href="{{ url('/faq/edit') }}/{{ $faq->id }}"class="btn btn-info btn-sm">Edit</a>
                              <a href="{{ url('/faq/delete') }}/{{ $faq->id }}"class="btn btn-danger btn-sm">Soft_Delete</a>
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
      <div class="card">
        <div class="card-header">
          <h1>Faq List</h1>
          <table class="table table-dark">
                        <thead>
                          <tr>
                            <th scope="col">ID</th>
                            <th scope="col">question</th>
                            <th scope="col">Answer</th>
                            <th scope="col">created_at</th>
                            <th scope="col">Last updated_at</th>
                            <th scope="col">Action</th>

                          </tr>
                        </thead>
                        <tbody>

                          @forelse($soft_deleted_faqs as $soft_deleted_faq)
                          <tr>

                            <td>{{$loop->index+1}}</td>
                            <td>{{$soft_deleted_faq->faq_question}}</td>
                            <td>{{$soft_deleted_faq->faq_answer}}</td>
                            <td>
                              @if (isset($soft_deleted_faq->created_at))
                                {{$soft_deleted_faq->created_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif
                            </td>
                            <td>
                              @if (isset($soft_deleted_faq->updated_at))
                                {{$soft_deleted_faq->updated_at->format('d/m/y h/i/s A')}}
                                @else
                                  --
                              @endif


                            </td>
                            <td>

                              <a href="{{ url('faq/restore') }}/{{ $soft_deleted_faq->id }}"class="btn btn-success btn-sm">Restore</a>
                              <a href="{{ url('/faq/hard/delete') }}/{{ $soft_deleted_faq->id }}"class="btn btn-danger btn-sm"><h1></h1>Haed Delete</a>
                            </td>


                          </tr>
                          @empty
                          <td colspan="3"class="text center text-danger">No Data Available</td>
                          @endforelse


                        </tbody>
                      </table>
        </div>

      </div>












    </div>
    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">

          {{-- @if ($errors->all())
            <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <li>{{  $error}}</li>
          @endforeach

            </div>
          @endif --}}





          <form action="{{url('add/faq/post')}}"method="post">
            @csrf
              <div class="form-group">
                <label for="question">Question</label>
                <input type="text" class="form-control" id="question" placeholder="Enter Question"name="faq_question" value="{{ old('faq_question')}}">
                @error ('faq_question')
                    <small class="text-danger">{{$message}}</small>
                @enderror

              </div>
              <div class="form-group">
                <label for="answer">Answer</label>

                <textarea class="form-control"rows="4" id="answer"placeholder="Enter Answer"name="faq_answer">{{ old('faq_answer') }}</textarea>
                @error ('faq_answer')
                    <small class="text-danger">{{$message}}</small>
                @enderror
              </div>

              <button type="submit" class="btn btn-success">Add FAQ</button>
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
