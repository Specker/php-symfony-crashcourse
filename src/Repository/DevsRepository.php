<?php

namespace App\Repository;

use App\Entity\Devs;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Devs|null find($id, $lockMode = null, $lockVersion = null)
 * @method Devs|null findOneBy(array $criteria, array $orderBy = null)
 * @method Devs[]    findAll()
 * @method Devs[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DevsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Devs::class);
    }

    // /**
    //  * @return Devs[] Returns an array of Devs objects
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
    public function findOneBySomeField($value): ?Devs
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
