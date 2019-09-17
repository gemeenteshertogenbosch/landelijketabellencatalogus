<?php

namespace App\Repository;

use App\Entity\Tabel48;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tabel48|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tabel48|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tabel48[]    findAll()
 * @method Tabel48[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Tabel48Repository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
    	parent::__construct($registry, Tabel48::class);
    }

    // /**
    //  * @return Tabel32[] Returns an array of Tabel32 objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tabel32
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
