<?php

namespace App\Repository;

use App\Entity\BaseEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BaseEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaseEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaseEmail[]    findAll()
 * @method BaseEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaseEmailRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BaseEmail::class);
    }

    // /**
    //  * @return BaseEmail[] Returns an array of BaseEmail objects
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
    public function findOneBySomeField($value): ?BaseEmail
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
