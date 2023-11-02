<?php

namespace App\Repository;

use App\Entity\ItTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ItTicket>
 *
 * @method ItTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method ItTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method ItTicket[]    findAll()
 * @method ItTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ItTicketRepository extends TicketRepository 
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItTicket::class);
    }
    
//    /**
//     * @return ItTicket[] Returns an array of ItTicket objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ItTicket
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
