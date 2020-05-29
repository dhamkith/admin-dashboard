@extends('layouts.admin_dash')

@section('content')
    @php  
    $is_edit_role = false; 
    $header_title = "Edit Permission";
    $header_sub_title = 'Edit Role Permission';
    $form_action_route = 'permissions.update';
    $data = $permission;
    @endphp
    @include('manage.partials-role-permission.edit') 
@endsection

@section('scripts')
<script>
    var app = new Vue({
        el: '#app',
        data: { 
            loding: false
        },
        methods: {
            isLoginSubmited() {
                this.loding = true;
            } 
        },
        computed: {
            isLodingClass: function () {
                return {
                    'is-loading': this.loding
                }
            }  
        }
    })
  </script>
  @endsection

