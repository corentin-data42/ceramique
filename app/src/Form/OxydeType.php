<?php

namespace App\Form;

use App\Entity\Oxyde;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OxydeType extends AbstractType
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
            ->add('flagEtat',CheckboxType::class,[
                'required'=>false,
                'attr'=>[
                    'class'=>'btn-check',
                    'autocomplete'=>"off",
                    'empty_data'=>false,
                    
                ],
                'label_attr' => ['class' => 'btn btn-outline-success']
            ])
            ->add('save',SubmitType::class,[
                'label'=>'Enregistrer'
            ])
            ->addEventListener( FormEvents::PRE_SET_DATA, $this->attachTimestamps(...) )
        ;
    }

    public function attachTimestamps($event):void{
        $data=$event->getData();
        if(!($data instanceof Oxyde)){
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
            'data_class' => Oxyde::class,
        ]);
    }
}
