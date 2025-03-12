<?php

namespace App\Form;

use App\Entity\DoctrineMatierePremiere;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctrineMatierePremiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('formule')
            ->add('pmAvantCuisson')
            ->add('ordre')
            ->add('active')
            ->add('oxydes', CollectionType::class, [
                'label'=>'Oxydes',
                'entry_type' => DoctrineMatierePremiereOxydeQuantiteType::class,
                'by_reference' =>false,
                'allow_add' =>true,
                'allow_delete' =>true,
                'entry_options' => ['label'=>false],
                'attr'=>[
                    'data-controller'=>'form-collection',
                    'data-form-collection-add-label-value'=>'Ajouter un Oxyde',
                    'data-form-collection-delete-label-value'=>'Supprime',
                ]
            ])
            ->add('save',SubmitType::class,[
                'label'=>'Enregistrer'
            ])
            ->addEventListener( FormEvents::POST_SUBMIT, $this->attachTimestamps(...) )
        ;
    }
    public function attachTimestamps(PostSubmitEvent $event):void{
        $data=$event->getData();
        if(!($data instanceof DoctrineMatierePremiere)){
            return;
        }
        // data est de type Oxyde
        $data->setModificationAt(new \DateTimeImmutable());
        if(!$data->getId()){
            $data->setCreationAt(new \DateTimeImmutable());
        }
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DoctrineMatierePremiere::class,
        ]);
    }
}
