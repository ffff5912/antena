<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use GrahamCampbell\Flysystem\FlysystemManager;
use App\Service\FeedService;

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
    private $service;

    /**
     * @var string
     */
    private $url = [];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FeedService $service, FlysystemManager $flysystem)
    {
        parent::__construct();
        $this->service = $service;
        $this->flysystem = $flysystem;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $url = $this->read('feed_list.txt');
        $feed = $this->service->make($url);
    }

    private function read($path)
    {
        return $this->flysystem->read($path);
    }
}
