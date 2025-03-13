<?php

namespace App\Controller\Sandbox;

use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Sandbox\Film;
use Doctrine\ORM\EntityManagerInterface;
#[Route('/Sandbox/doctrine',name:'sandbox_doctrine')]
class DoctrineController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function listAction(): Response
    {
        $args = array();
        return  $this->render('Sandbox/doctrine/list.html.twig', $args);
    }

#[Route(
'/view/{id}',
name: '_view',
requirements: ['id' => '[1-9]\d*'],
)]
public function viewAction(int $id){
      $args = array();
      return  $this->render('Sandbox/doctrine/view.html.twig', $args);
}
#[Route('/delete/{id}', name:'_delete',
requirements: ['id' => '[1-9]\d*'],
)]
public function deleteAction(int $id)
{
    $this->addFlash('info','suppression film'.$id.'réussie');
    return $this->redirectToRoute('Sandbox_doctrine_list');
}

#[Route('/ajouterendur',name:'_ajouterendur')]
public function ajouterendurAction(EntityManagerInterface $em):Response{
        $film = new Film();
        $film
            ->setTitre('Le grand bleu')
            ->setAnnee(1988)
            ->setEnstock(true)
            ->setPrix(9.99)
            ->setQuantite(88);
        dump($film);

        $em->persist($film);
        $em->flush();
        dump($film);

        return $this->redirectToRoute('Sandbox_doctrine_view',['id'=>$film->getId()]);
}
}
