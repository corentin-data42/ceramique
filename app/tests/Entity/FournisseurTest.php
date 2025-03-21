<?php declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\Fournisseur;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;



class FournisseurTest extends KernelTestCase{

    /** @var AbstractDatabaseTool */
    protected $databaseTool;
            
    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }
    private function assertHasErrors(Fournisseur $entity, int $nbErrors = 0,bool $debug=false){
        $errors = self::getContainer()->get("validator")->validate($entity);
        $messages =[];
        foreach($errors as $error){
            $messages[] = $error->getPropertyPath().' => '.$error->getMessage();
        }
        if($debug){
            dump($messages);
        }
        $this->assertCount($nbErrors, $errors, implode(',', $messages));
    
    }
    private function getEntity():Fournisseur{
        $entity = (new Fournisseur())
            ->setId(2)
            ->setNom("nomTest")
            ->setFlagEtat(true)
            ->setCreationAt(new \DateTimeImmutable("now"))
            ->setModificationAt(new \DateTimeImmutable("now"));
        return $entity;
    }

    public function test_validEntity(){
        $entity = $this->getEntity();
        $this->assertHasErrors($entity,0);
    }

    public function test_invalidEntityBlankNom(){
        $entity = $this->getEntity()->setNom("");
        $this->assertHasErrors($entity,1);
    }

    public function test_invalidEntityUsedNom(){
        $this->databaseTool->loadAliceFixture([
            __DIR__."/fournisseurTestFixtures.yaml",
        ]);
        $entity = $this->getEntity()->setNom("nomTest unique");
        $this->assertHasErrors($entity,1);
    }
}

?>