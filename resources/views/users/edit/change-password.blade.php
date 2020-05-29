@extends('layouts.user_dash')

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
 
            <form class="columns is-multiline is-mobile is-desktop is-tablet" method="POST" action="{{ route('user.change.password') }}">
                    {{ csrf_field() }}          
                    {{ method_field('PUT') }} 
                        <div class="column is-8-desktop is-8-tablet is-offset-2-tablet is-offset-2-desktop is-12-mobile p-t-20">  
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input  type="text"
                                            name="name"
                                            value="Name: {{ $user->name }}"
                                            class="input {{ $errors->has('name') ? ' is-danger' : '' }}" 
                                            disabled="disabled">
                                </div> 
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                    <div class="control column is-12-desktop p-t-0"> 
                                    <input type="text"
                                            name="email"
                                            value="email: {{ $user->email }}"
                                            class="input {{ $errors->has('email') ? ' is-danger' : '' }}" 
                                            disabled="disabled">
                                </div> 
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">Current Password</label>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="password"
                                            name="current_password" 
                                            class="input {{ $errors->has('current_password') ? ' is-danger' : '' }}" 
                                            placeholder="Current Password"  required autofocus>
                                </div>
                                @if ($errors->has('current_password'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('current_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">New Password</label>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input type="password"
                                            name="password" 
                                            class="input {{ $errors->has('password') ? ' is-danger' : '' }}" 
                                            placeholder="New Password"  required autofocus>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="field columns is-multiline is-mobile is-desktop is-tablet">
                                <label class="label column is-12-desktop is-12-mobile is-12-tablet is-size-9-0 p-b-0">Confirm Password</label>
                                <div class="control column is-12-desktop p-t-0"> 
                                    <input  type="password"
                                            name="password_confirmation" 
                                            class="input {{ $errors->has('password_confirmation') ? ' is-danger' : '' }}" 
                                            placeholder="Confirm Password"  required autofocus>
                                </div>
                                @if ($errors->has('password_confirmation'))
                                    <span class="help is-danger">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="field p-t-0 p-b-40">
                                <div class="control">
                                    <button type="submit" class="button is-primary round-btn">Save changes <i class="fa fa-save m-l-10"></i></button>
                                </div>
                            </div>
                        </div> 
            </form> 
    </div>  
</div>

@endsection

@section('scripts')

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                password_options: 'keep'
            }
        })
    </script>

@endsection