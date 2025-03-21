<?php

namespace App\Repository;

use App\Entity\Fournisseur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Fournisseur>
 */
class FournisseurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fournisseur::class);
    }

    // public function findAllActif(): array{
    //     //$entityManager = $this->getEntityManager();
    //     return $this->findBy(
    //         ['flagEtat' => true]
    //     );

    // }
    /**
    * @return Fournisseur Returns an array or QueryBuilder of Fournisseur objects
    */
    public function findAllActif(?bool $returnQueryBuilder=false): mixed
    {
        $queryBuilder = $this->createQueryBuilder('f')
        ->andWhere('f.flagEtat = true')
        ->orderBy('f.id', 'ASC');
        if($returnQueryBuilder){
            return $queryBuilder;
        }
        return ($queryBuilder)->getQuery()
        ->getResult();
    }


    //    /**
    //     * @return Fournisseur[] Returns an array of Fournisseur objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Fournisseur
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
