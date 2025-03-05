<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'accueil_index')]
    public function indexAction(): Response
    {
        return $this->render('Accueil/index.html.twig');
    }

    // pour inclusion de contrôleur dans le template secondaire : action non routable
    public function menuAction(): Response
    {
        $args = array(
        );
        return $this->render('Layouts/_menu.html.twig', $args);
    }
}
