<?php

namespace App\Repository;

use App\Entity\DeletedCheckin;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DeletedCheckin|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeletedCheckin|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeletedCheckin[]    findAll()
 * @method DeletedCheckin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeletedCheckinRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeletedCheckin::class);
    }

    // /**
    //  * @return DeletedCheckin[] Returns an array of DeletedCheckin objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeletedCheckin
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
