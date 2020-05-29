<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Cache;
use App\Role;
use App\Permission;
use App\AdminSetting;
use App\Setting; 
   
trait FunctionsTrait
{   

    /*
    | -----------------------------------------------------------------------
    | helper functions
    | -----------------------------------------------------------------------
    |
    */

    /*
     * delete unsed directories in Storage helper function
     */
    public static function deleteDirectory($directories)
    {
        if (!empty($directories))  { 
            foreach ( $directories  as $directory ) {
                Storage::deleteDirectory($directory);
            }
        }
    }

    /*
     * delete unsed image in Storage, helper function
     * 
     */  
    public static function deleteFiles($files)
    {
        if (!empty($files))  { 
            foreach ( $files  as $file ) {
                Storage::delete($file);
            }
        }
    }

    /*
     * delete relations data helper function
     */ 
    public static function deleteRelations($ids, $relationModel, $perantModel)
    {  
        
        if ($relationModel === 'App\Comment') {
            // if comments table
            $snake = 'commentable_id';
        } else if ($relationModel === 'Illuminate\Notifications\DatabaseNotification') {
            // if notifications table ['request_id']
            $snake =  'data';
        } else { 
            $snake = self::getColumnName($perantModel);
        }

        if (!empty($ids))  { 
            foreach ( $ids  as $id ) { 

                if ($relationModel === 'Illuminate\Notifications\DatabaseNotification') {
                    $datas = [];
                    $notifications = $relationModel::whereNotNull($snake)->get();
                    foreach ($notifications as $key => $notification) {
                        if ($notification->$snake['request_id']!==null && $notification->$snake['request_id'] == $id){
                            $datas[] = $notification;
                        } 
                    }
                } else { 
                    $datas = $relationModel::where($snake, $id)->get();
                }
                
                foreach ( $datas as $data ) {
                    $data->delete();
                }
            }
        }
    }

    /*
     * createRegex
     */ 
    public static function createRegex($format, $ignoreSpaces = false){
        $pattern = str_replace('#', '\d', $format);
        $pattern = str_replace('@', '[a-zA-Z]', $pattern);
        $pattern = str_replace('*', '[a-zA-Z0-9]', $pattern);
        if ($ignoreSpaces) {
            $pattern = str_replace(' ', ' ?', $pattern);
        }
        return '/^' . $pattern . '$/';
    }

    /*
     * get column name
     * @var $model = 'App/modelName'
     * @return $column_name = modelName_id;
     */ 
    public static function getColumnName($model) {
        $class  = class_basename($model);
        $column_name = snake_case($class).'_id';
        return $column_name;
    }



/* -----------------------------------------------------------------------
* calling functions
* -----------------------------------------------------------------------
*/

    /*
     *  Storage user last 10 login ip
     */
    public static function lastLoginIps($request, $user, $lass_than)
    {
        // get all login data form User table Sring
        $login_ips = $user->last_login_ip; 
        // time now
        $time_of_login =  time();  
        // if has $login_ips
        if ( !$login_ips ) {
            $ips = array();
            $ips[] = $request->ip().'-'.$time_of_login;
            $login_ips = json_encode($ips);
        } else {
            $login_ips = json_decode( $login_ips, true);
            // if array count < $lass_than
            if(count($login_ips) < $lass_than ) {
                $login_ips[] = $request->ip().'-'.$time_of_login;
                $login_ips = json_encode($login_ips);
            } else { 
                // remove first ip
                $splice = \array_splice($login_ips, 1);
                $splice[] = $request->ip().'-'.$time_of_login;
                $login_ips = json_encode($splice);
            }
        }
        $user->update([ 'last_login_ip' => $login_ips ]); 
    }

    /*
     * custom Pagination
     * Illuminate\Pagination\LengthAwarePaginator;
     */
    public static function customPaginate($data_ids, $per_page, $user_id=null, $request = null, $model) {
         
        /*
         * path.
         * Get the musics record, by geven ids.
         */
        $base_url = config('app')['url'];
        if ($model === 'App\User'){
            $path = $base_url.'/manage/get/online/users';
            $data_collections = $model::find($data_ids)->reverse();
        }
        if ($model === 'App\Comment'){
            $path = $base_url.'/user-dash/postcomments';
            $data_collections = $model::find($data_ids)->reverse();
        }
        $counts = $data_collections->count();
        $options = array('path' => $path, 'pageName' => 'page');
        $per_page = $per_page;

        /*
         * split musics record, by $perPage.
         */
        
        $groups = $data_collections->chunk($per_page);
        $groups->toArray();

        if( $request === null) {
            $chunks = $groups[0];
        } else if ($counts <= $per_page) {
            $chunks = $data_collections;
        } else if ( $request->page === null && $counts > $per_page) {
            $chunks = $groups[0];
        } else { 
            $chunks = [];
            $chunks = $groups[$request->page - 1];
            // foreach($datas as $data) {
            //     $chunks[] = $data;
            // }
        }

        /*
         * return $collections; with pagination
         */
        $collections = new LengthAwarePaginator($chunks, $counts, $per_page, $currentPage = null, $options);
        return $collections;
    }
     /*
     * delete unsed image in Storage 
     */
    public static function deleteUnuseFiles($model, $dir)
    {
         // get all images from public/profile dir
         $f_files = Storage::allFiles($dir);
         
         // get all images from public/profile dir
         $files = $model::all();
         $f = array();
         $f2 = array();
         
        if ( count($files) > 0 ){
            
            foreach ( $files  as $file ) {
                if( $file ){
                    if ( $file->banner && $file->image): // check if profile banner
                        $f[] = $dir.$file->image;
                        $f2[] = $dir.$file->banner;  
                    elseif ( $file->menu_image): // check if menu_image has menus table
                        $f2[] = $dir.$file->menu_image; 
                    endif;

                }
            }
            //$file = $file;
            if ( $file->banner && $file->image ):
            $result3 = array_merge( $f,  $f2 );
            else:
            $result3 = $f2;
            endif;
            $f_files_result = array_diff($f_files, $result3);
            if ($f_files_result) {
                self::deleteFiles($f_files_result);
            }
  
        } else {
            self::deleteFiles($f_files);
        }
         
    }

 
     /*
     * delete unsed data in Storage 
     */
    public static function unsedDirectoryDelete($perantModel, $dir)
    { 
        $directories = Storage::directories($dir);
        // Recursive...
        //$directories = Storage::allDirectories($dir);

        $datas = $perantModel::all();
        $is_ids = array();

        if ( count($datas) > 0 ){ 

            foreach ( $datas as $data ) {
                $is_ids[] = $dir.$data->id;
            }

            $result = array_diff($directories,  $is_ids);
            
            self::deleteDirectory($result);

        } else {

            self::deleteDirectory($directories);
        }
    }

     /*
     * delete $relationModel data
     */
    public static function relationsDataDelete($perantModel, $relationModel)
    {   
        
        if ($relationModel === 'App\Comment') {
            // if comments table
            $snake = 'commentable_id';
        } else if ($relationModel === 'Illuminate\Notifications\DatabaseNotification') {
            // if comments table
            $snake = 'data';
        } else { 
            $snake = self::getColumnName($perantModel);
        }
        
        // get all "$perantModel" ids
        $perantData = $perantModel::all();
        $perantIds = array();
        if ($perantData) {
            foreach ($perantData as $perant ) {
                $perantIds[] = $perant->id;
            }
            $perantIds = $perantIds;
        }

        // get all "$relationModel" $snake.'_id's
        $relationData = $relationModel::all();
        $snakeIds = array();
        if ( $relationData) {
            foreach ( $relationData as $relation ) {
                if ($relationModel === 'Illuminate\Notifications\DatabaseNotification') {
                    if ($relation->$snake['request_id'] !== null ) {
                      $snakeIds[] = $relation->$snake['request_id'];
                    } 
                } else { 
                    $snakeIds[] = $relation->$snake;
                }
            }
            $snakeIds = $snakeIds;
        }
        
        $diff_ids = array_diff($snakeIds, $perantIds);
        
        $ids = array_unique($diff_ids);
        
        self::deleteRelations($ids, $relationModel, $perantModel);
    }
     /*
     * online users.
     */
    public static function onlineStatus($users)
    {
        $i = 0; $j = 0;
        foreach ( $users as $user ):
            if (Cache::has('user-is-online-'.$user->id)):
                $i++;
            else:
                $j++;
            endif;
            $online =  $i; $ofline =  $j;    
        endforeach;
        
            $online =  $i; $ofline =  $j; 

        return $status = array(
            'online' => $online,
            'ofline' => $ofline,
            'all' => $online + $ofline,
        );
    }

    /*
    * online users.
    */
    public static function getOnlineUserIds($users)
    {
        $online_user_ids = $users->reject(function ($user) { 
            return !Cache::has('user-is-online-'.$user->id);
        })->map(function ($user) {
            return $user->id;
        });
        //  flatten
        return array_flatten($online_user_ids);
    }

    /*
     * delete unsed image in Storage admin settings
     */
    public static function remove_un_file($dir, $file)
    { 
          $f =  array(); 
          $files = Storage::allFiles($dir);

          if (!is_null($file)) {
              $f[] = $dir.admin_setting($file);
              $result = array_diff($files, $f); 
              self::deleteFiles($result);
          }

    }
    
    /*
     * file Store Path
     */
    public static function fileStorePath($file, $path, $filenameToStore = null)
    {
        if ($file):
                // get the file name with extension
                $filenameWithExt = $file->getClientOriginalName();
                //get just file name
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME );
                // get just ext
                $extension = $file->getClientOriginalExtension();
                // file to store
                $filenameToStore = $filename.'_'.time().'.'. $extension;
                //upload
                $path = $file->storeAs( $path,  $filenameToStore);
                
                if ($path && $filenameToStore):
                    return array(
                        'store_name' => $filenameToStore,
                        'path' => $path,
                        'title' => $filename
                    );
                endif;
        endif;
    }

     /*
     * validation regx for custom rule
     * $section = 'postal_code'|| 'phone_num'
     * $country_code = 'US'
     */ 
    public static function customRulevalidate($country_code) { 

        if(count(config('rulevalidation', [])) ) {
             foreach(config('rulevalidation')['all'] as $value) {
                if($value->code === $country_code ) { 
                  $name = $value->name;
                  $code = $value->code;
                  $dial_code = $value->dial_code;
                  $format = $value->postal_format;
                  $postal_regex = array();
                  if(!is_null($value->postal_format)) { 
                    foreach( $value->postal_format  as $value) { 
                      $postal_regex[] = self::createRegex($value);
                    }
                  } else {
                     $postal_regex = null;
                  } 
                  $country = (Object)array(
                    'postal_regex'=>$postal_regex,
                    'dial_code'=>$dial_code,
                    'code'=>$code,
                    'name'=>$name,
                    'postal_format'=>$format,
                  ); 
                  return $country;
                }
             }
        } 
     }

    /*
     *postal_regex
     */
    public static function postal_regex() {
        if(count(config('rulevalidation', [])) ) {
            $country_postal_regex = array();
            foreach(config('rulevalidation')['all'] as $value) {
                $postal_regex = array();
                if(!is_null($value->postal_format)) { 
                  foreach( $value->postal_format  as $format) { 
                    $postal_regex[] = self::createRegex($format);
                  }
                } else {
                   $postal_regex = null;
                }
                $country_postal_regex[$value->code] = $postal_regex;
                $country_postal_regex = $country_postal_regex;
            }
            return $country_postal_regex;
        }
    }

    /*
     * defaultPermissionRole settings
     */
    public static function defaultPermissionRole() { 
        //check default_role_permissions config  
        if(count(config('default_role_permissions', [])) ) {
            foreach(config('default_role_permissions')['permissions'] as $key => $value) {
                Permission::add($value,  $key); 
            }
            foreach(config('default_role_permissions')['roles'] as $key => $value) {
                Role::add($value,  $key); 
            }
        } 
         
    }

    /*
     * admin settings names key default NULL
     */ 
    public static function defaultAdminSettingsKeyNull() { 

        if(count(config('admin_setting_names', [])) ) {
            foreach(config('admin_setting_names') as $key => $value) {
                AdminSetting::add($key, $value, $type = 'string');
            }
        } 
     
     }
     
    /*
    * User settings
    */
    public static function settingUser($user) {
        if(count(config('user_default_settings', [])) ) { 
            $data = config('user_default_settings');
            $setting = new Setting;
            $setting->data = json_encode($data);
            $user->settings()->save($setting); 
        }  
    }

    public static function settingUserSetData( $facebook,  $twitter, $youtube, $instagram) { 
        return $data = array(
            'general' => array(
                'facebook' => $facebook,
                'twitter' => $twitter,
                'youtube' => $youtube,
                'instagram' => $instagram,
            ),
        );
    }

    /*
     * call AppServiceProvider in boot()
     *
     * @return void
     */
    public static function AppServiceProviderBoot() {

        if (Schema::hasTable('admin_settings')) { 
            $admin_setting = AdminSetting::all();
            if (!count($admin_setting) > 0) {
                /*
                *  default Admin Settings name = $key, value = Null, $type = 'string'
                *  Permission $key change_password  
                */
                AdminSetting::flushCache();
                self::defaultAdminSettingsKeyNull();
            }
        }

        if (Schema::hasTable('roles')) { 
            $roles = Role::all();
            if (!count($roles) > 0) {
                if(count(config('default_role_permissions', [])) ) {
                    foreach(config('default_role_permissions')['roles'] as $key => $value) {
                        Role::add($value,  $key); 
                    }
                } 
            }
        }

        if (Schema::hasTable('permissions')) { 
            $permissions = Permission::all();
            if (!count($permissions) > 0) {
                if(count(config('default_role_permissions', [])) ) {
                    foreach(config('default_role_permissions')['permissions'] as $key => $value) {
                        Permission::add($value,  $key); 
                    }
                }
            }
        }
 
    }
 
  
}
