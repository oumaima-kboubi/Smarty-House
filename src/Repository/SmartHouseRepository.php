<?php

namespace App\Repository;

use App\Entity\SmartHouse;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SmartHouse|null find($id, $lockMode = null, $lockVersion = null)
 * @method SmartHouse|null findOneBy(array $criteria, array $orderBy = null)
 * @method SmartHouse[]    findAll()
 * @method SmartHouse[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SmartHouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SmartHouse::class);
    }

    // /**
    //  * @return SmartHouse[] Returns an array of SmartHouse objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SmartHouse
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
