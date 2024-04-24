<?php

namespace App\Repository;

use App\Entity\EarlyBookingDiscountRule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EarlyBookingDiscountRule>
 *
 * @method EarlyBookingDiscountRule|null find($id, $lockMode = null, $lockVersion = null)
 * @method EarlyBookingDiscountRule|null findOneBy(array $criteria, array $orderBy = null)
 * @method EarlyBookingDiscountRule[]    findAll()
 * @method EarlyBookingDiscountRule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EarlyBookingDiscountRuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EarlyBookingDiscountRule::class);
    }

    //    /**
    //     * @return EarlyBookingDiscountRule[] Returns an array of EarlyBookingDiscountRule objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?EarlyBookingDiscountRule
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
