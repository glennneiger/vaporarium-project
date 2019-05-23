<?php

namespace App\Repository;

use App\Entity\CharacteristicItemForProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CharacteristicItemForProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacteristicItemForProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacteristicItemForProduct[]    findAll()
 * @method CharacteristicItemForProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacteristicItemForProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CharacteristicItemForProduct::class);
    }

    // /**
    //  * @return CharacteristicItemForProduct[] Returns an array of CharacteristicItemForProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CharacteristicItemForProduct
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
