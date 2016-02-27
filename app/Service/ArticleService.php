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

    /**
     * @param  Integer $current_page
     * @param  Integer $limit
     * @return Paginator
     */
    public function getAll($current_page, $limit)
    {
        return $this->repository->findAll($current_page, $limit);
    }

    public function getByCategory($category)
    {
        return $this->repository->findByCategory($category);
    }

    public function getByTag($tag)
    {
        return $this->repository->findByTag($tag);
    }
}
