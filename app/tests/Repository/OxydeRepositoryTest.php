<?php declare(strict_types=1);

namespace App\Tests\Repository;

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
        __DIR__ ."/oxydeRepositoryTestFixtures.yaml",
    ]) ;
    //$oxydes['oxyde1'];
    $oxydes = self::getContainer()->get(OxydeRepository::class)->count([]);
    $this->assertEquals(10, $oxydes);
}
}
?>