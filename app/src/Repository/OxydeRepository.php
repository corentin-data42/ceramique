<?php

namespace App\Repository;

use Application\Repository\DTO\OxydeDTO;
use App\DTO\Mapper\OxydeDTOMapper;

use App\Entity\Oxyde;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Oxyde>
 */
class OxydeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Oxyde::class);
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
}
