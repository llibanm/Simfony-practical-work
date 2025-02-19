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


    #[Route('/with-constraint/{age}',
    name:'_with_constraint',
    requirements:['age'=>'0|[1-9]\d*'],
    defaults:['age'=>18],
    )]  
    public function withConstraintAction(int $age) : Response {
        dump($age);
        return new Response('<body>Route::with constraint: age : '.$age.'(' . gettype($age) . ')'.'</body>');
    }

    #[Route('/test1/{year}/{month}/{filename}.{ext}',
    name:'_test1',
    )]  
    public function test1Action($year,$month,$filename,$ext) : Response {
        
        $args = array(
            'title' => 'test1',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );

        return $this->render('Sandbox/Route/test1234.html.twig', $args);
    }

    #[Route('/test2/{year}/{month}/{filename}.{ext}',
    name:'_test2',
    requirements:['year'=>'[1-9]\d{3}',
                'month'=>'(0?[1-9])|1[0-2]',
                'filename'=>'[-a-zA-Z]+',
                'ext'=>'jpg|jpeg|png|ppm',],
                
    )]  
    public function test2Action(int $year,int $month,string $filename,string $ext) : Response {
        
        $args = array(
            'title' => 'test2',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );

        return $this->render('Sandbox/Route/test1234.html.twig', $args);
    }

    #[Route('/test3/{year}/{month}/{filename}.{ext}',
    name:'_test3',
    requirements:['year'=>'[1-9]\d{3}',
                'month'=>'(0?[1-9])|1[0-2]',
                'filename'=>'[-a-zA-Z]+',
                'ext'=>'jpg|jpeg|png|ppm',],
    defaults:['ext'=>'png'],            
    )]  
    public function test3Action(int $year,int $month,string $filename,string $ext) : Response {
        
        $args = array(
            'title' => 'test3',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );

        return $this->render('Sandbox/Route/test1234.html.twig', $args);
    }

    #[Route('/test4/{year}/{month}/{filename}.{ext}',
    name:'_test4',
    requirements:['year'=>'[1-9]\d{3}',
                'month'=>'(0?[1-9])|1[0-2]',
                'filename'=>'[-a-zA-Z]+',
                'ext'=>'jpg|jpeg|png|ppm',],
    defaults:['ext'=>'png',
            'filename'=>'picture',
              'month'=>'01',],
    )]  
    public function test4Action(int $year,int $month,string $filename,string $ext) : Response {
        
        $args = array(
            'title' => 'test3',
            'year' => $year,
            'month' => $month,
            'filename' => $filename,
            'ext' => $ext,
        );

        return $this->render('Sandbox/Route/test1234.html.twig', $args);
    }
}
