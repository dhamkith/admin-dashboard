@extends('layouts.app')


@section('content')

<div class="container">
    <div class="columns is-multiline is-touch is-desktop">
        <div class="column is-6-touch is-offset-3-touch is-4-desktop is-offset-4-desktop login-cutomize">
        
        <div class="label login-title">{{ __('Reset Password') }}</div>
            <form  class="form-cutomize" method="POST" action="{{ route('password.email') }}">
                 @csrf
                 @include('partials.massages') 
                <div class="field">

                    <label class="label">{{ __('E-Mail Address') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="email" type="email" placeholder="Email" class="input @error('email') is-invalid @enderror"  name="email" value="{{ old('email') }}" required>
                        <span class="icon is-small is-left"><i class="fa fa-envelope"></i></span>
                        <span class="icon is-small is-right"><i class="fa fa-exclamation-triangle"></i></span>
                    </div>
                    @error('email')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror
                    
                </div>

                <div class="field is-grouped">

                    <div class="control">
                        <button  :disabled="disabledEmail" v-on:click="isSubmited()" v-bind:class="isLodingClass" type="submit" class="button is-primary round-btn-full-width m-t-15">{{ __('Send Password Reset Link') }}</button>
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
                loding: false
            },
            methods: {
                isSubmited() {
                    if ( this.email && this.validateEmail( this.email ) ) {
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
                disabledEmail: function () {
                    
                    return !this.email
                    
                }

            }
        })
    </script>
    
@endsection
