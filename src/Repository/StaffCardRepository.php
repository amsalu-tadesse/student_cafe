<?php

namespace App\Repository;

use App\Entity\StaffCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StaffCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method StaffCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method StaffCard[]    findAll()
 * @method StaffCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StaffCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StaffCard::class);
    }

    // /**
    //  * @return StaffCard[] Returns an array of StaffCard objects
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
    public function findOneBySomeField($value): ?StaffCard
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
