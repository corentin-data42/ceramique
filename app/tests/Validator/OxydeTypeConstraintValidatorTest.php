<?php
namespace App\Tests\Validator;


use App\Validator\OxydeTypeConstraint;
use App\Validator\OxydeTypeConstraintValidator;
use PHPUnit\Framework\TestCase;
use PHPUnit\Util\InvalidDataSetException;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\MissingOptionsException;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;
use TypeError;

class OxydeTypeConstraintValidatorTest extends TestCase{

    public function getValidator($expectedViolation = true){

        $validator = new OxydeTypeConstraintValidator();
        
        // recuperation du context via un mock
        $context = $this->getMockBuilder
        (ExecutionContextInterface::class)->getMock();

        if($expectedViolation){
            /** juste pour suivre le tuto car il semble que cela fonction sans (symfony plus recent) */
            $violation = $this->getMockBuilder
                (ConstraintViolationBuilderInterface::class)->getMock();
            
            // on s'attend a ce que la methode setParameter soit appelé plusieur fois
            $violation->expects($this->any())
                    ->method('setParameter')
                    ->willReturn($violation);
            
            // on s'attend a ce que la methode addViolation soit appelé une fois        
            $violation->expects($this->any())
                    ->method('addViolation');

            // on s'attend a ce que la methode buildViolation soit appelé une fois
            $context->expects($this->once())
                    ->method('buildViolation')
                    ->willReturn($violation);

            
        }else{

            // on s'attend a ce que la methode buildViolation ne soit jamais appelé
            $context->expects($this->never())
            ->method('buildViolation');
        }
        $validator->initialize($context);
        return $validator;
    }

    public function test_catchBadTypeAuthorise(){
        
        $constraint = new OxydeTypeConstraint(['typeAuthorise'=>[1,2,3]]);
        $this->getValidator(true)->validate("5",$constraint);

    }

    public function test_catchGoodTypeAuthorise(){
        
        $constraint = new OxydeTypeConstraint(['typeAuthorise'=>[1,2,3]]);
        $this->getValidator(false)->validate("2",$constraint);

    }

}

?>