<?php

namespace UI\GestionUtilisateur\Form;

use UI\GestionUtilisateur\DTO\UtilisateurDTO;
use UI\GestionUtilisateur\Enum\Roles;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\Validator\Constraints as Assert;




use phpDocumentor\Reflection\Types\Nullable;

class UtilisateurCreateType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        
        $builder
            ->add('nom',TextType::class,[
                'constraints'=> [
                    new Assert\NotBlank(),
                ]
            ])
            ->add('email',TextType::class,[
                'constraints'=> [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints'=> [
                    new Assert\NotBlank(),
                    new Assert\PasswordStrength([
                        'minScore' => Assert\PasswordStrength::STRENGTH_MEDIUM,
                    ]),
                ],
                'invalid_message' => 'The password fields must match.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
                'mapped' => false,
            ])

            ->add('roles', EnumType::class, [
                'required' => true,
                'class' => Roles::class,

                'multiple'  => true,
                'expanded'=>true,
                'placeholder' => false,
                ])

            ->add('flagEtat',CheckboxType::class,[
                'constraints'=>[
                    new Assert\Type('boolean')
                ],
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
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        
        $resolver->setDefaults([
            'data_class' => UtilisateurDTO::class,
        ]);
    }
}
