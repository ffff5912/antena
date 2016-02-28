<?php
namespace App\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Pagination\Paginator;
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
     * @param Integer $id
     * @return Article
     */
    public function find($id)
    {
        return $this->entity_repository->find($id);
    }

    /**
     * @param  Integer $current_page
     * @param  Integer $limit
     * @return Paginator
     */
    public function findAll($current_page = 1, $limit = 5)
    {
        $query = $this->entity_repository->createQueryBuilder('a')
            ->orderBy('a.created_at', 'DESC')
            ->getQuery();

        return $this->paginate($query, $current_page, $limit);
    }

    /**
     * @param  String $category
     * @return ArrayCollection
     */
    public function findByCategory($category, $current_page = 1, $limit = 5)
    {
        $query = $this->entity_repository->createQueryBuilder('a')
            ->innerJoin('App\Entity\Feed', 'f')
            ->where('f.category = :category')
            ->setParameter(':category', $category)
            ->orderBy('a.created_at', 'DESC')
            ->getQuery();

        return $this->paginate($query, $current_page, $limit);
    }

    /**
     * @param  ArrayCollection $articles
     * @param  Integer         $batch_size
     */
    public function bulkInserts(ArrayCollection $articles, $batch_size = 20)
    {
        $length = $articles->count();
        for ($i = 1; $i < $length; ++$i) {
            $this->merge($articles->get($i));
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

    private function merge(Article $article)
    {
        $this->em->merge($article);
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

    /**
     * @param  String $dql
     * @param  Integer $page
     * @param  Integer $limit
     * @return Paginator
     */
    private function paginate($dql, $page, $limit)
    {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
            ->setFirstResult($limit * $page - 1)
            ->setMaxResults($limit);

        return  $paginator;
    }
}
