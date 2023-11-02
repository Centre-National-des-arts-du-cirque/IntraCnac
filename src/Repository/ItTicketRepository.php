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
class ItTicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ItTicket::class);
    }

    public function countByDate(\DateTime $start, \DateTime $end): int
    {

        $qb = $this->createQueryBuilder('ticket')
            ->select('count(ticket.id)')
            ->where('ticket.date BETWEEN :start and :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end);

        return $qb->getQuery()->getSingleScalarResult();
    }
    public function countByTypeAndDate(string $type, \DateTime $start, \DateTime $end): int
    {

        $qb = $this->createQueryBuilder('ticket')
            ->select('count(ticket.id)')
            ->join('ticket.ErrorType', 'ErrorType')
            ->where('ticket.date BETWEEN :start and :end')
            ->andWhere('ErrorType.lib = :type')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->setParameter('type', $type);

        return $qb->getQuery()->getSingleScalarResult();
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
