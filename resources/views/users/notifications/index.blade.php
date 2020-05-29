@extends('layouts.user_dash')

@section('content')
  @php 
    $is_model = 'notification';
    $header_title = 'All the notifications';
    $header_sub_title = 'All the notifications';
    $show_route = 'user.notification.show';
    $action_selected_route = 'user.notification.delete.selected';
    $action_input_name = 'destroy_notifications';
    $datas = $notifications;
    $data_notfound_massage = 'notifications indox is empty'; 
    $fa_icon_01 = 'user';
    $fa_icon_02 = 'user';
  @endphp 
  @include('partials.list-views.default-lists')
  @endsection 
  
  @section('scripts') 
    @include('partials.list-views.vue-default-lists') 
  @endsection
 