<?php
namespace App\Service;

use willvincent\Feeds\FeedsFactory;

class FeedService
{
    /**
     * @var Feeds
     */
    private $feeds;

    /**
     * @param FeedsFactory
     */
    public function __construct(FeedsFactory $feeds)
    {
        $this->feeds = $feeds;
    }

    public function make($url)
    {
        return $this->feeds->make($url);
    }
}
