<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
        /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'roles';

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug', 'permissions',
    ];

    /*
     * Get the users record associated with the Role.
     */
    public function users(){

        return $this->belongsToMany('App\User', 'role_user');
    }

    /*
     * Get the permissions record associated with the Role.
     */
    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'permission_role');
    }

     /*
     * Add a Role.
     * 
     * @param $name
     * @param $slug 
     * @return boll
     * 
     */
    public static function add($name, $slug)
    {
        return self::create(['name' => escape_route($name), 'slug' => escape_route($slug)]) ? $name : false;
    }
}
