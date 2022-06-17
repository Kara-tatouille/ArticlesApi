<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    #[Route(path: '/authentication_token', name: 'app_api_login', methods: ['POST'])]
    public function loginApi(): never
    {
        throw new \LogicException('Route handled by the Security service');
    }

    #[Route(path: '/api/logout', name: 'app_logout')]
    public function logout(): never
    {
        throw new \LogicException('Route handled by the Security service');
    }
}
