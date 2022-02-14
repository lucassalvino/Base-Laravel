<?php

namespace App\Rules;

use App\Utils\Valida;
use Illuminate\Contracts\Validation\Rule;

class ValidaCpf implements Rule{
    public $cpf;
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Valida::CPF($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O CPF informado é inválido';
    }
}