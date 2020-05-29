<?php

namespace App\Http\Middleware;
 
use Closure;
use Auth;

class CheckBanned
{
    /**
    * The authentication factory instance.
    *
    * @var \Illuminate\Contracts\Auth\Factory
    */
    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param  \Illuminate\Contracts\Auth\Factory  $auth
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if (auth()->check() && auth()->user()->banned_until ) {

            if (now()->lessThan(auth()->user()->banned_until)) {
                
                $banned_days = now()->diffInDays(auth()->user()->banned_until);
                $banned_hours = now()->diffInHours(auth()->user()->banned_until);
                $banned_minutes = now()->diffInMinutes(auth()->user()->banned_until);
                
                auth()->logout();

                if ($banned_days > 14) {
                    $message = 'Your account has been suspended.'; //  Please contact administrator.
                } else if ($banned_days < 14 && $banned_days > 1) {
                    $message = 'Your account has been suspended for '.$banned_days.' '.str_plural('day', $banned_days).'.'; //  Please contact administrator.
                } else if ($banned_days < 1) {
                    $message = 'Your account has been banned for '.$banned_hours.' '.str_plural('Hours', $banned_hours).'.';
                } else if ($banned_hours < 1){
                    $message = 'Your account has been banned for '.$banned_minutes.' '.str_plural('minutes', $banned_minutes).'. Please try again  leater.';
                } else {
                    $message = 'Your account has banned for '.$banned_minutes.' '.str_plural('minutes', $banned_minutes).'. Please try again  leater.';
                }
 
                return redirect()->route('login')->with('error', $message );

            } else {

                auth()->user()->update([ 'banned_until' => null ]);
                // if successful, then redirect to their intended location
                return redirect()->intended(route('dashboard'));

            }
            
        }

        return $next($request);
    }
}
