<?php

namespace App\Http\Controllers\Auth;

use App\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AdminRegisterController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function showRegistationFrom()
    { 
        $admin = Admin::all()->count();
        
        if ( $admin > 1 ):
            return redirect()->route('login');
        else:
            return view( 'auth.admin-register');
        endif;
        
    }
    
    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
    {
        // validate the form data
        $this->validate( $request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        DB::table('admins')->truncate();

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
   
        $admin->save();

        $this->guard()->login($admin);

        return $this->registered($request, $admin)
                        ?: redirect()->intended(route('admin.dashboard'));
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $admin)
    {
        /**
         *  default Permission adn roles
         *  Permission $key change_password 
         *                  update_profile 
         *                  preview_profile 
         * Role User
         */
    }
}
