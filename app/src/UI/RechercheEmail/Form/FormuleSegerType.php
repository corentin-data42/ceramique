<?php

namespace App\UI\RechercheEmail\Form;
use App\UI\RechercheEmail\Form\OxydeFormuleSegerType;
use App\UI\RechercheEmail\Adaptateur\RechercheEmailAdaptateur;



use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;



use App\Repository\DoctrineOxydeRepository;
use Application\RechercheEmail\Query\GetAllOxydeActifQuery;

use phpDocumentor\Reflection\Types\Nullable;

class FormuleSegerType extends AbstractType
{
    private array $colonneUlm =[];
    private const _LIBELLE_COLONNE_UML = [
        1=>'basiques',
        2=>'amphoteres',
        3=>'acides'

    ];
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $adaptateur = RechercheEmailAdaptateur::getInstance();
        $query = new GetAllOxydeActifQuery();
        
        $oxydes = $adaptateur->getAllOxydeActif($query);

        foreach(SELF::_LIBELLE_COLONNE_UML as $type=>$libelleType){

            $builder->add(  $type,
                            FormType::class, 
                            ['inherit_data' => true,
                            'label'=>$libelleType
                        ]); 
            
            foreach($oxydes as $oxyde){
                
                if($oxyde->gettype()==$type){
                    $builder->get($type)->add(
                        $oxyde->getId(),
                        OxydeFormuleSegerType::class,[
                            'required'=>false,
                            'label_format' => $oxyde->getFormule()
                        ]);
                }
            }
        }
        //dd($builder);
        
        /*
        $builder->add(
    $builder->create('group1', FormType::class, array('inherit_data' => true))
        ->add('email', EmailType::class, array())
        ->add('field1', TextType::class, array())
);
        
        */
      

        $builder->add('button',SubmitType::class,[
            'label'=>'Convertir'
        ])
        ;
       // dd($builder);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        
        // $resolver->setDefaults([
        //     'data_class' => DoctrineMatierePremiereOxyde::class,
        // ]);
    }

    /**
     * Get the value of colonneUlm
     */ 
    public function getColonneUlm():array
    {
        return $this->colonneUlm;
    }

    /**
     * Set the value of colonneUlm
     *
     * @return  self
     */ 
    public function setColonneUlm($colonneUlm):self
    {
        $this->colonneUlm = $colonneUlm;

        return $this;
    }
}
