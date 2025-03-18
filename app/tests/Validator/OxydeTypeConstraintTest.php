<?php
namespace App\Tests\Validator;


use App\Validator\OxydeTypeConstraint;
use PHPUnit\Framework\TestCase;
use PHPUnit\Util\InvalidDataSetException;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\MissingOptionsException;
use TypeError;

class OxydeTypeConstraintTest extends TestCase{


    public function test_requiredParameters (){
        $this->expectException(MissingOptionsException::class);

        new OxydeTypeConstraint();
    }

    public function test_badShapedTypeAuthoriseParameters (){
        $this->expectException(ConstraintDefinitionException::class);
        $options = [
            'typeAuthorise'=>'je devrai etre un tableau'
        ];
        new OxydeTypeConstraint($options);
    }
    public function test_optionsAreSetAsProperty (){
        $options = [
            'message'=>'message de test',
            'typeAuthorise'=>[1,2,3]
        ];
        $constraint = new OxydeTypeConstraint($options);
        $this->assertEquals($options['typeAuthorise'],$constraint->typeAuthorise);
        $this->assertEquals($options['message'],$constraint->message);
    }
}

?>