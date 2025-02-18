<?php

namespace App\Controller\Sandbox;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sandbox/prefix', name: 'sandbox_prefix')]
final class PrefixController extends AbstractController{
    #[Route('', name: '')]
    public function indexAction(): Response
    {
        return new Response('Hello, World!');
    }

    #[Route('/hello2', name: '_hello2')]
    public function hello2Action():Response
    {
        return $this->render('Sandbox/Overview/hello2.html.twig'); 
    }
    
    #[Route('/hello3', name: '_hello3')]
    public function hello3Action(): Response
    {
        $args = array(
            'prenom' => 'Liban',
            'jeux' => ['Monster Hunter 4 Ultimate','Arknights','Arknight:Endfield','wild Rift'],

        );
        return $this->render('Sandbox/prefix/hello3.html.twig',$args); 
    }
    
    #[Route('/hello4', name: '_hello4')]
    public function hello4Action(): Response
    {
        $args = array(
            'prenom' => 'Liban',
            'jeux' => ['Monster Hunter 4 Ultimate','Monster Hunter Wilds','Arknights','Arknight:Endfield','wild Rift'],

        );
        return $this->render('Sandbox/prefix/hello4.html.twig',$args); 
    }

}
