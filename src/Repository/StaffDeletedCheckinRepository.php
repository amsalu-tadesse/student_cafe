<?php

namespace App\Repository;

use App\Entity\StaffDeletedCheckin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StaffDeletedCheckin|null find($id, $lockMode = null, $lockVersion = null)
 * @method StaffDeletedCheckin|null findOneBy(array $criteria, array $orderBy = null)
 * @method StaffDeletedCheckin[]    findAll()
 * @method StaffDeletedCheckin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StaffDeletedCheckinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StaffDeletedCheckin::class);
    }

    // /**
    //  * @return StaffDeletedCheckin[] Returns an array of StaffDeletedCheckin objects
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
    public function findOneBySomeField($value): ?StaffDeletedCheckin
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
