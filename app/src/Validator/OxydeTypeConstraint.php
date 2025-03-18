<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class OxydeTypeConstraint extends Constraint
{
    public string $message = 'le type d\'oxyde doit etre 1,2 ou 3.';
    public array $typeAuthorise;
    // You can use #[HasNamedArguments] to make some constraint options required.
    // All configurable options must be passed to the constructor.
    public function __construct(
        public array $options = [],
        ?array $groups = null,
        mixed $payload = null
    ) {
        
        if(array_key_exists('typeAuthorise',$options)&&!is_array($options['typeAuthorise'])){
            throw new ConstraintDefinitionException('le "typeAuthorise" doit etre un array ');
        }
        parent::__construct($options, $groups, $payload);
        //$this->message = $options['message'];
        //$this->typeAuthorise = $options['typeAuthorise'];
        
    }

    public function getRequiredOptions(): array{
        return ['typeAuthorise'];
    }
}
