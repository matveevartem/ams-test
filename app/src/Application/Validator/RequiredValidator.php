<?php

namespace App\Application\Validator;

class RequiredValidator implements IsValidator
{
    /**
     * Validates for required keys
     * @param string $key require key name
     * @param array $data request data
     * @return bool|string true if validate success else error message
     */
    public function validate(string $key, array $data) : bool|string
    {
        if ($data && array_key_exists($key, $data)) {
            return true;
        }

        return $key . ' is required';
    }
}