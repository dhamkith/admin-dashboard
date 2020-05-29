<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidInstagram implements Rule
{
    /*
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /*
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
		/*
 		* A simple regex to test whether or not a instagram url is valid. For basic usage, this will do the job.
 		*  $validUrl = 'https://www.instagram.com/name/';
 		*/ 
         $instagramUrlCheck = '/(^(http|https)?\:\/\/)?(www\.)?(instagram\.com|instagr\.?am)\/.+$/';
         
         if ( !empty($value) && preg_match($instagramUrlCheck, $value)){
             return true;
         } 
         return false; 
    }

    /*
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'instagram URL is not valid!, https://www.instagram.com/name/';
    }
}
