<?php

namespace App\Form;

use App\Entity\Fournisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Form\SubmitButton;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FournisseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'required'=>true,
            ])
            ->add('flagEtat',CheckboxType::class,[
                'label'=>'Actif',
                'required'=>false,
                'attr'=>[
                    'class'=>'btn-check',
                    'autocomplete'=>"off",
                ],
                'label_attr'=>[
                    'class'=> 'btn btn-outline-success',
                ]
            ])
            ->add('save',SubmitType::class,[
                'label'=>'enregistrer',
            ])
            ->addEventListener(FormEvents::PRE_SET_DATA, $this->attachTimestamps(...))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Fournisseur::class,
        ]);
    }
    public function attachTimestamps( $event):void{
        $data=$event->getData();
        if(!($data instanceof Fournisseur)){
            return;
        }
        // data est du type demandé
        $data->setModificationAt(new \DateTimeImmutable());
        if(!$data->getId()){
            $data->setCreationAt(new \DateTimeImmutable());
        }
    }
}
