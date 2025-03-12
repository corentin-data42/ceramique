<?php

namespace App\Form;

use App\Entity\DoctrineMatierePremiere;
use App\Entity\DoctrineMatierePremiereOxyde;
use App\Entity\DoctrineOxyde;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctrineMatierePremiereOxydeQuantiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantite')
            ->add('oxyde', EntityType::class, [
                'class' => DoctrineOxyde::class,
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DoctrineMatierePremiereOxyde::class,
        ]);
    }
}
