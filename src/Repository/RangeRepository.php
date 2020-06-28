<?php

namespace App\Repository;

use App\Entity\Range;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Range|null find($id, $lockMode = null, $lockVersion = null)
 * @method Range|null findOneBy(array $criteria, array $orderBy = null)
 * @method Range[]    findAll()
 * @method Range[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RangeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Range::class);
    }

    // /**
    //  * @return Range[] Returns an array of Range objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Range
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
