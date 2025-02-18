<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

#[Route('/sandbox/route', name: 'app_route')]
final class RouteController extends AbstractController
{
    #[Route('', name: '')]
    public function actionIndex(): Response
    {
        return new Response('<body>RouteController</body>');    
    }

    #[Route('/with-variable/{age}'
    ,name:'_with_variable')]
    public function withVariableAction(int $age): Response{

        return new Response('<body:>Route::with variable: age : '.$age.'</body>');
    }
    #[Route('/with-default/{age}'
    ,name:'_with_default',
    defaults:['age'=>18],
    )]
    public function withDefaultAction($age) : Response {
        dump($age);
        return new Response('<body>Route::with default: age : '.$age.'(' . gettype($age) . ')'.'</body>');
    }

}
