<?php

namespace App\Repository;

use App\Entity\ErrorType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ErrorType>
 *
 * @method ErrorType|null find($id, $lockMode = null, $lockVersion = null)
 * @method ErrorType|null findOneBy(array $criteria, array $orderBy = null)
 * @method ErrorType[]    findAll()
 * @method ErrorType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ErrorTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ErrorType::class);
    }

//    /**
//     * @return ErrorType[] Returns an array of ErrorType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ErrorType
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
