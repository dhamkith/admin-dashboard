@extends('layouts.admin_dash')

@section('content')
  @php 
    $is_model = 'contact_us';
    $header_title = 'Inbox';
    $header_sub_title = 'Massages';
    $show_route = 'admin.message.view';
    $action_selected_route = 'contact.destroy';
    $action_input_name = 'destroy_msgs';
    $datas = $messages;
    $data_notfound_massage = 'indox is empty';
    $fa_icon_01 = 'envelope';
    $fa_icon_02 = 'envelope-open';
  @endphp
  @include('partials.list-views.default-lists')
@endsection 

@section('scripts') 
  @include('partials.list-views.vue-default-lists') 
@endsection