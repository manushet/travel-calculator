<?php

namespace App\Repository;

use App\Entity\AgeDiscountRule;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AgeDiscountRule>
 *
 * @method AgeDiscountRule|null find($id, $lockMode = null, $lockVersion = null)
 * @method AgeDiscountRule|null findOneBy(array $criteria, array $orderBy = null)
 * @method AgeDiscountRule[]    findAll()
 * @method AgeDiscountRule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AgeDiscountRuleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AgeDiscountRule::class);
    }

    //    /**
    //     * @return AgeDiscountRule[] Returns an array of AgeDiscountRule objects
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

    //    public function findOneBySomeField($value): ?AgeDiscountRule
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
