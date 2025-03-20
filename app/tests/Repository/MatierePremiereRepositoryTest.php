<?php declare(strict_types=1);

namespace App\Tests\Repository;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use App\Repository\MatierePremiereRepository;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MatierePremiereRepositoryTest extends KernelTestCase
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
    ]) ;
    //$RepFixtures['matierePremiere1'];
    $count = self::getContainer()->get(MatierePremiereRepository::class)->count([]);
    $this->assertEquals(10, $count);
}
}
?>