<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class OxydeTypeConstraintValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        /* @var OxydeType $constraint */

        if (null === $value || '' === $value) {
            return;
        }

        // TODO: implement the validation here
        if(!in_array($value,$constraint->typeAuthorise)){
            // TODO: implement the validation here
            $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation()
            ;
        }
    }
}
