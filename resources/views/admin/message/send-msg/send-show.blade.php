@extends('layouts.admin_dash')

@section('content')
@if ( $adminsend ) 
<div class="column is-media-margin-l cf">

  <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="p-20">
      <p class="is-size-4">send to: <a href="{{ route('manage.user.edit', $user->id )}}">{{$user->name}}</a></p> 
      @include('partials.massages') 
    </div> 
  </div>

  <div class="m-t-20 column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="message-view">
      <div class="p-l-20 p-r-20 p-t-6"><small>subject : {{$adminsend->subject}}</small></div>
      <div class="p-l-20 p-r-20"><small>form : < {{$adminsend->email}} ></small></div>
      <div class="p-l-20 p-r-20"><small>created_at : {{$adminsend->created_at}}</small></div>
      <div class="p-l-20 p-r-20"><small>name : {{$adminsend->name}}</small></div>
      <div class="p-20 is-size-5"><strong>{{$adminsend->subject}} </strong> ,</div>
      <div class="p-20"><small>{{$adminsend->message}}</small></div>
      @if($adminsend->sendable_id !== null)
      <div class="p-20 p-t-20 p-b-30"><a href="{{ route('admin.message.reply.veiw', $adminsend->sendable_id)}}" class="button is-primary round-btn wellcome-start">send new message</a></div>
      @endif
    </div>
  </div> 

</div>  
@endif
@endsection