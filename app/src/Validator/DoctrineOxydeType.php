<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
final class DoctrineOxydeType extends Constraint
{
    public string $message = 'le type d\'oxyde doit etre 1,2 ou 3.';
    public array $typeAuthorise;
    // You can use #[HasNamedArguments] to make some constraint options required.
    // All configurable options must be passed to the constructor.
    public function __construct(
        public array $options,
        ?array $groups = null,
        mixed $payload = null
    ) {
        $this->message = $options['message'];
        $this->typeAuthorise = $options['typeAuthorise'];
        parent::__construct([], $groups, $payload);
    }
}
