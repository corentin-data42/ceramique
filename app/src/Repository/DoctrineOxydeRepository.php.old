<?php

namespace App\Repository;

use Application\Repository\DTO\OxydeDTO;
use App\DTO\Mapper\OxydeDTOMapper;

use App\Entity\DoctrineOxyde;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Application\Repository\Port\database\OxydeDatabasePort;
/**
 * @extends ServiceEntityRepository<DoctrineOxyde>
 */
class DoctrineOxydeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DoctrineOxyde::class);
    }

    public function findOneById(int $id){

    }
    public function findAllActif(): array{
        //$entityManager = $this->getEntityManager();
        return  $this->findBy(
            ['actif' => true]
        );
    }
    public function findAllActifOrderByType():array{
        $qb = $this->createQueryBuilder('p')
            ->orderBy('p.type', 'ASC');
        $query = $qb->getQuery();
        return $query->execute();
    }

    public function save(OxydeDTO $oxydeDto, bool $flush = false){
        $oxyde = OxydeDTOMapper::fromDTO($oxydeDto);
    }
    //    /**
    //     * @return DoctrineOxyde[] Returns an array of DoctrineOxyde objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('d.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?DoctrineOxyde
    //    {
    //        return $this->createQueryBuilder('d')
    //            ->andWhere('d.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
