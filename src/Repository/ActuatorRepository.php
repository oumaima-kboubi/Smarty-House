<?php

namespace App\Repository;

use App\Entity\Actuator;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Actuator|null find($id, $lockMode = null, $lockVersion = null)
 * @method Actuator|null findOneBy(array $criteria, array $orderBy = null)
 * @method Actuator[]    findAll()
 * @method Actuator[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActuatorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Actuator::class);
    }

    // /**
    //  * @return Actuator[] Returns an array of Actuator objects
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
    public function findOneBySomeField($value): ?Actuator
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
