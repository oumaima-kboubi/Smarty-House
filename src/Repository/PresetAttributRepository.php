<?php

namespace App\Repository;

use App\Entity\PresetAttribut;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PresetAttribut|null find($id, $lockMode = null, $lockVersion = null)
 * @method PresetAttribut|null findOneBy(array $criteria, array $orderBy = null)
 * @method PresetAttribut[]    findAll()
 * @method PresetAttribut[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PresetAttributRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PresetAttribut::class);
    }

    // /**
    //  * @return PresetAttribut[] Returns an array of PresetAttribut objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PresetAttribut
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
