<?php

namespace App\Repository;

use App\Entity\BuildingTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<BuildingTicket>
 *
 * @method BuildingTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method BuildingTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method BuildingTicket[]    findAll()
 * @method BuildingTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuildingTicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BuildingTicket::class);
    }

//    /**
//     * @return BuildingTicket[] Returns an array of BuildingTicket objects
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

//    public function findOneBySomeField($value): ?BuildingTicket
//    {
//        return $this->createQueryBuilder('b')
//            ->andWhere('b.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
