<?php

namespace App\Form;

use App\Entity\MatierePremiere;
use App\Entity\MatierePremiereOxydeQuantite;
use App\Entity\Oxyde;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MatierePremiereOxydeQuantiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('oxyde', EntityType::class, [
                'class' => Oxyde::class,
                'label'=>' ',
                'choice_label' => 'formule',
                'attr'=>[
                    'label'=>'',
                ]
            ])
            ->add('quantite',NumberType::class,[
                'attr'=>[
                    
                ]
            ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MatierePremiereOxydeQuantite::class,
        ]);
    }
}
