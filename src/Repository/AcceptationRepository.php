<?php

namespace App\Repository;

use App\Entity\Acceptation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Acceptation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Acceptation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Acceptation[]    findAll()
 * @method Acceptation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AcceptationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Acceptation::class);
    }

    // /**
    //  * @return Acceptation[] Returns an array of Acceptation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Acceptation
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
