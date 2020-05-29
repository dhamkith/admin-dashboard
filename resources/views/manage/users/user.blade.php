@extends('layouts.admin_dash')

@section('content')
<div class="column is-media-margin-l cf">

    <div class="column is-full-desktop is-full-tablet is-full-mobile box-shadow box-back-color float-l">
      <div class="p-20">
        <p class="is-size-4">Edit User</p>
        <small>Edit User</small>
      </div>
      @include('partials.massages') 
    </div>

    <div class="lists-wrapper column is-full-desktop is-full-tablet is-full-mobile box-back-color float-l">

      <form role="form" class="form-horizontal p-20" method="POST" action="{{ route('manage.user.update', $user->id) }}">

        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="columns is-multiline is-touch">

            <div class="column">

                <div class="field">
                    <label class="label">Name</label>
                    <div class="control">
                        <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="text" name="name" value="{{ $user->name }}" required autofocus>
                    </div>
                    @if ($errors->has('name'))
                        <span class="help is-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="field">
                    <label class="label">E-Mail Address</label>
                    <div class="control">
                        <input class="input {{ $errors->has('name') ? ' is-danger' : '' }}" type="email" placeholder="Email" disabled="disabled" value="{{ $user->email }}">
                    </div>
                    @if ($errors->has('name'))
                        <span class="help is-danger">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div> 
                
                <div class="field">
                    <label class="label">Last login ips</label>
                    <div class="control">
                        <a id="get-userlogin-ips" href="javascript:void(0);" class="button is-primary is-small is-outlined" data-userId="{{$user->id}}">show login ips</a>
                    </div> 
                </div>

                
                <div class="field p-b-19">
                    <div class="control p-t-10">
                        <label class="radio">
                        <input type="radio" v-model="password_options" name="password_options" value="keep" checked>
                        Do Not Change Password
                        </label>
                    </div>
                    <div class="control">  
                        <label class="radio p-t-10">
                        <input type="radio" v-model="password_options" name="password_options" value="auto">
                        Auto generate Password
                        </label>
                    </div>  
                    <div class="control">  
                        <label class="radio p-t-10">
                        <input  type="radio" v-model="password_options" name="password_options" value="manual">
                        Manualy Set New Password
                        </label>
                    </div> 
                </div>
    
                <div class="field" v-if="password_options == 'manual' ">
                    <label class="label">Password</label>
                    <div class="control">
                        <input class="input" type="password" name="password" placeholder="Password">
                    </div>
                </div>

                <div class="field"> 
                    <?php $banned_until = $user->banned_until ? date_format($user->banned_until, 'Y-m-d') : '';?>
                    <label class="checkbox checkbox-wrapper">
                        <li class=""><span class="fa-li"><i class="fas fa-dot-circle"></i></span> User Suspend</li>
                        <div class="slide">  
                            <input type="checkbox" name="suspend" <?php if ($banned_until) { echo 'checked';}?> value="suspend">
                            <label for="slide"></label>
                        </div>
                    </label>
                    <div class="m-b-10 p-t-10"><small class="is-hidden-mobile"> ( Banned Until ) </small></div>
                    <div class="control p-t-10">
                        <input class="input" type="date" name="banned_until" value="{{$banned_until}}">
                    </div>
                </div> 

            </div>

            <div class="column">


                <div class="field">
                    <ul class="fa-ul">
                    <label class="label">Roles</label>
                    @foreach ( $roles as $role )
                        <div class="control p-t-15 m-5">
                            <label class="checkbox checkbox-wrapper">
                                <li class=""><span class="fa-li"><i class="fas fa-dot-circle"></i></span>{{$role->name}}<small class="is-hidden-mobile"> ( slug: {{$role->name}} )</small></li>
                                
                                <div class="slide">  
                                    <input type="checkbox" v-model="roleSelected" name="roles[]" :checked="roleSelected" :value="{{$role->id}}">
                                    <label for="slide"></label>
                                </div>
                            </label>
                        </div> 
                    @endforeach  
                    </ul>
                </div>

            </div>

        </div> 
        <div class="field p-t-10 p-b-40">
            <div class="control">
                <button type="submit" class="button is-primary round-btn">Save changes <i class="fa fa-save m-l-10"></i></button>
            </div>
        </div> 
        
    </form>
    </div> 
    <div id="append-modal" class="columns is-multiline is-touch"></div>
</div>

@endsection

@section('scripts')

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                password_options: 'keep',
                roleSelected: {!! $user->roles->pluck('id') !!}
            }
        })
    </script>

@endsection