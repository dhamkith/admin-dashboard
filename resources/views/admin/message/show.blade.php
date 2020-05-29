@extends('layouts.admin_dash')

@section('content')
<div class="column is-media-margin-l cf">

  <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="p-20">
      <p class="is-size-4">contact message</p> 
      <small>contact message</small>
      @include('partials.massages') 
    </div> 
  </div>

  <div class="m-t-20 column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="message-view">
      @if ( $message ) 
        <div class="p-l-20 p-r-20 p-t-6"><small>subject : {{$message->subject}}</small></div>
        <div class="p-l-20 p-r-20"><small>form : < {{$message->email}} ></small></div>
        <div class="p-l-20 p-r-20"><small>created_at : {{$message->created_at}}</small></div>
        <div class="p-l-20 p-r-20"><small>name : {{$message->name}}</small></div>
        <div class="p-20 is-size-5"><strong>{{$message->subject}} </strong> ,</div>
        <div class="p-20"><small>{{$message->message}}</small></div>
        @if($message->massagable_id !== null)
        <div class="p-20 p-t-20 p-b-30"><a href="{{ route('admin.message.reply.veiw', $message->massagable_id)}}" class="button is-primary round-btn wellcome-start">reply</a></div>
        @endif
      @endif
    </div>
  </div> 

</div>  
@endsection