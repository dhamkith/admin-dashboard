<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cache;

class AdminSetting extends Model
{
    /*
    * The attributes that aren't mass assignable.
    *
    * @var array
    */
    protected $guarded = [];

    /*
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'admin_settings';

    /*
     * The attributes that are mass assignable.
     *
     * @var array
     */ 
    public $fillable = ['id', 'name', 'val', 'type'];

         /*
     * Add a settings value.
     * 
     * @param $key
     * @param $val
     * @param sring $type
     * @return boll
     * 
     */
    public static function add($key, $val, $type = 'string')
    {
        
        if( self::has($key) ) {
            return self::set($key, $val, $type);
        }
        
        return self::create(['name' => $key, 'val' => escape_route($val), 'type' => $type]) ? $val : false;
    }

     /*
     * Get a settings value.
     * 
     * @param $key
     * @param null $default
     * @return boll|int|mixed
     * 
     */
    public static function get($key, $default = null)
    {
        if( self::has($key) ) {
            $adminSetting = self::getAllAdminSettings()->where('name', $key)->first();
            return self::castValue($adminSetting->val, $adminSetting->type);
        }

        return self::getDefaultValue($key, $default);
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
    public static function set($key, $val, $type = 'string')
    {
        if( $adminSetting = self::getAllAdminSettings()->where('name', $key)->first() ) {
            return $adminSetting->update([
                'name' => $key,
                'val' => escape_route($val),
                'type' => $type,
            ]) ? $val : false;
        }

        return self::add($key, $val, $type);
    }

    /*
     * Remove a setting.
     * 
     * @param $key 
     * @return boll
     * 
     */
    public static function remove($key)
    {
        if( self::has($key) ) {
            return self::whereName($key)->delete();
        }

        return false;
    }

    /*
     * Check if setting exists.
     * 
     * @param $key 
     * @return boll
     * 
     */
    public static function has($key)
    {
         return (boolean) self::getAllAdminSettings()->whereStrict('name', $key)->count();
    }

    /*
     * Get the validation rules for setting fields.
     *  
     * @return array
     * 
     */
    public static function getValidationRules()
    {
        return self::getDefinedAdminSettingFields()->pluck('rules', 'name')
            ->reject(function ($val) {
                return is_null($val);
            })->toArray(); 
    }

    /*
     * Get the data type of a setting.
     *  
     * @param $field
     * @return mixed
     * 
     */
    public static function getDataType($field)
    {
        $type = self::getDefinedAdminSettingFields()
                    ->pluck('data', 'name')
                    ->get($field);
         return is_null($type) ? 'string' : $type;
    }

    /*
     * Get default value for a setting.
     *  
     * @param $field
     * @return mixed
     * 
     */
    public static function getDefaultValueForField($field)
    {
        return self::getDefinedAdminSettingFields()
                    ->pluck('value', 'name')
                    ->get($field); 
    }

    /*
     * Get default value from config if no value passed.
     *  
     * @param $key
     * @param $default
     * @return mixed
     * 
     */
    private static function getDefaultValue($key, $default)
    {
        return is_null($default) ? self::getDefaultValueForField($key) : $default; 
    }

     /*
     * Get all the settings fields from config.
     *   
     * @return Collection
     * 
     */
    private static function getDefinedAdminSettingFields()
    {
        
        return collect(config('admin_setting_fields'))->pluck('elements')->flatten(1); 
    }

    /*
     *caste value into respective type
     *   
     * @param $val
     * @param $castTo
     * @return bool|int
     * 
     */
    private static function castValue($val, $castTo)
    {
        
        switch ($castTo) {
            case 'int':
            case 'integer':
                return intval($val);
                break;

            case 'bool':
            case 'boolean':
                return boolval($val);
                break;

            default:
                return $val;
        }
    }

    /*
     * Get all the settings
     *  
     * @return mixed
     * 
     */
    private static function getAllAdminSettings()
    {
        return Cache::rememberForever('admin_settings.all', function() {
            return self::all();
        });
    }

    /*
     * Flush the cache
     */
    public static function flushCache()
    {
        Cache::forget('admin_settings.all');
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
