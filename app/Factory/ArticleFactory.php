<?php
namespace App\Factory;

use Doctrine\Common\Collections\ArrayCollection;
use App\Entity\Article;

class ArticleFactory implements FactoryInterface
{
    /**
     * @param  ArrayCollection $data
     * @return Artice
     */
    public function build(ArrayCollection $data)
    {
        $article = new Article();
        $article->setTitle($data->get('title'));
        $article->setContents($data->get('contents'));
        $article->setUrl($data->get('url'));

        return $article;
    }
}
