<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class AdminLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating Admin for the application and
    | redirecting them to your Admin dashboard screen. 
    |
    */
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]); 
    }

    /**
     * get admin-login view
     */
    public function showLoginForm(){
        $admin = Admin::all()->count();
        return view('auth.admin-login',compact('admin'));
    }

   /**
     * admin login.
     *
     * @param  \Illuminate\Http\Request  
     * 
     */
    public function login(Request $request)
    {
        // validate the form data
        $this->validate( $request, [
            'email' => 'required|email',
            'password'  => 'required'
        ]);
        // attempt to log the user in
        if (Auth::guard('admin')->attempt( ['email' => $request->email, 'password' => $request->password ], $request->remember) )
        {
          // if successful, then redirect to their intended location
           return redirect()->intended(route('admin.dashboard'));
        }
            
        // ii unsuccessful, then redirect back to the login with the form dat
        return $this->sendFailedLoginResponse($request);
        //return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Get the failed login response instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }


     /**
     * Log the admin out of the application.
     */
    public function logout()
    {
        Auth::guard('admin')->logout();

        // $request->session()->invalidate();

        return redirect('/');
    }


}
