<?php

namespace App\Repository;

use App\Entity\Attribut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Attribut|null find($id, $lockMode = null, $lockVersion = null)
 * @method Attribut|null findOneBy(array $criteria, array $orderBy = null)
 * @method Attribut[]    findAll()
 * @method Attribut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AttributRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attribut::class);
    }

    // /**
    //  * @return Attribut[] Returns an array of Attribut objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Attribut
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
