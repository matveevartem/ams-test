<?php

namespace App\Application\Validator;

use Exception;

class Validator
{
    public static function validate(array $data, array $rules): void
    {
        foreach($rules as $key => $rule) {
            foreach($rule as $item) {
                $validatorsInfo = explode(':', $item);
                $validator = 'App\\Application\\Validator\\'.ucfirst($validatorsInfo[0]).'Validator';
                $vObject = new $validator;
                $args = [$key, $data];
                if (count($validatorsInfo) > 1) {
                    array_push($args, $validatorsInfo[1]);
                }
                $result = call_user_func_array([$vObject, 'validate'], $args);
                if (is_string($result)) {
                    throw new Exception($result);
                }
            }
        }
    }
}