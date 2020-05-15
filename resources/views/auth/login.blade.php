@extends('layouts.app')

@section('content')
<div class="container">
    <div class="columns is-multiline is-touch is-desktop">
        <div class="column is-6-touch is-offset-3-touch is-4-desktop is-offset-4-desktop login-cutomize">
            @include('partials.massages')
            <div class="label login-title">{{ __('Login') }}</div>
            <form  class="form-cutomize" method="POST" action="{{ route('login') }}">
                 @csrf

                 <div class="field">

                    <label class="label">{{ __('E-Mail Address') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="email" id="email" type="email" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        <span class="icon is-small is-left"><i class="fa fa-envelope"></i></span>
                    </div>
                    @error('email')
                        <p class="help is-danger" >{{ $message }}</p>
                    @enderror
                    
                </div>

                    <div class="field">

                        <label class="label">{{ __('Password') }}</label>
                        <div class="control has-icons-left has-icons-right">
                            <input v-model="password" id="password" type="password" class="input @error('password') is-danger @enderror" name="password" required autocomplete="current-password">
                            <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                        </div>
                        @error('password')
                            <p class="help is-danger" >{{ $message }}</p>
                        @enderror

                   </div>

                <div class="field">

                    <div class="control">
                        <label class="checkbox">
                        <input type="checkbox">
                        {{ __('Remember Me') }}
                        </label>
                    </div>

                </div>

                <div class="field is-grouped">

                    <div class="control">
                        <button  :disabled="disabledLogin" v-on:click="isLoginSubmited()" v-bind:class="isLodingClass" type="submit" class="button is-primary round-btn-full-width">Submit</button>
                    </div>

                </div>

                @if (Route::has('password.request'))
                    <div class="field">
                        <div class="control">
                            <label class="">{{ __('Forgot Your Password ?') }} <a href="{{ route('password.request') }}">Click here</a></label>
                        </div>
                        <div class="control"> 
                            <label class="">{{ __('Sign up ') }} <a href="{{ route('register') }}">Click here</a></label>
                        </div>
                    </div>
                @endif
                
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                email: '',
                password: '',
                loding: false
            },
            methods: {
                isLoginSubmited() {
                    if ( this.name && this.password.length > 7
                        && ( this.email && this.validateEmail( this.email ) )) {
                        this.loding = true;
                    }
                },
                validateEmail(email) {
                    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(String(email).toLowerCase());
                }
            },
            computed: {
                isLodingClass: function () {
                    return {
                        'is-loading': this.loding
                    }
                },
                disabledLogin: function () {
                    return !this.password || !this.email
                }

            }
        });
    </script>
    
@endsection
