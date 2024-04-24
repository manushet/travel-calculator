<?php

namespace App\Repository;

use App\Entity\EarlyBookingRangeRule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EarlyBookingRangeRule>
 *
 * @method EarlyBookingRangeRule|null find($id, $lockMode = null, $lockVersion = null)
 * @method EarlyBookingRangeRule|null findOneBy(array $criteria, array $orderBy = null)
 * @method EarlyBookingRangeRule[]    findAll()
 * @method EarlyBookingRangeRule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EarlyBookingRangeRuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EarlyBookingRangeRule::class);
    }


    //    /**
    //     * @return EarlyBookingRangeRule[] Returns an array of EarlyBookingRangeRule objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EarlyBookingRangeRule
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
