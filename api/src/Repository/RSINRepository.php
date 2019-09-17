<?php

namespace App\Repository;

use App\Entity\RSIN;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method RSIN|null find($id, $lockMode = null, $lockVersion = null)
 * @method RSIN|null findOneBy(array $criteria, array $orderBy = null)
 * @method RSIN[]    findAll()
 * @method RSIN[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RSINRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RSIN::class);
    }

    // /**
    //  * @return RSIN[] Returns an array of RSIN objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RSIN
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
