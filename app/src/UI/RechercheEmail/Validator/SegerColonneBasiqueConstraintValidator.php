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
        foreach ($constraint->oxydesBasiques as $oxyde){
            if (!is_null($value[$oxyde->getId()]['quantite'])
                && is_numeric($value[$oxyde->getId()]['quantite'])){

                $totalvalueBasique += $value[$oxyde->getId()]['quantite'];
            }
            //
        }
        //
     
        if(round($totalvalueBasique,4)<>round(1.0,4)){
            

            $this->context->buildViolation($constraint->message)
            //->setParameter('{{ value }}', $value)
            ->addViolation()
        ;
        }
    }
}
