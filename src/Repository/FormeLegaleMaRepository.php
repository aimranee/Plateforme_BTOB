<?php

namespace App\Repository;

use App\Entity\FormeLegaleMa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormeLegaleMa|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormeLegaleMa|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormeLegaleMa[]    findAll()
 * @method FormeLegaleMa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormeLegaleMaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormeLegaleMa::class);
    }

    // /**
    //  * @return FormeLegaleMa[] Returns an array of FormeLegaleMa objects
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
    public function findOneBySomeField($value): ?FormeLegaleMa
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
