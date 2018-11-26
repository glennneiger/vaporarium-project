<?php

namespace App\Repository;

use App\Entity\BasePartners;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BasePartners|null find($id, $lockMode = null, $lockVersion = null)
 * @method BasePartners|null findOneBy(array $criteria, array $orderBy = null)
 * @method BasePartners[]    findAll()
 * @method BasePartners[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasePartnersRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BasePartners::class);
    }

    // /**
    //  * @return BasePartners[] Returns an array of BasePartners objects
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
    public function findOneBySomeField($value): ?BasePartners
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
