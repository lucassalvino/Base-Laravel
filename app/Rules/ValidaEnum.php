<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidaEnum implements Rule{
    protected $enum;
    public function __construct($enum){
        $this->enum  = $enum;
    }
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->enum::ExisteEnum($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "O valor do enum ':attribute' não existe no enum especificado";
    }
}