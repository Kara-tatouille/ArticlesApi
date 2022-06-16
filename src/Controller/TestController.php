<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route(path: "/foo", name: 'foo')]
    public function foo(EntityManagerInterface $em, UserPasswordHasherInterface $hasher)
    {
        $user = (new User())->setEmail('test@example.com')
        ;
        $user->setPassword($hasher->hashPassword($user,'foo'));


        $em->persist($user);
        $em->flush();
    }
}
