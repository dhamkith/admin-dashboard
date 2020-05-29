<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidYoutube implements Rule
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
 		* A simple regex to test whether or not a Youtube url is valid. For basic usage, this will do the job.
 		*  $validUrl = 'https://www.youtube.com/ddcred/';
 		*/ 
         $youtubeUrlCheck = '/^(https?\:\/\/)?(www\.)?(youtube\.com|youtu\.?be)\/.+$/';
         
         if ( !empty($value) && preg_match($youtubeUrlCheck, $value)){
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
        return 'youtube URL is not valid!, https://www.youtube.com/ddcred/';
    }
}
