<?php

namespace App\Repository;

use App\Entity\Numeric;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Numeric|null find($id, $lockMode = null, $lockVersion = null)
 * @method Numeric|null findOneBy(array $criteria, array $orderBy = null)
 * @method Numeric[]    findAll()
 * @method Numeric[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NumericRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Numeric::class);
    }

    // /**
    //  * @return Numeric[] Returns an array of Numeric objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Numeric
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
