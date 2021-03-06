<?php

namespace App\Repository;

use App\Entity\LangCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method LangCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method LangCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method LangCode[]    findAll()
 * @method LangCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LangCodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LangCode::class);
    }

    // /**
    //  * @return LangCode[] Returns an array of LangCode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?LangCode
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
