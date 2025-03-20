<?php

namespace App\Tests\Entity;


use App\Entity\MatierePremiereOxydeQuantite;
use App\Entity\Oxyde;
use App\Entity\MatierePremiere;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;


class MatierePremiereOxydeQuantiteTest extends KernelTestCase{

    /** @var AbstractDatabaseTool */
    protected $databaseTool;
        
    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }
    
    public function getEntity($debug=false):MatierePremiereOxydeQuantite{
        $matierePremiere = (new MatierePremiere())
            ->setId(1)
            ->setNom("Matiere premiere initial")
            ->setNomCour('test nom cour')
            ->setAvertissement('test avertissement')
            ->setOrdre(rand(0,10))
            ->setFlagEtat(true)
            ->setCreationAt(new \DateTimeImmutable("now"))
            ->setModificationAt(new \DateTimeImmutable("now"))
            ->addQuantite((new MatierePremiereOxydeQuantite())
                                        ->setQuantite(12.3)
                                        );

        $oxyde = $this->getEntityOxyde();
        if($debug){
            dump($matierePremiere->getId());
        }
        
        $entity = (new MatierePremiereOxydeQuantite())
            ->setId(1)
            ->setQuantite(12.3)
            ->setOxyde($oxyde)
            ->setMatierePremiere($matierePremiere);
            ;
        return $entity;
    }

    public function getEntityOxyde():Oxyde{
        
        $oxyde = (new Oxyde())
        ->setId(2)
        ->setNom("Oxyde d'antimoine")
        ->setPm(137.7594)
        ->setFormule("Test")
        ->setType(rand(1,3))
        ->setOrdre(rand(0,10))
        ->setFlagEtat(true)
        ->setCreationAt(new \DateTimeImmutable("now"))
        ->setModificationAt(new \DateTimeImmutable("now"));

        return $oxyde;
    }

    /**
     * Summary of assertHasError
     * @param \App\Entity\MatierePremiereOxydeQuantite $entity
     * @param int $number nombre d'erreurs
     * @return void
     */
    public function assertHasError(MatierePremiereOxydeQuantite $entity, int $number = 0,bool $debug=false): void{
        
        $errors = self::getContainer()->get('validator')->validate($entity);
        $messages = [];
        if($debug){
            dump($entity);
            dump($errors);
        }
        /**@var ConstraintViolation $error */
        foreach($errors as $error){
            $messages[]= $error->getPropertyPath().' => '.$error->getMessage();
        }
        $this->assertCount($number, $errors,implode(',',$messages));
        
    }
    public function test_validEntity(){
        $this->assertHasError($this->getEntity(),0);
    }

    public function test_invalidEntityPositiveQuantite():void{
        $this->assertHasError($this->getEntity()->setQuantite(0.0),1);
    }

    public function test_invalidEntityOxydeAlreadyUsed():void{
        $this->databaseTool->loadAliceFixture([
            __DIR__ ."/matierePremiereOxydeQuantiteTestFixtures.yaml",
        ]);
        $entity = $this->getEntity();
        $entity->getOxyde()->setId(1);

        $this->assertHasError($entity,1); 
    }
}


?>