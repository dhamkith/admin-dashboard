<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use App\Role;
use App\User; 
use App\ContactUs; 
use App\Permission;
use App\AdminSetting; 
use App\Traits\FunctionsTrait;

class AdminSettingController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard()
    {
        $users = User::all();
        $messages = ContactUs::all();
        $roles = Role::all();
        $permissions = Permission::all();
        $onlineStatus = FunctionsTrait::onlineStatus($users);
        return view('admin.dashboard', compact('users', 'roles', 'permissions', 'messages', 'onlineStatus'));
    }
 
     /**
     * Show the admin settings dashboard.
     *
     *  @return \Illuminate\Http\Response
     */
    public function settings()
    {
        AdminSetting::flushCache();
        FunctionsTrait::remove_un_file('public/admin/picture/', 'admin_picture');
        FunctionsTrait::remove_un_file('public/admin/site/', 'site_brand');
        return view('admin.settings.index');
    }

    /**
     *  admin settings store
     * 
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
       
        AdminSetting::flushCache();
        $rules = AdminSetting::getValidationRules();
        $data = $this->validate($request, $rules);

        $validSettings = array_keys($rules);

        foreach ($data as $key => $val) { 

           if (in_array($key, $validSettings)) { 

                if( $key === 'new_user_notifi' || $key === 'new_user_email' || $key === 'contact_us_email' || $key === 'is_equalizer' ||  $key === 'is_app_logo') { 
                    is_null($val) ? $val = 0 : $val = 1 ; 
                } 
 
                if( $key === 'admin_picture' ) { 
                    $storeInfo = FunctionsTrait::fileStorePath($val, ('public/admin/picture'), $filenameToStore = null); 
                    $val = strip_tags($storeInfo['store_name']);
                }

                if( $key === 'site_brand' ) { 
                    $storeInfo = FunctionsTrait::fileStorePath($val, ('public/admin/site'), $filenameToStore = null); 
                    $val = strip_tags($storeInfo['store_name']);
                }
                
                if( $key === 'hover_color' ) {

                    /** 
                     * get hover color form database
                    */ 
                    $hover_color = admin_setting('hover_color');
 
                    /** 
                     * get styleshee path
                    */ 
                    $style_sheet_path = public_path('css/theme-color-dark.css'); 
                    /** 
                     * helper function
                    */ 
                    // $this->reWriteStyle($style_sheet_path, $hover_color, $val);

                   
                }
                
                AdminSetting::add($key, $val, AdminSetting::getDataType($key));

           } 
        } 

        $admin_setting_names = config('admin_setting_names');

        $data_diff_key = \array_diff_key($admin_setting_names, $data);

        if ($data_diff_key) {
            foreach ($data_diff_key as $key => $val) { 
                if ($key === 'new_user_notifi' || $key === 'new_user_email' || $key === 'contact_us_email' ||  $key === 'is_app_logo') {
                    is_null($val) ? $val = 1 : $val = 0 ; 
                    AdminSetting::add($key, $val, AdminSetting::getDataType($key));
                } 
            }
        }
          
        return redirect()->back()->with('success', 'settings has been saved.' );

    }

    /**
     *  helper function
     *  
     */
    public function reWriteStyle($style_sheet_path, $hover_color, $val) {

        if (!is_null($val)) {
            (is_null($hover_color)) ? $hover_color = '#0084ff' : $hover_color; 
            /** 
             * file open and read
            */
            $style_sheet_size = filesize($style_sheet_path);
            $f_open_for_reade = fopen($style_sheet_path,'r');
            $content = fread($f_open_for_reade,$style_sheet_size);
            fclose($f_open_for_reade);
            /** 
             * file open and read
            */  
            $style_sheet_size = filesize($style_sheet_path);
            $f_open = fopen($style_sheet_path,'w+');
            fread($f_open,$style_sheet_size);

            /** 
             * replacements color and close file
            */ 
            $patterns[0] = '/' . $hover_color .'/';
            $patterns[1] = '/#0084ff/';
            $replacements[0] = $val; 
            $replacements[1] = $val; 
            $result = preg_replace($patterns, $replacements, $content); 
            fwrite($f_open, $result); 
            fclose($f_open);
            

        }
    } 

}
