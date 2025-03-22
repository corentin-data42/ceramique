<?php declare(strict_types= 1);
namespace App\Tests\Entity;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

class UtilisateurTest extends KernelTestCase{

    /** @var AbstractDatabaseTool */
    protected $databaseTool;
            
    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function getEntity():Utilisateur{
        $entity = (new Utilisateur())
        ->setEmail("email@test.fr")
        ->setNom("nom de test")
        ->setPassword("@-teZt_PazzP0rT42")
        ->setFlagEtat(true)
        ->setRoles([])
        ->setCreationAt(new \DateTimeImmutable("now - 1 day"))
        ->setModificationAt(new \DateTimeImmutable("now"))
        ;

        return $entity;
    }

    public function assertHasError(Utilisateur $entity, int $number = 0): void{
        
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

    public function test_invalidEntityUsedEmail(){
        $this->databaseTool->loadAliceFixture([
            __DIR__ .'/utilisateurTestFixtures.yaml'
        ]);
        $this->assertHasError($this->getEntity()->setEmail("deja.en.base@test.fr"),1);
        
    }
    public function test_invalidEntityBlankEmail(){
        $this->databaseTool->loadAliceFixture([
            __DIR__ .'/utilisateurTestFixtures.yaml'
        ]);
        $this->assertHasError($this->getEntity()->setEmail(""),1);
        
    }
    public function test_invalidEntityBlankNom(){
        $this->databaseTool->loadAliceFixture([
            __DIR__ .'/utilisateurTestFixtures.yaml'
        ]);
        $this->assertHasError($this->getEntity()->setNom(""),1);
        
    }
    public function test_invalidEntityBlankPassword(){
        $this->databaseTool->loadAliceFixture([
            __DIR__ .'/utilisateurTestFixtures.yaml'
        ]);
        $this->assertHasError($this->getEntity()->setPassword(""),2);
        
    }

    public function test_invalidEntityEmailConstraint(){
        $this->databaseTool->loadAliceFixture([
            __DIR__ .'/utilisateurTestFixtures.yaml'
        ]);
        $this->assertHasError($this->getEntity()->setEmail("tototo"),1);
        
    }

    public function test_invalidEntityPasswordConstraint(){
        $this->databaseTool->loadAliceFixture([
            __DIR__ .'/utilisateurTestFixtures.yaml'
        ]);
        $this->assertHasError($this->getEntity()->setPassword("tototo"),1);
        
    }
}
?>