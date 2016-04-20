<?php

class Hash
{
    
    /**
     *
     * @param string $algo The algorithm (md5, sha1, whirlpool, etc)
     * @param string $data The data to encode
     * @param string $salt The salt (This should be the same throughout the system probably)
     * @return string The hashed/salted data
     */
    public static function create($password)
    {
        
        $options = [
            'cost' => 10
        ];
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hash;    
    }
    
}