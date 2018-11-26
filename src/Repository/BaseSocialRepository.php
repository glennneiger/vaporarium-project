<?php

namespace App\Repository;

use App\Entity\BaseSocial;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BaseSocial|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaseSocial|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaseSocial[]    findAll()
 * @method BaseSocial[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaseSocialRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BaseSocial::class);
    }

    // /**
    //  * @return BaseSocial[] Returns an array of BaseSocial objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BaseSocial
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
