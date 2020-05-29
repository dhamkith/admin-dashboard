@extends('layouts.admin_dash')

@section('content')
  @php 
    $is_model = 'user_send_message';
    $header_title = 'user message';
    $header_sub_title = 'message';
    $show_route = 'admin.user.message.show';
    $action_selected_route = 'admin.user.reply.destroy';
    $action_input_name = 'destroy_send_msgs';
    $datas = $usermessages;
    $data_notfound_massage = 'indox is empty';
    $fa_icon_01 = 'envelope';
    $fa_icon_02 = 'envelope-open';
  @endphp
  @include('partials.list-views.default-lists')
@endsection 

@section('scripts') 
  @include('partials.list-views.vue-default-lists') 
@endsection