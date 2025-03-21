<?php declare(strict_types= 1);

namespace App\Tests\Repository;

use App\Repository\FournisseurRepository;

use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;


class FournisseurRepositoryTest extends KernelTestCase {
    /** @var AbstractDatabaseTool */
    protected $databaseTool;

    public function setUp(): void
    {
        parent::setUp();

        self::bootKernel();

        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testCount(): void{
        $this->databaseTool->loadAliceFixture([
            __DIR__."/fournisseurRepositoryTestFixtures.yaml",
        ]);
        $count = self::getContainer()->get(FournisseurRepository::class)->count();
        $this->assertEquals(10, $count);
    }

}

?>