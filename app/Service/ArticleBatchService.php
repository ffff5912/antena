<?php
namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\RepositoryInterface;
use App\Factory\FactoryInterface;

class ArticleBatchService
{
    const BATCH_SIZE = 20;
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

    public function save(ArrayCollection $articles)
    {
        return $this->repository->bulkInserts($articles, self::BATCH_SIZE);
    }

    public function build(ArrayCollection $data)
    {
        return $this->factory->build($data);
    }
}
