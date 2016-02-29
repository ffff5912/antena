<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Service\ArticleService;

class ArticleSearchController extends BaseController
{
    const ARTICLE_LIMIT = 10;

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

    public function showCategory($category, $page = 1)
    {
        $articles = $this->service->getByCategory($category, $page, self::ARTICLE_LIMIT);
        $max_pages = ceil($articles->count() / self::ARTICLE_LIMIT);

        return view('article.index', [
            'articles' => $articles,
            'max_pages' => $max_pages,
            'current_page' => $page,
        ]);
    }

    public function showTag($tag, $page = 1)
    {
        $articles = $this->service->getByTag($tag, $page, self::ARTICLE_LIMIT);
        $max_pages = ceil($articles->count() / self::ARTICLE_LIMIT);

        return view('article.index', [
            'articles' => $articles,
            'max_pages' => $max_pages,
            'current_page' => $page,
        ]);
    }
}
