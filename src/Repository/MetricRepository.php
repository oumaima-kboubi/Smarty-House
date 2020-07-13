<?php

namespace App\Repository;

use App\Entity\Metric;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Metric|null find($id, $lockMode = null, $lockVersion = null)
 * @method Metric|null findOneBy(array $criteria, array $orderBy = null)
 * @method Metric[]    findAll()
 * @method Metric[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetricRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Metric::class);
    }

    public function findForWeek($id, $today, $week)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select m.value, m.date, m.triggeredBy
            from App\Entity\Metric m, App\Entity\Device d, App\Entity\Attribut a
            where d.id = a.deviceId and m.attributId = a.id and d.id = :val and m.date > :week and m.date < :today and deleted <> 1
            order by m.date DESC")
            ->setParameter('val', $id)
            ->setParameter('week', $week)
            ->setParameter('today', $today)
            ->getResult()
            ;
    }

    public function findForMonth($id, $week, $month)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select m.value, m.date, m.triggeredBy
            from App\Entity\Metric m, App\Entity\Device d, App\Entity\Attribut a
            where d.id = a.deviceId and m.attributId = a.id and d.id = :val and m.date > :month and m.date < :week and deleted <> 1
            order by m.date DESC")
            ->setParameter('val', $id)
            ->setParameter('week', $week)
            ->setParameter('month', $month)
            ->getResult()
            ;
    }

    public function findTheRest($id, $month)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select m.value, m.date, m.triggeredBy
            from App\Entity\Metric m, App\Entity\Device d, App\Entity\Attribut a
            where d.id = a.deviceId and m.attributId = a.id and d.id = :val and m.date < :month and m.deleted <> 1
            order by m.date DESC")
            ->setParameter('val', $id)
            ->setParameter('month', $month)
            ->getResult()
            ;
    }

    public function findByDatou($id, $datou, $today)
    {
        $em = $this->getEntityManager();
        return $this->createQuery("
            select m.date, m.value
            from App\Entity\Metric m, App\Entity\Attribut a
            Where('m.attributId = a.id and a.deviceId = :val and h.date > :datou and h.date <= :today 
            order by m.date DESC")
            ->setParameter('val', $id)
            ->setParameter('today', $today)
            ->setParameter('datou', $datou)
            ->getResult()
            ;
    }
    public function findDevice($value)
    {
        $em = $this->getEntityManager() ;
        return $em->createQuery(
            " select a.name, COUNT(IDENTITY(m.attributId)) as value
                from App\Entity\Metric h, App\Entity\Attribut a
                 where a.id=m.attributId and h.date >= :val 
                group By m.attributId"
        )
            ->setParameter('val', $value)
            ->getResult()
            ;
    }
    public function findLine($value)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            "select m.date, m.value
            from App\Entity\Metric m, App\Entity\Attribut a 
            Where a.deviceId = :val and m.deviceId=a.id
            order by m.date ASC")
            ->setParameter('val', $value)
            ->getResult()
            ;
    }

    // /**
    //  * @return Metric[] Returns an array of Metric objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Metric
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
