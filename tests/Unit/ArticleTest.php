<?php

namespace App\Tests\Unit;

use App\Entity\Article;
use PHPUnit\Framework\TestCase;

class ArticleTest extends TestCase
{
    public function testEmptyEntity(): void
    {
        $article = new Article();

        $this->assertEmpty($article->getContent());
        $this->assertEmpty($article->getTitle());
        $this->assertEmpty($article->getPublicationDate());
    }

    public function testGettersAndSetters(): void
    {
        $article = new Article();

        $content = 'content';
        $title = 'title';
        $publicationDate = new \DateTime('2022-01-01');

        $article
            ->setContent($content)
            ->setTitle($title)
            ->setPublicationDate($publicationDate)
        ;

        $this->assertSame($content, $article->getContent());
        $this->assertSame($title, $article->getTitle());
        $this->assertSame($publicationDate, $article->getPublicationDate());
    }
}
