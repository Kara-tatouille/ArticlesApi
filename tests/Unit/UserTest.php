<?php

namespace App\Tests\Unit;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    public function testEmptyEntity(): void
    {
        $user = new User();
        $rp = new \ReflectionProperty($user::class, 'password');


        $this->assertEmpty($user->getEmail());
        $this->assertSame(['ROLE_USER'], $user->getRoles());
        $this->assertInstanceOf(ArrayCollection::class, $user->getArticles());
        $this->assertCount(0, $user->getArticles());
        $this->assertFalse($rp->isInitialized($user));
    }

    public function testGettersAndSetters(): void
    {
        $user = new User();

        $email = 'email';
        $password = 'password';
        $roles = ['ROLE_USER', 'ROLE_ADMIN'];
        $articles = [new Article(), new Article()];

        $user
            ->setEmail($email)
            ->setPassword($password)
            ->setRoles($roles)
        ;
        foreach ($articles as $article) {
            $user->addArticle($article);
        }

        $this->assertSame($email, $user->getEmail());
        $this->assertSame($password, $user->getPassword());
        $this->assertSame($roles, $user->getRoles());
        $this->assertSame($articles, $user->getArticles()->toArray());
    }
}
