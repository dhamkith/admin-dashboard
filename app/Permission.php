<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = [];

    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

     /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'slug',
    ];
    
     /*
     *  roles.
     *
     * @var array
     */
    public function roles(){

        return $this->belongsToMany('App\Role', 'permission_role');
    }

    /*
     * Add a Permission.
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
