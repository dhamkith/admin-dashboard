<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidFacebook implements Rule
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
 		* A simple regex to test whether or not a facebook url is valid. For basic usage, this will do the job.
 		*  $validUrl = 'https://www.facebook.com/atomicpages/';
 		*/ 
			$fbUrlCheck = '/^(https?:\/\/)?(www\.)?facebook.com\/[a-zA-Z0-9(\.\?)?]/';
            // $secondCheck = '/home((\/)?\.[a-zA-Z0-9])?/'; 
            
            if ( !empty($value) && preg_match($fbUrlCheck, $value)){
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
        return 'Facebook URL is not valid!, https://www.facebook.com/yourpage/';
    }
}
