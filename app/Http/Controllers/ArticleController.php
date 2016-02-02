<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Service\ArticleService;

class ArticleController extends BaseController
{
    /**
     * @var ArticleService
     */
    private $service;

    /**
     * @param ArticleService $service
     */
    public function __construct(ArticleService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $articles = $this->service->getAll();

        return view('article.index', ['articles' => $articles]);
    }
}
