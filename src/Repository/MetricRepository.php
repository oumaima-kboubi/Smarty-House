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
            " select m.id, m.value, m.date, m.triggeredBy
            from App\Entity\Metric m, App\Entity\Device d, App\Entity\Attribut a
            where d.id = a.device and m.attribut = a.id and d.id = :val and m.date > :week and m.date < :today and m.deleted = 0
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
            " select m.id, m.value, m.date, m.triggeredBy
            from App\Entity\Metric m, App\Entity\Device d, App\Entity\Attribut a
            where d.id = a.device and m.attribut = a.id and d.id = :val and m.date > :month and m.date < :week and m.deleted = 0
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
            " select m.id, m.value, m.date, m.triggeredBy
            from App\Entity\Metric m, App\Entity\Device d, App\Entity\Attribut a
            where d.id = a.device and m.attribut = a.id and d.id = :val and m.date < :month and m.deleted = 0
            order by m.date DESC")
            ->setParameter('val', $id)
            ->setParameter('month', $month)
            ->getResult()
            ;
    }

    public function findByDatou($id, $datou, $today)
    {
        $em = $this->getEntityManager();
        return $em->createQuery("
            select m.date, m.value
            from App\Entity\Metric m, App\Entity\Attribut a
            Where m.attribut = a.id and a.device = :val and m.date >= :datou and m.date <= :today 
            order by m.date DESC")
            ->setParameter('val', $id)
            ->setParameter('today', $today)
            ->setParameter('datou', $datou)
            ->getResult()
            ;
    }
    public function findMy($id)
    {
        $em = $this->getEntityManager();
        return $em->createQuery("
            select m.id, m.date, m.value, m.triggeredBy
            from App\Entity\Metric m, App\Entity\Attribut a
            Where (m.attribut = a.id)and (a.device = :val) and (m.deleted =0)
            order by m.date DESC")
            ->setParameter('val', $id)
            ->getResult()
            ;
    }
    public function findDevice($id, $value)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            " select DISTINCT(d.name) as name, COUNT(IDENTITY(m.attribut)) as value
                from App\Entity\Metric m, App\Entity\Attribut a,  App\Entity\Device d, App\Entity\Room r, App\Entity\SmartHouse s
                 where a.id = m.attribut and m.date >= :val and a.device=d.id and d.roomID=r.id and r.houseID=s.id and s.id=:id 
                group By m.attribut"
        )
            ->setParameter('val', $value)
            ->setParameter('id', $id)
            ->getResult()
            ;
    }
    public function findLine($value)
    {
        $em = $this->getEntityManager();
        return $em->createQuery(
            "select m.date, m.value
            from App\Entity\Metric m, App\Entity\Attribut a,  App\Entity\Device d
            Where d.id = :val and a.device = d.id and a.id = m.attribut
            order by m.date DESC")
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
