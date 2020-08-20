@extends('layouts/dashboard')

@section('breadcrumb')

  <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{ url('/add/faq') }}">Add Faq Page</a>
        <span class="breadcrumb-item active">{{ $faq->faq_question}}</span>
      </nav>


@endsection





@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
      
      </div>

    </div>
    <div class="row">
      <div class="col-md-6 m-auto">
        <div class="card">
          <div class="card-header">
            <h1>Edit FAQ</h1>

        <form action="{{url('faq/edit/post')}}"method="post">
              @csrf
              <input type="hidden" name="faq_id" value="{{ $faq->id}}">
                <div class="form-group">

                  <label for="question">Question</label>
                  <input type="text" class="form-control" id="question" placeholder="Enter Question"name="faq_question" value="{{ $faq->faq_question}}">
                </div>
                <div class="form-group">
                  <label for="answer">Answer</label>

                  <textarea class="form-control"rows="4" id="answer"placeholder="Enter Answer"name="faq_answer">{{ $faq->faq_answer}}</textarea>
                </div>

                <button type="submit" class="btn btn-warning"> FAQ EDIT</button>
            </form>
          </div>

        </div>

      </div>

    </div>

  </div>

@endsection
