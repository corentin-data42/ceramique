<?php

namespace App\Form;

use App\Entity\Fournisseur;
use App\Entity\MatierePremiere;

use App\Form\MatierePremiereOxydeQuantiteType;
use App\Repository\FournisseurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormEvents;

use Doctrine\ORM\QueryBuilder;

class MatierePremiereType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('nomCour')
            ->add('avertissement')
            ->add('pmAvantCuisson')
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
            ->add('fournisseur',EntityType::class,[
                'required'=>false,
                'empty_data' => '',
                'placeholder'=>'Matière première théorique',
                'class' => Fournisseur::class,
                'choice_label' => 'nom',
                // 'query_builder'=> function (FournisseurRepository $er): QueryBuilder {
                //     return $er->createQueryBuilder('f')
                //     ->andWhere('f.flagEtat = true')
                //     ->orderBy('f.id', 'ASC');
                // },
                
                
            ])
            ->add('quantite', CollectionType::class, [
                'label'=>'Oxydes',
                'entry_type' => MatierePremiereOxydeQuantiteType::class,
                'by_reference' =>false,
                'allow_add' =>true,
                'allow_delete' =>true,
                'entry_options' => ['label'=>false],
                'attr'=>[
                    'data-controller'=>'form-collection',
                    'data-form-collection-add-label-value'=>'Ajouter un Oxyde',
                    'data-form-collection-delete-label-value'=>'X',

                ]
            ])
            ->add('save',SubmitType::class,[
                'label'=>'Enregistrer'
            ])
            ->addEventListener( FormEvents::PRE_SET_DATA, $this->attachTimestamps(...) )
        ;
    }
    public function attachTimestamps($event):void{
        $data=$event->getData();
        if(!($data instanceof MatierePremiere)){
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
            'data_class' => MatierePremiere::class,
        ]);
    }
}
