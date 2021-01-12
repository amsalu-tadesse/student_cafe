<?php

namespace App\Repository;

use App\Entity\IllegalChekinAttempt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IllegalChekinAttempt|null find($id, $lockMode = null, $lockVersion = null)
 * @method IllegalChekinAttempt|null findOneBy(array $criteria, array $orderBy = null)
 * @method IllegalChekinAttempt[]    findAll()
 * @method IllegalChekinAttempt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IllegalChekinAttemptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IllegalChekinAttempt::class);
    }

    // /**
    //  * @return IllegalChekinAttempt[] Returns an array of IllegalChekinAttempt objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IllegalChekinAttempt
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
