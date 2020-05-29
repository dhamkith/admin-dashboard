@extends('layouts.user_dash')

@section('content')
@if ( $user ) 
  @php 
    $user = $user;
    $admin_reply = false;
    $header_title = 'send messages to: Admin';
    $header_sub_title = 'send messages to: Admin';
    $form_action_route = 'user.send.message.store';
 
  @endphp
  @include('partials.message.create')
@endif
@endsection 

@section('scripts') 
  @include('partials.message.vue-message-create') 
@endsection 
