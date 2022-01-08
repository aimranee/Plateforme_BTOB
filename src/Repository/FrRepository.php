<?php

namespace App\Repository;

use App\Entity\Fr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Fr|null find($id, $lockMode = null, $lockVersion = null)
 * @method Fr|null findOneBy(array $criteria, array $orderBy = null)
 * @method Fr[]    findAll()
 * @method Fr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Fr::class);
    }

    // /**
    //  * @return Fr[] Returns an array of Fr objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Fr
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
