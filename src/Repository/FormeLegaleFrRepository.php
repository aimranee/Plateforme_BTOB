<?php

namespace App\Repository;

use App\Entity\FormeLegaleFr;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FormeLegaleFr|null find($id, $lockMode = null, $lockVersion = null)
 * @method FormeLegaleFr|null findOneBy(array $criteria, array $orderBy = null)
 * @method FormeLegaleFr[]    findAll()
 * @method FormeLegaleFr[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FormeLegaleFrRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FormeLegaleFr::class);
    }

    // /**
    //  * @return FormeLegaleFr[] Returns an array of FormeLegaleFr objects
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
    public function findOneBySomeField($value): ?FormeLegaleFr
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
