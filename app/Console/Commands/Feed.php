<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use GrahamCampbell\Flysystem\FlysystemManager;
use Doctrine\Common\Collections\ArrayCollection;
use App\Service\FeedService;
use App\Service\ArticleBatchService;

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
     * @var string
     */
    private $flysystem;

    /**
     * @var ArrayCollection
     */
    private $articles;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FeedService $feed_service, ArticleBatchService $article_service, FlysystemManager $flysystem)
    {
        parent::__construct();
        $this->feed_service = $feed_service;
        $this->article_service = $article_service;
        $this->flysystem = $flysystem;
        $this->articles = new ArrayCollection();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->read('feed_list.txt');
        $feed = $this->feed_service->make($url);
        $items = $feed->get_items();
        foreach ($items as $item) {
            $this->articles->add($this->build($item));
        }
        $this->article_service->save($this->articles);
    }

    /**
     * @param  SimplePie_Item $item
     * @return Article
     */
    private function build(\SimplePie_Item $item)
    {
        $feed = $this->feed_service->build($item);
        return $this->article_service->build($feed);
    }

    /**
     * @param  String $path
     * @return String
     */
    private function read($path)
    {
        return $this->flysystem->read($path);
    }
}
