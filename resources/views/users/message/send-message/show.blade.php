@extends('layouts.user_dash')

@section('content')
<div class="column is-media-margin-l cf">

  <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="p-20">
      <p class="is-size-4">send messages</p> 
      @include('partials.massages') 
    </div> 
  </div>
  @if ( $sendmessages ) 
  <div class="m-t-20 column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="message-view">
      <div class="p-l-20 p-r-20 p-t-6"><small>subject : {{$sendmessages->subject}}</small></div>
      <div class="p-l-20 p-r-20"><small>form : < {{$sendmessages->email}} ></small></div>
      <div class="p-l-20 p-r-20"><small>created_at : {{$sendmessages->created_at}}</small></div>
      <div class="p-l-20 p-r-20"><small>name : {{$sendmessages->name}}</small></div>
      <div class="p-20 is-size-5"><strong>{{$sendmessages->subject}} </strong> ,</div>
      <div class="p-20"><small>{{$sendmessages->message}}</small></div>
    </div>
  </div> 
  @endif

</div>  
@endsection