<?php
namespace App\Controller\Sandbox;

use App\Entity\Sandbox\Film;
use App\Form\Sandbox\FilmType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/sandbox/form',name:'sanbox_form')]
class FormController extends AbstractController{

    #[Route('/film/edit/{id}',
    name:'_film_edit',
    requirements: ['id' => '[1-9]\d*']),
]
    public function filmEditAction(int $id,EntityManagerInterface $em,):Response{
        $filmRepository = $em->getRepository(Film::class);
        $film = $filmRepository->find($id);

        if(is_null($film)){
            throw new NotFoundHttpException('film '.$id.' inexsistant ');
        }
        $form = $this->createForm(FilmType::class, $film);
        $form->add('send', SubmitType::class,['label'=>' edit film']);

        $args = array(
            'myform' => $form->createView(),
        );
        return $this->render('Sandbox/Form/film_edit.html.twig', $args);
    }


    #[Route('/film/editbis/{id}',
        name:'_film_editbis',
        requirements: ['id' => '[1-9]\d*']),
    ]
    public function filmEditbisAction(int $id,EntityManagerInterface $em,Request $request):Response{
        $filmRepository = $em->getRepository(Film::class);
        $film = $filmRepository->find($id);

        if(is_null($film)){
            throw new NotFoundHttpException('film '.$id.' inexsistant ');
        }
        $form = $this->createForm(FilmType::class, $film);
        $form->add('send', SubmitType::class,['label'=>' edit film']);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em->flush();
            $this->addFlash('info','edition film réussie');
            return $this->redirectToRoute('Sandbox_doctrine_critique_view2',[
                'id'=>$film->getId(),
            ]);
        }
        if($form->isSubmitted())
            $this->addFlash('info','formulaire film incorrecte');

        $args = array(
            'myform' => $form,
        );
        return $this->render('Sandbox/Form/film_editbis.html.twig', $args);
    }

}
