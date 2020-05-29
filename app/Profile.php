<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $guarded = [];
    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array( 'first_name', 'last_name', 'about_me', 'birthday', 'image', 'banner', 'housenumber', 'addressline1', 'addressline2', 'postcode', 'city', 'country' );

    /*
     * Get the user record associated with the Profile.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
