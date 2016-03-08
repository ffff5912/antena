<?php
namespace App\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\User;

class UserRepository implements RepositoryInterface
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * @var ObjectRepository
     */
    private $entity_repository;

    /**
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->entity_repository = $this->em->getRepository(User::class);
    }

    /**
     * @param Integer $id
     * @return User
     */
    public function find($id)
    {
        return $this->entity_repository->find($id);
    }

    /**
     * @return ArrayCollection<User>
     */
    public function findAll()
    {
        $users = new ArrayCollection($this->entity_repository->findAll());
        return $users;
    }

    public function save(User $user)
    {
        $this->persist($user);
        $this->flush();
    }

    private function persist(User $user)
    {
        $this->em->persist($user);
    }

    private function flush()
    {
        $this->em->flush();
    }

    public function clear()
    {
        $this->em->clear();
    }
}
