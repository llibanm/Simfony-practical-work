<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/route', name: 'app_route')]
final class RouteController extends AbstractController
{
    #[Route('', name: '')]
    public function actionIndex(): Response
    {
        return new Response('<body>RouteController</body>');    
    }

}
