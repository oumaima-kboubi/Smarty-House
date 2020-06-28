<?php

namespace App\Repository;

use App\Entity\Toggle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Toggle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Toggle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Toggle[]    findAll()
 * @method Toggle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ToggleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Toggle::class);
    }

    // /**
    //  * @return Toggle[] Returns an array of Toggle objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Toggle
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
