@extends('layouts.login')

@section('content')

<div class="container">
    <div class="columns is-multiline is-touch is-desktop">
        <div class="column is-6-touch is-offset-3-touch is-4-desktop is-offset-4-desktop login-cutomize">
        @include('partials.massages')
        <div class="label login-title">{{ __('Admin Reset Password') }}</div>

            <form  class="form-cutomize" method="POST" action="{{ route('admin.password.request') }}">
                 @csrf
                 <input type="hidden" name="token" value="{{ $token }}">

                <div class="field">

                    <label class="label">{{ __('E-Mail Address') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input  v-model="email" type="email" placeholder="Email"class="input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required>
                        <span class="icon is-small is-left"><i class="fa fa-envelope"></i></span>
                    </div>
                    @error('email')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror
                    
                </div>

                <div class="field">

                    <label class="label">{{ __('Password') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="password" type="password" placeholder="Password" class="input @error('password') is-invalid @enderror" name="password" required>
                        <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                    </div>

                    @error('password')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror

                </div>

                <div class="field">

                    <label class="label">{{ __('Confirm Password') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="confirm" type="password" placeholder="Confirm Password" class="input @error('password') is-invalid @enderror"  name="password_confirmation" required>
                        <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                    </div>

                </div>


                <div class="field is-grouped">

                    <div class="control">
                        <button :disabled="disabledReset" v-on:click="isRegeSubmited()" v-bind:class="isLodingClass" type="submit" class="button is-primary round-btn-full-width m-t-15"> {{ __('Reset Password') }}</button>
                    </div>

                </div>

                
                
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
                confirm: '',
                loding: false
            },
            methods: {
                isRegeSubmited() {
                    if ( this.password.length > 7
                        && ( this.email && this.validateEmail( this.email ) )
                        && ( this.confirm && ( this.confirm === this.password ) ) ) {
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
                disabledReset: function () {
                    
                    return !this.password || !this.email || !this.confirm
                    
                }

            }
        })
    </script>
    
@endsection
