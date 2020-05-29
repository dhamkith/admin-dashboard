<?php

namespace App;

use App\Traits\ContactUsTrait;
use App\Traits\UserSendMsgTrait;
// use App\Traits\TagTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use App\Notifications\AdminResetPasswordNotification;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Auth\Passwords\CanResetPassword as CanResetPasswordTrait;


class Admin extends Model implements Authenticatable,CanResetPassword
{
    use AuthenticableTrait;
    use CanResetPasswordTrait;
    use Notifiable;
    use ContactUsTrait;
    use UserSendMsgTrait;
    // use TagTrait;
    
    protected $guard = 'admin';

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /*
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

     /*
     * send Password Reset Notification.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AdminResetPasswordNotification($token));
    }
}
