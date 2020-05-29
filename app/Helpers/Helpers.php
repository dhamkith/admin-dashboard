<?php
if (!function_exists('is_user_online')) {  
    /**
    * is_user_online.
    *
    * @param mixed 
    * 
    */
   function is_user_online($user_id) {  
        if (Illuminate\Support\Facades\Cache::has('user-is-online-'.$user_id)){
            return 'user-online'; 
        }  else {
            return 'user-ofline';
        }
   }

}

if (!function_exists('social_host_name')) { 
    /**
    * Checks if a host_name exists given url
    *
    * @param mixed $url
    * given value string
    *  
    * @return host_name,
    * false otherwise
    */
   function social_host_name($url) { 
       // get host name from URL
       preg_match('@^(?:(?:http|https):\/\/)?([^/]+)@i', $url, $matches);
       $host = $matches[1];
       return $host;
   }
}

if (!function_exists('social_profile')) { 
   /**
   * split url by '/',  preg_split()
   *
   * @param mixed $url
   * given value string
   *
   * preg_match( $pattern1, $url), preg_replace($patterns, $replacements, $url)
   *
   * @remove host_name
   *
   * @return social media profile path,
   * 
   */
  function social_profile($url) {  

      $host = social_host_name($url);
      $arrays = preg_split("/[\/]+/", $url);

      $host_key;  
      
      foreach ($arrays as $key => $value) {
          if ($value == $host) {
             $host_key = $key;
          }
      } 

      $num = $host_key + 1; 

      $result = array_splice($arrays, $num);

      return implode('/', $result);
  }

}

if (!function_exists('admin_setting')) { 
     /**
     * get admin_setting
     *
     * @param mixed 
     * 
     */
    function admin_setting($key, $default = null) {  
 
         if (is_null($key)) {
             return new \App\AdminSetting();
         }
 
         if (is_array($key)) {
             return \App\AdminSetting::set($key[0], $key[1]);
         }
 
         $value = \App\AdminSetting::get($key);
 
         return is_null($value) ? value($default) : $value;
    }
 
 }

 if (!function_exists('user_setting')) { 
    /**
    * get user_setting
    *
    * @param mixed 
    * 
    */
   function user_setting( $section, $key) {  

        $user_id = auth()->user()->id; 

        $user_setting = \App\Setting::where('settable_id', $user_id)->first(); 

        if ($user_setting) {
            
            $settings = json_decode($user_setting->data, true);
            if($settings[$section]){    
                return $settings[$section][$key];
            } 
        }
        
   }

}


if (!function_exists('numberformat')) { 
    /**
    * numberformat
    *
    * 
    */
   function numberformat($val) {  
       if (!is_null($val)) {
            return number_format($val, 0, ',', ',');
       }  
   }
}


 if (!function_exists('escape_route')) { 
    /**
    * escape_route
    * $start check $val has {{ route(' and replacement ''
    * $end check $val has ') }} and replacement ''
    * @return mixed
    */
   function escape_route($val) {  
       if (!is_null($val)) { 
        $start = '/(\{\{)(\s+)?route(\((\s+)?\'(\s+)?)/';
        $end = '/(\'(\s+)?\)(\s+)?)?(\}\})/';
        $replacement = ''; 
        $result = preg_replace($start, $replacement, $val);
        return preg_replace($end, $replacement, $result);
       }  
   }
}

if (!function_exists('_escape')) { 
    /**
    *  
    * replacement '_' with ' '
    * @return String
    *
    */
   function _escape($val) {  
       if (!is_null($val)) { 
            return str_replace(['_'], ' ', $val);
       }  
   }
}


if (! function_exists('array_flatten')) {
    /**
     * Flatten a multi-dimensional array into a single level.
     *
     * @param  array  $array
     * @param  int  $depth
     * @return array
     *
     * @deprecated Arr::flatten() should be used directly instead. Will be removed in Laravel 5.9.
     */
    function array_flatten($array, $depth = INF)
    {
        return Arr::flatten($array, $depth);
    }
}

if (! function_exists('str_limit')) {
    /**
     * Limit the number of characters in a string.
     *
     * @param  string  $value
     * @param  int     $limit
     * @param  string  $end
     * @return string
     *
     * @deprecated Str::limit() should be used directly instead. Will be removed in Laravel 5.9.
     */
    function str_limit($value, $limit = 100, $end = '...')
    {
        return Str::limit($value, $limit, $end);
    }
}

if (! function_exists('str_plural')) {
    /**
     * Get the plural form of an English word.
     *
     * @param  string  $value
     * @param  int     $count
     * @return string
     *
     * @deprecated Str::plural() should be used directly instead. Will be removed in Laravel 5.9.
     */
    function str_plural($value, $count = 2)
    {
        return Str::plural($value, $count);
    }
}
