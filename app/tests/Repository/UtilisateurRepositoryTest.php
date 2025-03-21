<?php declare(strict_types=1);
namespace App\Tests\Repository;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UtilisateurRepositoryTest extends KernelTestCase{
    /** @var AbstractDatabaseTool */
    protected $databaseTool;
    
    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function test_count(){

        $oxydes = $this->databaseTool->loadAliceFixture([
            __DIR__ ."/utilisateurRepositoryTestFixtures.yaml",
        ]) ;

        $nbUtilisateurs = self::getContainer()->get(UtilisateurRepository::class)->count([]);
        $this->assertEquals(10, $nbUtilisateurs);
    }

}
?>