<?php

namespace App\Repository;

use App\Entity\Ticket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ticket>
 *
 * @method Ticket|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ticket|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ticket[]    findAll()
 * @method Ticket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ticket::class);
    }
    public function countByDate(\DateTime $start , \DateTime $end): int
    {   
        
        $qb = $this->createQueryBuilder('ticket')
        ->select('count(ticket.id)')
        ->where('ticket.date BETWEEN :start and :end' )
        ->setParameter('start', $start)
        ->setParameter('end', $end);

        return $qb->getQuery()->getSingleScalarResult();
    }

    public function CountByServiceAndDate(string $service ,\DateTime $start , \DateTime $end): int
    {   
        
        $qb = $this->createQueryBuilder('ticket')
        ->select('count(ticket.id)')
        ->leftJoin('ticket.createBy', 'user')
        ->where('ticket.date BETWEEN :start and :end' )
        ->andWhere('user.service = :service')
        ->setParameter('service', $service);
        
        $qb->setParameter('start', $start)
        ->setParameter('end', $end);
    

        return $qb->getQuery()->getSingleScalarResult();
    }

    
    public function countGroupByDay(\DateTime $start,\DateTime $end):array
    {   

        $qb = $this->createQueryBuilder('ticket')
        ->select('count(ticket.id)')
        ->where('ticket.date BETWEEN :start and :end' )
            ->groupBy('ticket.date')
            ->orderBy('ticket.date', 'ASC')
            ->setParameter('start', $start)
            ->setParameter('end', $end);
        return $qb->getQuery()->getResult();

    }

    public function countSolvedTicket(\DateTime $start,\DateTime $end):array
    {   

        $qb = $this->createQueryBuilder('ticket')
        ->select('count(ticket.id)')
        ->where('ticket.date BETWEEN :start and :end' )
        ->andWhere('ticket.solved = true')
            ->setParameter('start', $start)
            ->setParameter('end', $end);
        return $qb->getQuery()->getResult();

    }

    public function countUnsolvedTicket(\DateTime $start,\DateTime $end):array
    {   

        $qb = $this->createQueryBuilder('ticket')
        ->select('count(ticket.id)')
        ->where('ticket.date BETWEEN :start and :end' )
        ->andWhere('ticket.solved = false')
            ->setParameter('start', $start)
            ->setParameter('end', $end);
        return $qb->getQuery()->getResult();

    }

//    /**
//     * @return Ticket[] Returns an array of Ticket objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ticket
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
