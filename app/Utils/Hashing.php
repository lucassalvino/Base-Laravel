<?php

namespace App\Utils;

use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Hashing\AbstractHasher;

class Hashing extends AbstractHasher implements Hasher{

    public function make($value, array $options = array()) {
        
        return hash(EnvConfig::HashSenha(), $value);
    }
        
    public function check($value, $hashedValue, array $options = array()) {
        return $this->make($value) === $hashedValue;
    }
        
    public function needsRehash($hashedValue, array $options = array()) {
        return false;
    }
}
?>
