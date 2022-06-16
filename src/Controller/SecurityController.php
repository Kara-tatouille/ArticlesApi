<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class SecurityController extends AbstractController
{
    #[Route(path: '/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(Request $request, #[CurrentUser] ?User $user): Response
    {
        if ($request->getMethod() === 'GET') {
            return $this->render('security/login.html.twig');
        }

        return $this->json([
            'user' => $user?->getId(),
        ]);
    }

    #[Route(path: '/api/login', name: 'app_api_login', methods: ['POST'])]
    public function loginApi(#[CurrentUser] ?User $user): JsonResponse
    {
        if (!$user) {
            return $this->json([
                'message' => 'missing credentials',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $this->json([
            'user' => $user->getId(),
        ]);
    }

    #[Route(path: '/api/logout', name: 'app_logout')]
    public function logout(): never
    {
        throw new \LogicException('Route handled by the Security service');
    }
}
