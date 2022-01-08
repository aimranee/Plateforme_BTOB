<?php

namespace App\Repository;

use App\Entity\Comeentaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Comeentaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comeentaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comeentaire[]    findAll()
 * @method Comeentaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComeentaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Comeentaire::class);
    }

    // /**
    //  * @return Comeentaire[] Returns an array of Comeentaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Comeentaire
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
