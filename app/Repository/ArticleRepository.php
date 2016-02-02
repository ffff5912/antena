<?php
namespace App\Repository;

use Doctrine\Common\Persistence\ObjectRepository;

class ArticleRepository implements RepositoryInterface
{
    /**
     * @var ObjectRepository
     */
    private $genericRepository;

    /**
     * @param ObjectRepository $genericRepository
     */
    public function __construct(ObjectRepository $genericRepository)
    {
        $this->genericRepository = $genericRepository;
    }

    /**
     * @param int $id
     * @return Article
     */
    public function find($id)
    {
        return $this->genericRepository->find($id);
    }

    public function findAll()
    {
        return $this->genericRepository->findAll();
    }
}
