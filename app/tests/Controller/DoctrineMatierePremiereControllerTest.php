<?php

namespace App\Tests\Controller;

use App\Entity\DoctrineMatierePremiere;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

final class DoctrineMatierePremiereControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $doctrineMatierePremiereRepository;
    private string $path = '/doctrine/matiere/premiere/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->doctrineMatierePremiereRepository = $this->manager->getRepository(DoctrineMatierePremiere::class);

        foreach ($this->doctrineMatierePremiereRepository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $this->client->followRedirects();
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('DoctrineMatierePremiere index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'doctrine_matiere_premiere[nom]' => 'Testing',
            'doctrine_matiere_premiere[formule]' => 'Testing',
            'doctrine_matiere_premiere[pmAvantCuisson]' => 'Testing',
            'doctrine_matiere_premiere[ordre]' => 'Testing',
            'doctrine_matiere_premiere[active]' => 'Testing',
            'doctrine_matiere_premiere[creationAt]' => 'Testing',
            'doctrine_matiere_premiere[modificationAt]' => 'Testing',
        ]);

        self::assertResponseRedirects($this->path);

        self::assertSame(1, $this->doctrineMatierePremiereRepository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new DoctrineMatierePremiere();
        $fixture->setNom('My Title');
        $fixture->setFormule('My Title');
        $fixture->setPmAvantCuisson('My Title');
        $fixture->setOrdre('My Title');
        $fixture->setActive('My Title');
        $fixture->setCreationAt('My Title');
        $fixture->setModificationAt('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('DoctrineMatierePremiere');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new DoctrineMatierePremiere();
        $fixture->setNom('Value');
        $fixture->setFormule('Value');
        $fixture->setPmAvantCuisson('Value');
        $fixture->setOrdre('Value');
        $fixture->setActive('Value');
        $fixture->setCreationAt('Value');
        $fixture->setModificationAt('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'doctrine_matiere_premiere[nom]' => 'Something New',
            'doctrine_matiere_premiere[formule]' => 'Something New',
            'doctrine_matiere_premiere[pmAvantCuisson]' => 'Something New',
            'doctrine_matiere_premiere[ordre]' => 'Something New',
            'doctrine_matiere_premiere[active]' => 'Something New',
            'doctrine_matiere_premiere[creationAt]' => 'Something New',
            'doctrine_matiere_premiere[modificationAt]' => 'Something New',
        ]);

        self::assertResponseRedirects('/doctrine/matiere/premiere/');

        $fixture = $this->doctrineMatierePremiereRepository->findAll();

        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getFormule());
        self::assertSame('Something New', $fixture[0]->getPmAvantCuisson());
        self::assertSame('Something New', $fixture[0]->getOrdre());
        self::assertSame('Something New', $fixture[0]->getActive());
        self::assertSame('Something New', $fixture[0]->getCreationAt());
        self::assertSame('Something New', $fixture[0]->getModificationAt());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new DoctrineMatierePremiere();
        $fixture->setNom('Value');
        $fixture->setFormule('Value');
        $fixture->setPmAvantCuisson('Value');
        $fixture->setOrdre('Value');
        $fixture->setActive('Value');
        $fixture->setCreationAt('Value');
        $fixture->setModificationAt('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/doctrine/matiere/premiere/');
        self::assertSame(0, $this->doctrineMatierePremiereRepository->count([]));
    }
}
