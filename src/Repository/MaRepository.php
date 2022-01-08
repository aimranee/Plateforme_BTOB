<?php

namespace App\Repository;

use App\Entity\Ma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ma|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ma|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ma[]    findAll()
 * @method Ma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ma::class);
    }

    // /**
    //  * @return Ma[] Returns an array of Ma objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ma
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
