@extends('layouts.frontend')

@section('contact')
active
@endsection
@section('content')
  <!-- .breadcumb-area start -->
     <div class="breadcumb-area bg-img-4 ptb-100">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                     <div class="breadcumb-wrap text-center">
                         <h2>Frequently Asked Questions (FAQ)</h2>
                         <ul>
                             <li><a href="{{ url('/') }}">Home</a></li>
                             <li><span>FAQ</span></li>
                         </ul>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- .breadcumb-area end -->
     <!-- about-area start -->
     <div class="about-area ptb-100">
         <div class="container">
             <div class="row">
                 <div class="col-12">
                   <div class="about-wrap text-center">
                     <h3>FAQ</h3>
                   </div>
                   <div class="accordion" id="accordionExample">
                     @php
                       $flag = 1;
                     @endphp
                     @foreach ($faqs as $faq)

                       <div class="card border-0">
                       <div class="card-header border-0 p-0 my-3">
                           <button class="btn btn-link text-left py-3 w-100 text-white {{($flag == 1)? 'collapse show':''  }}" type="{{($flag == 1)? 'collapse':''}}" data-toggle="collapse" data-target="#faq{{$faq->id}}" aria-expanded="true" aria-controls="faq{{$faq->id}}">
                             
                             {{$faq->faq_question}}
                           </button>
                       </div>

                       <div id="faq{{$faq->id}}" class="collapse {{($flag == 1)? 'show':''  }}" aria-labelledby="faq{{$faq->id}}" data-parent="#accordionExample">
                         <div class="card-body">
                           {{$faq->faq_answer}}
                         </div>
                       </div>
                     </div>
                     @php
                       $flag++;
                     @endphp
                     @endforeach

                   </div>
                 </div>
             </div>
         </div>
     </div>
     <!-- about-area end -->

@endsection
