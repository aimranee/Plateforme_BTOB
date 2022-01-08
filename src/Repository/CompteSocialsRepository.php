<?php

namespace App\Repository;

use App\Entity\CompteSocials;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompteSocials|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompteSocials|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompteSocials[]    findAll()
 * @method CompteSocials[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompteSocialsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompteSocials::class);
    }

    // /**
    //  * @return CompteSocials[] Returns an array of CompteSocials objects
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
    public function findOneBySomeField($value): ?CompteSocials
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
