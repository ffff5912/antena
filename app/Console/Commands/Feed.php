<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Doctrine\Common\Collections\ArrayCollection;
use App\Service\FeedService;
use App\Service\ArticleBatchService;
use App\Entity\Article;

class Feed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getFeed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var FeedService
     */
    private $feed_service;

    /**
     * @var ArticleService
     */
    private $article_service;

    /**
     * @var ArrayCollection
     */
    private $articles;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FeedService $feed_service, ArticleBatchService $article_service)
    {
        parent::__construct();
        $this->feed_service = $feed_service;
        $this->article_service = $article_service;
        $this->articles = new ArrayCollection();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->read()->forAll(function ($key, $feed) {
            $feed = $this->feed_service->make($feed->getUrl());
            $this->createFeedItems($feed)
                ->map($this->buildFeed())
                ->map($this->buildArticle())
                ->map($this->addArticle());
        });
        $this->article_service->save($this->articles);
    }

    private function buildFeed()
    {
        return function (\SimplePie_Item $item) {
            return $this->feed_service->build($item);
        };
    }

    private function buildArticle()
    {
        return function (ArrayCollection $feed) {
            return $this->article_service->build($feed);
        };
    }

    private function addArticle()
    {
        return function (Article $article) {
            $this->articles->add($article);
        };
    }

    /**
     * @param  SimplePie $feed [description]
     * @return ArrayCollection
     */
    private function createFeedItems(\SimplePie $feed)
    {
        $items = new ArrayCollection($feed->get_items());

        return $items;
    }

    /**
     * @return String
     */
    private function read()
    {
        return $this->feed_service->getAll();
    }
}
