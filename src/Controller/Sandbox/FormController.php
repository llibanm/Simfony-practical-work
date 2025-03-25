<?php
namespace App\Controller\Sandbox;

use App\Entity\Sandbox\Film;
use App\Form\Sandbox\FilmType;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\MakerBundle\Validator;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/sandbox/form',name:'sandbox_form')]
class FormController extends AbstractController{

    #[Route('/film/edit/{id}',
    name:'_film_edit',
    requirements: ['id' => '[1-9]\d*']),
]
    public function filmEditAction(int $id, EntityManagerInterface $em): Response
    {
        $filmRepository = $em->getRepository(Film::class);
        $film = $filmRepository->find($id);

        if (is_null($film))
            throw new NotFoundHttpException('film ' . $id . ' inexistant');
        //throw $this->createNotFoundException('film ' . $id . ' inexistant');

        $form = $this->createForm(FilmType::class, $film);
        $form->add('send', SubmitType::class, ['label' => 'edit film']);

        $args = array(
            'myform' => $form,
            //'myform' => $form->createView(),
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
    #[Route('/film/validator',name:'_film_validator')]
    public function filmValidatorAction(ValidatorInterface $validator):Response
    {
        $film = new Film();
        $film
            ->setTitre(str_repeat('abc',100))
            ->setAnnee(1894)
            ->setEnstock(true)
            ->setPrix(0.99)
            ->setQuantite(-15)
            ;
        dump($validator->validate($film));
        return new Response('<body>cf.dump</body>');
    }



}
