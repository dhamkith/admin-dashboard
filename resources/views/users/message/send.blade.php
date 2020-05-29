@extends('layouts.user_dash')

@section('content')
  @php 
    $is_model = 'user_send_massage';
    $header_title = 'send Massages';
    $header_sub_title = 'send Massages';
    $show_route = 'user.send.message.show';
    $action_selected_route = 'send.messages.destroy.selected';
    $action_input_name = 'destroy_send_msgs';
    $datas = $usersendmessages;
    $data_notfound_massage = 'send message empty';
    $fa_icon_01 = 'paper-plane';
    $fa_icon_02 = 'paper-plane';
  @endphp
  @include('partials.list-views.default-lists')
@endsection 

@section('scripts') 
  @include('partials.list-views.vue-default-lists') 
@endsection