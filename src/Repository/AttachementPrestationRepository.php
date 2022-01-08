<?php

namespace App\Repository;

use App\Entity\AttachementPrestation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AttachementPrestation|null find($id, $lockMode = null, $lockVersion = null)
 * @method AttachementPrestation|null findOneBy(array $criteria, array $orderBy = null)
 * @method AttachementPrestation[]    findAll()
 * @method AttachementPrestation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttachementPrestationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AttachementPrestation::class);
    }

    // /**
    //  * @return AttachementPrestation[] Returns an array of AttachementPrestation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AttachementPrestation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
