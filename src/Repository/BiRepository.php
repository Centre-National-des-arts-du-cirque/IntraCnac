<?php

namespace App\Repository;

use App\Entity\Bi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Bi>
 *
 * @method Bi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Bi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Bi[]    findAll()
 * @method Bi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Bi::class);
    }

//    /**
//     * @return Bi[] Returns an array of Bi objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('b.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Bi
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
