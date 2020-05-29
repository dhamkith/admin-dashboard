<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule; 
use App\Traits\FunctionsTrait;

class ValidUserPostal implements Rule
{  

    public $country_code;
    /*
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($country_code)
    { 
        $this->country_code = $country_code;
    }

    /*
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     * '/^\d{3} \d{2}$/'
     * '/^\d{8}$/'
     */
    public function passes($attribute, $value)
    { 
         $regx = array();
         $data = FunctionsTrait::customRulevalidate($this->country_code); 
         $is_array = $data->postal_regex; 
         $count =  count($is_array);
        
         if( $count == 0 && is_null($value)) { 
            return true; 
         } else {
            if ($count > 0) { 
                for ($i=0; $i < $count; $i++) { 
                    $regx[$i] = $is_array[$i];
                }
            }
         }
         if ($count > 0) { 
            for ($j=0; $j < $count; $j++) {  
                if (preg_match($regx[$j],$value)){
                    return true; 
                } 
            }
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
         $format = FunctionsTrait::customRulevalidate($this->country_code)->postal_format; 
         if (count($format) > 0) {
            return 'Postal Code format is: '.$format[0].' (# = number , @ = characters ,* = number or characters)';
         } 
         return 'set Postal Code feild is epmty';
         
    }
}
