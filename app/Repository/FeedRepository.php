<?php
namespace App\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Feed;

class FeedRepository implements RepositoryInterface
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
        $this->entity_repository = $this->em->getRepository(Feed::class);
    }

    /**
     * @param Integer $id
     * @return Feed
     */
    public function find($id)
    {
        return $this->entity_repository->find($id);
    }

    /**
     * @return ArrayCollection<Feed>
     */
    public function findAll()
    {
        return $this->entity_repository->findAll();
    }

    private function persist(Feed $feed)
    {
        $this->em->persist($feed);
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
