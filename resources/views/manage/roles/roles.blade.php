@extends('layouts.admin_dash')

@section('content') 
    @php  
        $is_roles = true; 
        $header_title = "User Roles";
        $header_sub_title = 'User Roles';
        $header_btn_text = 'create role';
        $datas = $roles;
        $edit_route = 'roles.edit';
        $delete_route = 'role.destroy';
        $data_notfound_massage = 'Roles not yet Create';
        $model_text = 'Role';
    @endphp
    @include('manage.partials-role-permission.roles-permissions')
@endsection

@section('scripts')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
              isModalActive: false,
              slug: '',
              name: '',
              errors: [],
              message: ''
            },
            methods: {
              modelOpen () {
                this.isModalActive = true
              },
              modelCloce () {
                this.isModalActive = false
              },
              roleOrpermissionCreate () {
                axios.post('{!!asset('')!!}manage/role/create', {
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
