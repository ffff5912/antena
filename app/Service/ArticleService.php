<?php
namespace App\Service;

use App\Repository\RepositoryInterface;
use App\Factory\FactoryInterface;

class ArticleService
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @var FactoryInterface
     */
    private $factory;

    /**
     * @param RepositoryInterface $repository
     */
    public function __construct(RepositoryInterface $repository, FactoryInterface $factory)
    {
        $this->repository = $repository;
        $this->factory = $factory;
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }
}
