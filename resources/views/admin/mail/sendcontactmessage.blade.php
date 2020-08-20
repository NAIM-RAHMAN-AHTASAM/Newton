

{{-- @php
  print_r($name);
  print_r($email);
  print_r($subject);
  // print_r($message);
@endphp --}}



<h1>Hellow Admin, Your Customer send a message: </h1>
  <h3> Customer Name :</h3>
  {{ $name}}
  <h3>Customer Email Id:</h3>
  {{ $email }}
  <h3> Customer Message Subject:</h3>
  {{ $subject }}
  <h3>Customer send message :</h3>
  {{$contact_message}}
