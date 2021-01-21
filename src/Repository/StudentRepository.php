<?php

namespace App\Repository;

use App\Entity\Student;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Student|null find($id, $lockMode = null, $lockVersion = null)
 * @method Student|null findOneBy(array $criteria, array $orderBy = null)
 * @method Student[]    findAll()
 * @method Student[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Student::class);
    }

    public function findByFilters($f)
    {
        $res= null; 
        //    dd($f);
        $res = $this->createQueryBuilder('s');
        // $res = $res->join('s.profile','p');
     if($f)
     {
        if($f['Enrollment']!="")
        {
            
            $res = $res->andWhere('s.enrollment = :ptype')
            ->setParameter('ptype', $f['Enrollment']);
            
        }
        if($f['Department']!="")
        {
            $res = $res->andWhere('s.department = :dept')
            ->setParameter('dept', $f['Department']);
        }
        if($f['ProgramLevel']!="")
        {
            $res = $res->andWhere('s.programLevel = :plevel')
            ->setParameter('plevel', $f['ProgramLevel']);
        }

     }
        
     $res = $res
     ->orderBy('s.id','desc')
     ->getQuery()
 ;
 return $res;     
    }
}
