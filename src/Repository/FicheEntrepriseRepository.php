<?php

namespace App\Repository;

use App\Entity\FicheEntreprise;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FicheEntreprise|null find($id, $lockMode = null, $lockVersion = null)
 * @method FicheEntreprise|null findOneBy(array $criteria, array $orderBy = null)
 * @method FicheEntreprise[]    findAll()
 * @method FicheEntreprise[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FicheEntrepriseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FicheEntreprise::class);
    }

    // /**
    //  * @return FicheEntreprise[] Returns an array of FicheEntreprise objects
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
    public function findOneBySomeField($value): ?FicheEntreprise
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
