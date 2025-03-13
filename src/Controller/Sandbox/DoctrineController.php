<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class DoctrineController extends AbstractController
{
    #[Route('/sandbox/doctrine', name: 'app_sandbox_doctrine')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Sandbox/DoctrineController.php',
        ]);
    }
}
