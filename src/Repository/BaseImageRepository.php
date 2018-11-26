<?php

namespace App\Repository;

use App\Entity\BaseImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BaseImage|null find($id, $lockMode = null, $lockVersion = null)
 * @method BaseImage|null findOneBy(array $criteria, array $orderBy = null)
 * @method BaseImage[]    findAll()
 * @method BaseImage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BaseImageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BaseImage::class);
    }

    // /**
    //  * @return BaseImage[] Returns an array of BaseImage objects
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
    public function findOneBySomeField($value): ?BaseImage
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
