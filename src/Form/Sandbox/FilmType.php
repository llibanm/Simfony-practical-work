<?php

namespace App\Form\Sandbox;

use App\Entity\Sandbox\Film;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\TextType;
use PhpParser\Builder\Interface_;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre',
            TextType::class,
            [
                'label' => 'Titre du film',
                'attr' => ['placeholder' => 'Titre '],
            ])
            ->add('annee',
            IntegerType::class,
            [
                'label' => 'année de sortie',
            ])
            ->add('enstock',
            ChoiceType::class,
            [
                'label' => 'Enstock',
                'choices' => ['oui'=>true,'non'=>false],
                'expanded' => true,
            ])
            ->add('prix',
            NumberType::class,
            [
                'label' => 'Prix d\'achat',
            ])
            ->add('quantite',
            IntegerType::class,
            [
                'label' => 'quanité en stock',
                'help' => '0 si "enstock" est à "non"',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}
