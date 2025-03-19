<?php

namespace App\Tests\Entity;

use App\Entity\MatierePremiere;
use App\Repository\MatierePremiereRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;


class MatierePremiereTest extends KernelTestCase{

    /** @var AbstractDatabaseTool */
    protected $databaseTool;
        
    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }
    
    public function getEntity():MatierePremiere{
        $entity = (new MatierePremiere())
            ->setNom("MatierePremiere de test")
            ->setNomCour('test nom cour')
            ->setAvertissement('test avertissement')
            ->setOrdre(rand(0,10))
            ->setFlagEtat(true)
            ->setCreationAt(new \DateTimeImmutable("now"))
            ->setModificationAt(new \DateTimeImmutable("now"));
        return $entity;
    }

    /**
     * Summary of assertHasError
     * @param \App\Entity\MatierePremiere $entity
     * @param int $number nombre d'erreurs
     * @return void
     */
    public function assertHasError(MatierePremiere $entity, int $number = 0): void{
        
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
        $this->assertHasError($this->getEntity()->setNom(""),1);
    }
    public function test_invalidEntityBlankNom():void{
        $this->assertHasError($this->getEntity()->setNom(""),1);
    }
    public function test_invalidEntityBlankNomCour():void{
        $this->assertHasError($this->getEntity()->setNomCour(""),1);
    }

    public function test_invalidEntityPositivePm():void{
        $this->assertHasError($this->getEntity()->setPmAvantCuisson(0.0),1);
    }
}


?>