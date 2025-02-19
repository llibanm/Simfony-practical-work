<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/sandbox/injection', name: 'app_injection')]
final class InjectionController extends AbstractController
{
    #[Route('', name: '')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/InjectionController.php',
        ]);
    }

    #[Route('/un', name: '_un')]
    public function un(Request $request): Response
    {
        dump($request);
        return new Response('<body>InjectionController::un</body>');
    }
}
