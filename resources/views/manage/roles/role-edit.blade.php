@extends('layouts.admin_dash')

@section('content')
    @php  
        $is_edit_role = true; 
        $header_title = "Edit Role";
        $header_sub_title = 'Edit user role';
        $form_action_route = 'roles.update';
        $data = $role;
    @endphp
    @include('manage.partials-role-permission.edit')
@endsection

@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                loding: false,
                permissionSelected: {!! $role->permissions->pluck('slug') !!}
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
