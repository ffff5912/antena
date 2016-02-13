<?php
namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\RepositoryInterface;

class ArticleService
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

    public function getAll()
    {
        return $this->repository->findAll();
    }
}
