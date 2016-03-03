<?php

namespace App;

use LaravelDoctrine\ORM\Contracts\Auth\Authenticatable;

class User implements Authenticatable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $id;
    }

    public function getPassword()
    {
        return $this->password;
    }
}
