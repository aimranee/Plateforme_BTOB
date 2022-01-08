<?php

namespace App\Repository;

use App\Entity\EtatSynthese;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EtatSynthese|null find($id, $lockMode = null, $lockVersion = null)
 * @method EtatSynthese|null findOneBy(array $criteria, array $orderBy = null)
 * @method EtatSynthese[]    findAll()
 * @method EtatSynthese[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtatSyntheseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EtatSynthese::class);
    }

    // /**
    //  * @return EtatSynthese[] Returns an array of EtatSynthese objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EtatSynthese
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
