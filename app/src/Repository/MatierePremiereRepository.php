<?php

namespace App\Repository;

use App\Entity\MatierePremiere;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\ORM\Query\Expr\OrderBy;
/**
 * @extends ServiceEntityRepository<MatierePremiere>
 */
class MatierePremiereRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MatierePremiere::class);
    }
    
    public function findWithOxydeIn(array $arrId,?bool $activeOnly=true):array{

        $em = $this->getEntityManager();
        $expr = $em->getExpressionBuilder();

        $qb = $this->createQueryBuilder('p')
                    //->addSelect("GROUP_CONCAT(DISTINCT q.quantite, o.formule SEPARATOR ', ') AS formule") 
                    ->innerJoin('p.quantite', 'q', Join::WITH, 'q.matierePremiere = p.id')
                    ->innerJoin('q.oxyde', 'o', Join::WITH, 'q.oxyde = o.id')
                    ->where("o.id IN(:Ids)")
                    ->setParameter('Ids', array_values($arrId))
                    ->andWhere('p.flagEtat = '.$activeOnly )
                    ->andWhere('o.flagEtat = '.$activeOnly )
                    ->andWhere(
                            $expr->notIn('p.id',
                                $em->createQueryBuilder()
                                    ->select('p2.id')
                                    ->from(MatierePremiere::class,'p2')
                                    ->innerJoin('p2.quantite', 'q2', Join::WITH, 'q2.matierePremiere = p2.id')
                                    ->innerJoin('q2.oxyde', 'o2', Join::WITH, 'q2.oxyde = o2.id')
                                    ->where("o2.id NOT IN(:Ids)")
                                    ->setParameter('Ids', array_values($arrId))
                                    ->andWhere('p2.flagEtat = '.$activeOnly )
                                    ->andWhere('o2.flagEtat = '.$activeOnly )
                                    ->getDQL()
                            )
                    )
                    ->groupBy('p.id')
                    ->orderBy('p.ordre','ASC');
                    ;
        $query = $qb->getQuery();
        return $query->execute();
    }
    //    /**
    //     * @return MatierePremiere[] Returns an array of MatierePremiere objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MatierePremiere
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
