<?php

namespace App\Repository;

use App\Entity\GroupProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method GroupProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method GroupProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method GroupProduct[]    findAll()
 * @method GroupProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GroupProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, GroupProduct::class);
    }

    // /**
    //  * @return GroupProduct[] Returns an array of GroupProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GroupProduct
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
