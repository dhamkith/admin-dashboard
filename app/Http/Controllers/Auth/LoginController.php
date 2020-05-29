<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\Traits\FunctionsTrait;
use App\Setting;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

       /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request ->toDateTimeString() getClientIp() 
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        /**
         *  user default settings
         *  @param  $lass_than maximum ip 
         */
        $lass_than = 10;
        FunctionsTrait::lastLoginIps($request, $user, $lass_than);

        /**
         * check user has default setting table
         * 
         */ 
        Setting::flushCache();
        if( !Setting::has($user->id) ){
            // default settings
            FunctionsTrait::settingUser($user);  
         } 

    } 
    /**
     * Log the user out of the application.
     */
    public function userLogout()
    {
        Auth::guard('web')->logout(); 
        return redirect('/');
    }
}
