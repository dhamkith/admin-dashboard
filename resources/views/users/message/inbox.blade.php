@extends('layouts.user_dash')

@section('content')
  @php 
    $is_model = 'admin_send_massage';
    $header_title = 'User Massages';
    $header_sub_title = 'User Massages';
    $show_route = 'user.message.show';
    $action_selected_route = 'user.message.markasdelete';
    $action_input_name = 'mark_as_delete';
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