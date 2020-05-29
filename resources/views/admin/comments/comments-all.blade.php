@extends('layouts.admin_dash')

@section('content')
  @php 
    $is_model = 'comment';
    $header_title = 'Comments';
    $header_sub_title = 'all comments';
    $show_route = 'admin.message.view';
    $action_selected_route = 'contact.destroy';
    $action_input_name = 'comment_ids';
    $datas = $comments;
    $data_notfound_massage = 'data not found';
    $fa_icon_01 = 'comments';
    $fa_icon_02 = 'comments';
  @endphp
  @include('partials.list-views.default-lists')
@endsection 

@section('scripts') 
  @include('partials.list-views.vue-default-lists') 
@endsection