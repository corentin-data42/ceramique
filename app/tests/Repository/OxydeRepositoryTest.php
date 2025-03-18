<?php
namespace App\Tests\Repository;

use App\DataFixtures\UserFixtures;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use App\Repository\OxydeRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class OxydeRepositoryTest extends KernelTestCase
{
    /** @var AbstractDatabaseTool */
    protected $databaseTool;
    
    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

public function testCount(){

    $oxydes = $this->databaseTool->loadAliceFixture([
        __DIR__ ."/../Fixtures/oxydeRepositoryTestFixtures.yaml",
    ]) ;
    $oxydes['oxyde1'];
    $oxydes = self::getContainer()->get(OxydeRepository::class)->count([]);
    //$users = self::getContainer()->get(UserRepository::class)->count([]);

    
//$users = $kernel->getContainer()->get(UserRepository::class)->count([]);
    $this->assertEquals(10, $oxydes);
}
}
?>