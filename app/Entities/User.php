<?php


namespace App\Entities;

class User extends BaseEntity
{
    protected $attributes = [
        'id' => null,
        'name' => null,        // Represents a username
        'pwd' => null,
        'profile_url' => null
    ];

    // 60자이상의 hashkey로 부호화함.
    public function setPwd(string $pass)
    {
        $this->attributes['pwd'] = password_hash($pass, PASSWORD_DEFAULT);
        //$this->attributes['pwd'] = $pass;
        return $this;
    }

    public function checkPwd($pass, $hash) {
        return password_verify($pass, $hash);
        //return $pass == $hash;
    }
}