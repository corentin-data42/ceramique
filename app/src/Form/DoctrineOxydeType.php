<?php

namespace App\Form;

use App\Entity\DoctrineOxyde;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DoctrineOxydeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('pm')
            ->add('formule')
            ->add('type',ChoiceType::class,[
            'choices'  => [
                    'basic' => 1,
                    'amphotere' => 2,
                    'acide' => 3,
                ],
                'multiple'=>false,
                'label'=>'Classification Oxyde',
                'expanded'=>true
            ])
            ->add('ordre')
            ->add('actif')
            ->add('save',SubmitType::class,[
                'label'=>'Enregistrer'
            ])
            ->addEventListener( FormEvents::POST_SUBMIT, $this->attachTimestamps(...) )
        ;
    }

    public function attachTimestamps(PostSubmitEvent $event):void{
        $data=$event->getData();
        if(!($data instanceof DoctrineOxyde)){
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
            'data_class' => DoctrineOxyde::class,
        ]);
    }
}
