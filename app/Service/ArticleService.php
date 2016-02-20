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
}
