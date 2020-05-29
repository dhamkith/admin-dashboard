<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidImages implements Rule
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
        if (!is_array($value)){
            return false; 
        } else {
            foreach ($value as $val):
                // dd($val->getClientMimeType()); 
                switch ($val->getClientMimeType()) { 
                    case 'text/css':
                        return false;
                        break; 
                    case 'image/png':
                            return true;
                            break;
                    case 'image/jpeg':
                        return true;
                        break;
                    case 'audio/mp4':
                         return false;
                        break;
                    case 'audio/mp3':
                        return false;
                        break;
                    case 'audio/mpeg':
                            return false;
                            break;
                    default:
                        return false;
                        break;
                }
            endforeach;
        }
    }

    /*
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The images must be a file of type: image';
    }
}
