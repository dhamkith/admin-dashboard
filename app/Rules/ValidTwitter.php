<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidTwitter implements Rule
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
 		* A simple regex to test whether or not a Twitter url is valid. For basic usage, this will do the job.
 		*  $validUrl = 'https://www.twitter.com/#!/ddcred/';
 		*/ 
         $twitterUrlCheck = '/^(https?:\/\/)?(www\.)?twitter.com\/.+$/';
         if ( !empty($value) && preg_match($twitterUrlCheck, $value)){
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
        return 'twitter URL is not valid!,  https://www.twitter.com/#!/ddcred/';
    }
}
