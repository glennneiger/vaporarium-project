<?php

namespace App\Repository;

use App\Entity\CharacteristicItemForCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CharacteristicItemForCategory|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacteristicItemForCategory|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacteristicItemForCategory[]    findAll()
 * @method CharacteristicItemForCategory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacteristicItemForCategoryRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CharacteristicItemForCategory::class);
    }

    // /**
    //  * @return CharacteristicItemForCategory[] Returns an array of CharacteristicItemForCategory objects
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
    public function findOneBySomeField($value): ?CharacteristicItemForCategory
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
