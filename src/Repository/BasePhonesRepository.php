<?php

namespace App\Repository;

use App\Entity\BasePhones;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BasePhones|null find($id, $lockMode = null, $lockVersion = null)
 * @method BasePhones|null findOneBy(array $criteria, array $orderBy = null)
 * @method BasePhones[]    findAll()
 * @method BasePhones[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BasePhonesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BasePhones::class);
    }

    // /**
    //  * @return BasePhones[] Returns an array of BasePhones objects
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
    public function findOneBySomeField($value): ?BasePhones
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
