<?php
namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use willvincent\Feeds\FeedsFactory;
use App\Repository\RepositoryInterface;

class FeedService
{
    /**
     * @var RepositoryInterface
     */
    private $repository;

    /**
     * @var Feeds
     */
    private $feeds;

    /**
     * @param FeedsFactory
     */
    public function __construct(RepositoryInterface $repository, FeedsFactory $feeds)
    {
        $this->repository = $repository;
        $this->feeds = $feeds;
    }

    public function make($url)
    {
        return $this->feeds->make($url);
    }

    public function build(\SimplePie_Item $feed)
    {
        $data = new ArrayCollection();
        $data->set('title', $feed->get_title());
        $data->set('url', $feed->get_permalink());
        $data->set('description', $feed->get_description());

        return $data;
    }

    public function getAll()
    {
        return $this->repository->findAll();
    }
}
