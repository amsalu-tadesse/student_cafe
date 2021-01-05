<?php

namespace App\Repository;

use App\Entity\StaffCheckin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method StaffCheckin|null find($id, $lockMode = null, $lockVersion = null)
 * @method StaffCheckin|null findOneBy(array $criteria, array $orderBy = null)
 * @method StaffCheckin[]    findAll()
 * @method StaffCheckin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StaffCheckinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StaffCheckin::class);
    }

    // /**
    //  * @return StaffCheckin[] Returns an array of StaffCheckin objects
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
    public function findOneBySomeField($value): ?StaffCheckin
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
