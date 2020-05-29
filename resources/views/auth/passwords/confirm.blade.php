@extends('layouts.login')
 
@section('content')

<div class="container">
    <div class="columns is-multiline is-touch is-desktop">
        <div class="column is-6-touch is-offset-3-touch is-4-desktop is-offset-4-desktop login-cutomize">
        @include('partials.massages')
        <div class="label login-title">{{ __('Confirm Password') }}</div>
            {{ __('Please confirm your password before continuing.') }}
            <form  class="form-cutomize" method="POST" action="{{ route('password.confirm') }}">
                 @csrf
                 <input type="hidden" name="token" value="{{ $token }}">

               <div class="field">

                    <label class="label">{{ __('Password') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="password" type="password" placeholder="Password" class="input @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                        <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                    </div>

                    @error('password')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror

                </div>


                <div class="field is-grouped">

                    <div class="control">
                        <button :disabled="disabledReset" v-on:click="isRegeSubmited()" v-bind:class="isLodingClass" type="submit" class="button is-primary round-btn-full-width m-t-15"> {{ __('Confirm Password') }}</button>
                    </div> 
                </div>

                @if (Route::has('password.request'))
                <div class="field">
                    <div class="control">
                        <label class="">{{ __('Forgot Your Password?') }} <a href="{{ route('password.request') }}">Click here</a></label> 
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
                password: '', 
                loding: false
            },
            methods: {
                isRegeSubmited() {
                    if ( this.password.length > 7 && this.password ) {
                        this.loding = true;
                    }
                } 
            },
            computed: {
                isLodingClass: function () {
                    return {
                        'is-loading': this.loding
                    }
                },
                disabledReset: function () {
                    
                    return !this.password
                    
                }

            }
        })
    </script>
    
@endsection
