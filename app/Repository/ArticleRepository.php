<?php
namespace App\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;

class ArticleRepository implements RepositoryInterface
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
        $this->entity_repository = $this->em->getRepository(Article::class);
    }

    /**
     * @param int $id
     * @return Article
     */
    public function find($id)
    {
        return $this->entity_repository->find($id);
    }

    /**
     * @return ArrayCollection
     */
    public function findAll()
    {
        return $this->entity_repository->findBy([], ['created_at' => 'desc']);
    }

    /**
     * @param  ArrayCollection $articles
     * @param  integer         $batch_size
     */
    public function bulkInserts(ArrayCollection $articles, $batch_size = 20)
    {
        $length = $articles->count();
        for ($i = 1; $i < $length; ++$i) {
            $this->persist($articles->get($i));
            if (0 === ($i % $batch_size)) {
                $this->detaches();
            }
        }
        $this->detaches();
    }

    private function detaches()
    {
        $this->flush();
        $this->clear();
    }

    private function persist(Article $article)
    {
        $this->em->persist($article);
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
