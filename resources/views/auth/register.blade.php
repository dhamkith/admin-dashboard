@extends('layouts.app')


@section('content')

<div class="container">
    <div class="columns is-multiline is-touch is-desktop">
        <div class="column is-6-touch is-offset-3-touch is-4-desktop is-offset-4-desktop login-cutomize">
            @include('partials.massages')
            <div class="label login-title">{{ __('User Register') }}</div>
            <form  class="form-cutomize" method="POST" action="{{ route('register') }}">
                
                 @csrf

                <div class="field">

                    <label class="label">{{ __('Name') }}</label>
                    <div class="control has-icons-left has-icons-right">
                         <input v-model="name" id="name" type="text" class="input @error('name') is-danger @enderror" name="name" value="{{ old('name') }}" required autofocus>
                        <span class="icon is-small is-left"><i class="fa fa-envelope"></i></span>
                    </div>

                    @error('name')
                    <p class="help is-danger">{{ $message }}</p>
                    @enderror

                </div>

                <div class="field">

                    <label class="label">{{ __('E-Mail Address') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="email" id="email" type="email" class="input @error('email') is-danger @enderror" name="email" value="{{ old('email') }}" required>
                        <span class="icon is-small is-left"><i class="fa fa-envelope"></i></span>
                    </div>

                    @error('email')
                        <p class="help is-danger">{{ $message }}</p>
                    @enderror 

                </div>

                <div class="field">

                    <label class="label">{{ __('Password') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="password" v-on:blur="isMessage" id="password" type="password" class="input @error('password') is-danger @enderror" name="password" required>
                        <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                    </div>

                    @error('password')
                        <p class="help is-danger">{{  $message }}</p>
                    @enderror 
                
                    <span class="password-strength cf">
                        <span v-bind:class="isRed" class="strength"></span>
                        <span v-bind:class="isOrange" class="strength"></span>
                        <span v-bind:class="isGreen" class="strength"></span>
                    </span>

                </div>
                
                <div class="field">

                    <label class="label">{{ __('Confirm Password') }}</label>
                    <div class="control has-icons-left has-icons-right">
                        <input v-model="confirm" v-on:blur="isConfirm" id="password-confirm" type="password" class="input" name="password_confirmation" required>
                        <span class="icon is-small is-left"><i class="fa fa-lock"></i></span>
                    </div>
                    <span v-if="confirmMsg">
                        <p class="help is-danger"> Please enter the same password again</p>
                    </span>

                </div>


                <div class="field is-grouped">
                    <div class="control">
                        <button  :disabled="disabledRege" v-on:click="isRegeSubmited()" v-bind:class="isLodingClass" type="submit" class="button is-primary round-btn-full-width m-t-15"> {{ __('Register') }}</button>
                    </div>
                </div>
 
                <div class="field">
                    <div class="control">
                        <label class="">{{ __('Allready have Account ?') }} <a href="{{ route('login') }}">Click here</a></label> 
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
                name: '',
                email: '',
                password: '',
                confirm: '',
                loding: false,
                confirmMsg: false,
                isStrong: false,
                isMedium:  false,
                isWeak:  false,
            },
            methods: {
                isRegeSubmited() {
                    if ( this.name && this.password.length > 7
                        && ( this.email && this.validateEmail( this.email ) )
                        && ( this.confirm && ( this.confirm === this.password ) ) ) {
                        this.loding = true;
                    }
                },
                validateEmail(email) {
                    let re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                    return re.test(String(email).toLowerCase());
                },
                validatePassword(password) {
                    
                    var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                    var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

                        if(strongRegex.test(password)) {
                            return 'strong';
                        } else if(mediumRegex.test(password)) {
                            return 'medium';
                        } else {
                            return 'weak';
                        }
                },
                isMessage () {
                    if ( this.validatePassword(this.password) === 'strong') {
                        this.isStrong = true
                    } else if ( this.validatePassword(this.password) === 'medium') {
                        this.isMedium = true
                        this.isStrong = false
                    } else {
                        this.isWeak = true
                        this.isMedium = false
                        this.isStrong = false
                    }
                },
                isConfirm () {
                    if (this.password !== this.confirm) {
                        this.confirmMsg = true
                    } else {
                        this.confirmMsg = false
                    }
                }
            },
            computed: {
                isLodingClass: function () {
                    return {
                        'is-loading': this.loding
                    }
                },
                isRed: function () {
                    return {
                        'red': this.isWeak,
                        'orange': this.isMedium,
                        'green': this.isStrong
                    }
                },
                isOrange: function () {
                    return {
                        'orange': this.isMedium,
                        'green': this.isStrong
                    }
                },
                isGreen: function () {
                    return {
                        'green': this.isStrong
                    }
                },
                disabledRege: function () {
                    
                    return !this.name || !this.password || !this.email || !this.confirm
                    
                }

            },
            watch: {
                // isGreen: function (val) {
                //     alert("yes, computed property changed")
                // }
            },
        })
    </script>
    
@endsection
