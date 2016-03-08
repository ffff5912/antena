<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks()
 */
class User implements \LaravelDoctrine\ORM\Contracts\Auth\Authenticatable
{
    use \LaravelDoctrine\ORM\Auth\Authenticatable;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    public function __construct($name, $password)
    {
        $this->name = $name;
        $this->password = $password;
    }

    public function getAuthIdentifierName()
    {
        return 'id';
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getnName()
    {
        return $this->name;
    }
}
