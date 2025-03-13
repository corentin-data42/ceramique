<?php

namespace UI\RechercheEmail\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class SegerColonneBasiqueConstraint extends Constraint
{
    public string $message = 'La somme des oxydes de la colonne Basique doit etre egal à un.';

    // You can use #[HasNamedArguments] to make some constraint options required.
    // All configurable options must be passed to the constructor.
    public function __construct(
        public array $oxydesBasiques,
        public string $mode = 'strict',
        
        ?array $groups = null,
        mixed $payload = null
    ) {

        parent::__construct([], $groups, $payload);
    }
    
}
