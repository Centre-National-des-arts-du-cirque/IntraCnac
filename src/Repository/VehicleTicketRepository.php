<?php

namespace App\Repository;

use App\Entity\VehicleTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VehicleTicket>
 *
 * @method VehicleTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method VehicleTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method VehicleTicket[]    findAll()
 * @method VehicleTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VehicleTicketRepository extends TicketRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VehicleTicket::class);
    }
    

//    /**
//     * @return VehicleTicket[] Returns an array of VehicleTicket objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VehicleTicket
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
