<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;
class Setting extends Model
{
    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'settings';

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = array('data');
  
    /*
     * Get the entity's Setiings.
     */
    public function SettingTrait()
    {
        return $this->morphTo();
    }

     /*
     * Add a settings value.
     * 
     * @param $key
     * @param $val
     * @param sring $type
     * @return boll
     * 
     */
    public static function add($user, $user_id, $data)
    {
        if ( Setting::where('settable_id', $user_id)->first() ) { 
            return self::set($user, $user_id, $data);
        } 

        $setting = new Setting; 
        $setting->data = json_encode($data); 
        $user->settings()->save($setting); 
    }

     /*
     * Set a value for setting.
     * 
     * @param $key
     * @param $val
     * @param string $type
     * @return boll
     * 
     */
    public static function set($user, $user_id, $data)
    {
        if( $userSetting = self::getAllUsersSettings()->where('settable_id', $user_id)->first() ) {
            return $userSetting->update([
                'data' => json_encode($data),
            ]);
        }

        return self::add($user, $user_id, $data);
    }

     /*
     * Check if user setting exists.
     * 
     * @param $key 
     * @return boll
     * 
     */
    public static function has($user_id)
    {
         return (boolean) self::getAllUsersSettings()->whereStrict('settable_id', $user_id)->count();
    }

     /*
     * Get the validation rules for setting fields.
     *  
     * @return array
     * 
     */
    public static function getValidationRules()
    {
        return self::getDefinedUserSettingFields()->pluck('rules', 'name')
            ->reject(function ($val) {
                return is_null($val);
            })->toArray(); 
    }

    /*
     * Get all the settings fields from config.
     *   
     * @return Collection
     * 
     */
    private static function getDefinedUserSettingFields()
    {
        return collect(config('user_setting_fields'))->pluck('elements')->flatten(1); 
    }

     /*
     * Get all the settings
     *  
     * @return mixed
     * 
     */
    private static function getAllUsersSettings()
    {
        return Cache::rememberForever('user_settings.all', function() {
            return self::all();
        });
    }


    /*
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('user_settings.all');
    }

    /*
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::updated(function () {
            self::flushCache();
        });

        static::created(function() {
            self::flushCache();
        });
    }
}
