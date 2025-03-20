<?php declare(strict_types=1);

namespace App\Tests\Repository;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use App\Repository\MatierePremiereOxydeQuantiteRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MatierePremiereOxydeQuantiteRepositoryTest extends KernelTestCase
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
    $RepFixtures = $this->databaseTool->loadAliceFixture([
       
        __DIR__ ."/matierePremiereRepositoryTestFixtures.yaml",
        __DIR__ ."/oxydeRepositoryTestFixtures.yaml",
        __DIR__ ."/matierePremiereOxydeQuantiteRepositoryTestFixtures.yaml",
    ]) ;

    $count = self::getContainer()->get(MatierePremiereOxydeQuantiteRepository::class)->count([]);

    $this->assertEquals(10, $count);
}
}
?>