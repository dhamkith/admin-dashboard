@extends('layouts.admin_dash')

@section('content')
<div class="column is-media-margin-l cf">

  <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="p-20">
      <p class="is-size-4">message</p> 
      @include('partials.massages') 
    </div> 
  </div>

  <div class="m-t-20 column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
    <div class="message-view">
      @if ( $usermessage ) 
        @php $user = App\User::find($usermessage->user_id); @endphp
        <div class="p-l-20 p-r-20 p-t-6"><small>subject : {{$usermessage->subject}}</small></div>
        <div class="p-l-20 p-r-20"><small>form : < {{$usermessage->email}} ></small></div>
        <div class="p-l-20 p-r-20"><small>created_at : {{$usermessage->created_at}}</small></div>
        <div class="p-l-20 p-r-20"><small>name : {{$usermessage->name}}</small></div>
        <div class="p-20 is-size-5"><strong>{{$usermessage->subject}} </strong> ,</div>
        <div class="p-20"><small>{{$usermessage->message}}</small></div>
        @if($usermessage->sendable_id !== null)
        <div class="p-20 p-t-20 p-b-30"><a href="{{ route('admin.message.reply.veiw', $usermessage->sendable_id)}}" class="button is-primary round-btn wellcome-start">send new message</a></div>
        @endif
      @endif
    </div>
  </div> 

</div>  
@endsection