@extends('layouts.admin_dash')

@section('content')

@section('content') 
    @php  
        $is_roles = false; 
        $header_title = "Permissions";
        $header_sub_title = 'role permissions';
        $header_btn_text = 'create permission';
        $datas = $permissions;
        $edit_route = 'permissions.edit';
        $delete_route = 'permissions.destroy';
        $data_notfound_massage = 'Permission not yet Create';
        $model_text = 'Permission';
    @endphp
    @include('manage.partials-role-permission.roles-permissions')
@endsection
@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
              isModalActive: false,
              name: '',
              slug: '',
              errors: [],
              message: '',
            },
            methods: {
              modelOpen () {
                this.isModalActive = true
              },
              modelCloce () {
                this.isModalActive = false
              },
              roleOrpermissionCreate () {
                axios.post("{!!asset('')!!}manage/permission/create", {
                    name: this.name,
                    slug: this.slug }
                ).then( response => {
                    if (response.data.validator === true){
                        this.isModalActive = false
                        window.location.reload(true)
                    } else {
                        //console.log(response.data.response)
                        this.errors  = response.data.response
                    }
                }).catch(({ response }) => {
                    this.message = response.statusText +': Duplicate entry key slug'
                });  
              }

            },
            computed: {
                classObject: function () {
                    return {
                        'is-danger': this.message
                    }
                }
            }
        })
    </script>

@endsection