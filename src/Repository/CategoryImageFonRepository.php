<?php

namespace App\Repository;

use App\Entity\CategoryImageFon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CategoryImageFon|null find($id, $lockMode = null, $lockVersion = null)
 * @method CategoryImageFon|null findOneBy(array $criteria, array $orderBy = null)
 * @method CategoryImageFon[]    findAll()
 * @method CategoryImageFon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryImageFonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CategoryImageFon::class);
    }

    // /**
    //  * @return CategoryImageFon[] Returns an array of CategoryImageFon objects
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
    public function findOneBySomeField($value): ?CategoryImageFon
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
