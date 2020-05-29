@extends('layouts.admin_dash')

@section('content')
@if ( $user ) 
  @php 
    $user = $user;
    $admin_reply = true;
    $header_title = "send messages to: $user->name";
    $header_sub_title = 'send messages to: Admin';
    $form_action_route = 'admin.message.reply';
 
  @endphp
  @include('partials.message.create')
@endif
@endsection 

@section('scripts') 
  @include('partials.message.vue-message-create') 
@endsection 