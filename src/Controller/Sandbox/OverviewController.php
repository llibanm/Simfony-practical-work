<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class OverviewController extends AbstractController{
    #[Route('/sandbox/overview', name: 'app_sandbox_overview')]
    public function indexAction(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/Sandbox/OverviewController.php',
        ]);
    }
}
