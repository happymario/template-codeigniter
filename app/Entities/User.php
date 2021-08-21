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

    public function setPwd(string $pass)
    {
        $this->attributes['pwd'] = password_hash($pass, PASSWORD_BCRYPT);

        return $this;
    }
}