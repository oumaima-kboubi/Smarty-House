<?php

namespace App\Repository;

use App\Entity\Sensor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sensor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sensor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sensor[]    findAll()
 * @method Sensor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SensorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sensor::class);
    }
    public function findSensor($value)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            "SELECT r.name, c.apportEnergitique, c.seuilDeclenchement, c.typeDetection, c.typeSortie, c.createdAt
    FROM App\Entity\Device d, App\Entity\Room r, App\Entity\Attribut a, App\Entity\Sensor c, App\Entity\SmartHouse s
    WHERE (s.id= :value) and (s.id =r.houseID) and (r.id=d.roomID) and (d.id=a.deviceId) and (a.actuatorId=c.id)")
            ->setParameter('value', $value)
            ->getResult()
            ;
    }

    // /**
    //  * @return Sensor[] Returns an array of Sensor objects
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
    public function findOneBySomeField($value): ?Sensor
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
