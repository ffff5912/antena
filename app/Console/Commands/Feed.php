<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
    private $url;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FeedService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $feed = $this->service->make($this->url);
    }
}
