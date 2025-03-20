<?php

namespace App\Tests\Entity;

use App\Entity\Oxyde;
use App\Repository\OxydeRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;


class OxydeTest extends KernelTestCase{

    /** @var AbstractDatabaseTool */
    protected $databaseTool;
        
    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }
    
    public function getEntity():Oxyde{
        $entity = (new Oxyde())
            ->setNom("Oxyde d'antimoine")
            ->setPm(137.7594)
            ->setFormule("Sb8")
            ->setType(rand(1,3))
            ->setOrdre(rand(0,10))
            ->setFlagEtat(true)
            ->setCreationAt(new \DateTimeImmutable("now"))
            ->setModificationAt(new \DateTimeImmutable("now"));
        return $entity;
    }

    /**
     * Summary of assertHasError
     * @param \App\Entity\Oxyde $entity
     * @param int $number nombre d'erreurs
     * @return void
     */
    public function assertHasError(Oxyde $entity, int $number = 0): void{
        
        $errors = self::getContainer()->get('validator')->validate($entity);
        $messages = [];
        
        /**@var ConstraintViolation $error */
        foreach($errors as $error){
            $messages[]= $error->getPropertyPath().' => '.$error->getMessage();
        }
        $this->assertCount($number, $errors,implode(',',$messages));
        
    }
    public function test_validEntity(){
        $this->assertHasError($this->getEntity(),0);
        
    }
    public function test_invalidEntity():void{
        $this->assertHasError($this->getEntity()->setType(4),1);
    }
    public function test_invalidEntityBlankNom():void{
        $this->assertHasError($this->getEntity()->setNom(""),1);
    }
    public function test_invalidEntityBlankFormule():void{
        $this->assertHasError($this->getEntity()->setFormule(''),1);
    } 
    public function test_invalidEntityBlankType():void{
        $this->assertHasError($this->getEntity()->setType(0),1);
    } 
    public function test_invalidEntityPositivePm():void{
        $this->assertHasError($this->getEntity()->setPm(0.0),1);
    }
    public function test_invalidEntityUsedFormule():void{
        $this->databaseTool->loadAliceFixture([
            __DIR__ ."/oxydeTestFixtures.yaml",
        ]) ;
        $this->assertHasError($this->getEntity()->setFormule("SbO"),1); 
    }
}


?>