<?php

namespace UI\RechercheEmail\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

final class SegerColonneBasiqueConstraintValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        /* @var SegerColonneBasiqueConstraint $constraint */

        if (null === $value || '' === $value) {
            return;
        }
        $totalvalueBasique=0;
        foreach ($constraint->oxydesBasique as $oxyde){
            if (array_key_exists($oxyde->getId(),$value)){
                array_push($valueBasique,$oxyde);
            }
        }
        dd($value);
        // TODO: implement the validation here
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $value)
            ->addViolation()
        ;
    }
}
