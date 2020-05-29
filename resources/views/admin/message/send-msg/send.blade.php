@extends('layouts.admin_dash')

@section('content')
  @php 
    $is_model = 'user_send_message';
    $header_title = 'Admin Send';
    $header_sub_title = 'messages';
    $show_route = 'admin.message.reply.show';
    $action_selected_route = 'admin.message.reply.delete.selected';
    $action_input_name = 'send_ids';
    $datas = $adminsends;
    $data_notfound_massage = 'indox is empty';
    $fa_icon_01 = 'envelope';
    $fa_icon_02 = 'envelope-open';
  @endphp
  @include('partials.list-views.default-lists')
@endsection 

@section('scripts') 
  @include('partials.list-views.vue-default-lists') 
@endsection