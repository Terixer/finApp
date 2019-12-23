<?php

namespace App\Repository;

use App\Entity\PlannedExpense;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PlannedExpense|null find($id, $lockMode = null, $lockVersion = null)
 * @method PlannedExpense|null findOneBy(array $criteria, array $orderBy = null)
 * @method PlannedExpense[]    findAll()
 * @method PlannedExpense[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PlannedExpenseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PlannedExpense::class);
    }

    // /**
    //  * @return PlannedExpense[] Returns an array of PlannedExpense objects
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
    public function findOneBySomeField($value): ?PlannedExpense
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
