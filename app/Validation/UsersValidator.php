<?php
namespace App\Validation;
use Validator;
 
class UsersValidator
{
    public static function validate($input)
    {
        $rules = [
            'fullname' => 'Required|Min:4|Max:80|alpha_spaces',
            'code' => 'Required',
        ];
        return Validator::make($input, $rules);
    }
}
?>