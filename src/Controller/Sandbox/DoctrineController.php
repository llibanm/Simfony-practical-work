<?php

namespace App\Controller\Sandbox;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Sandbox\Film;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

#[Route('/sandbox/doctrine',name:'sandbox_doctrine')]
class DoctrineController extends AbstractController
{
    #[Route('/list', name: '_list')]
    public function listAction(): Response
    {
        $args = array();
        return  $this->render('Sandbox/Doctrine/list.html.twig', $args);
    }

#[Route(
'/view/{id}',
name: '_view',
requirements: ['id' => '[1-9]\d*'],
)]
public function viewAction(int $id) : Response
{
      $args = array();
      return  $this->render('Sandbox/Doctrine/view.html.twig', $args);
}
#[Route('/delete/{id}', name:'_delete',
requirements: ['id' => '[1-9]\d*'],
)]
public function deleteAction(int $id): Response
{
    $this->addFlash('info','suppression film'.$id.'réussie');
    return $this->redirectToRoute('sandbox_doctrine_list');
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

        return $this->redirectToRoute('sandbox_doctrine_view',['id'=>$film->getId()]);
}

#[Route('/modifierendur',name:'_modifierendur')]
public function modifierendurAction(EntityManagerInterface $em,Film $film):Response{
        $id = 2;
        $filmRespository = $em->getRepository(Film::class);
        $film = $filmRespository->find($id);

        $film
            ->setPrix(15.98)
            ->setQuantite($film->getQuantite()+10);

        $em->flush();
        return $this->redirectToRoute('sandbox_doctrine_view',['id'=>$film->getId()]);
}
}
