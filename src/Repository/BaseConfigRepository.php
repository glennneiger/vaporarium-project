<?php

namespace App\Repository;

use App\Entity\BaseConfig;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BaseConfig|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaseConfig|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaseConfig[]    findAll()
 * @method BaseConfig[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaseConfigRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BaseConfig::class);
    }

    // /**
    //  * @return BaseConfig[] Returns an array of BaseConfig objects
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
    public function findOneBySomeField($value): ?BaseConfig
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
