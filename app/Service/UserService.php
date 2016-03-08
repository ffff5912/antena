<?php
namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\RepositoryInterface;
use App\Entity\User;

class UserService
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function register(User $user)
    {
        $this->repository->save($user);

        return $user;
    }
}
