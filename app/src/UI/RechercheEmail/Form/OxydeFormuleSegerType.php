<?php

namespace UI\RechercheEmail\Form;
use UI\RechercheEmail\Adaptateur\RechercheEmailAdaptateur;

use App\Entity\DoctrineMatierePremiere;
use App\Entity\DoctrineMatierePremiereOxyde;
use App\Entity\DoctrineOxyde;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use App\Repository\DoctrineOxydeRepository;
use Application\RechercheEmail\Query\GetAllOxydeActifQuery;

use Symfony\Component\Validator\Constraints as Assert;

class OxydeFormuleSegerType extends AbstractType
{
    private array $colonneUlm =[];
    private const _LIBELLE_COLONNE_UML = [
        1=>'basiques',
        2=>'amphoteres',
        3=>'acides'

    ];
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder->add('quantite', TextType::class,[
            'label'=>false,
            'constraints' => [
                                new Assert\Type('numeric'),
                                new Assert\Positive()
                            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        
        // $resolver->setDefaults([
        //     'data_class' => DoctrineMatierePremiereOxyde::class,
        // ]);
    }
}
