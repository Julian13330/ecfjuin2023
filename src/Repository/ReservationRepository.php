<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservation>
 *
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function save(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Reservation $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
   * @return Reservation[] Returns an array of Reservation objects
    */
    public function findByExampleField($value): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findOneBySomeField($value): ?Reservation
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // Nombre d'invités le midi
    public function countNbrCouvertDateMidi(string $time, string $hour ): int
    {
        $qb = $this->createQueryBuilder('r') // ma table réservation
            ->select('SUM(r.nbrGuest)') // Le total des invités par réservation
            ->where('r.time = :time') // par date
            ->andWhere('r.hour < :hour') // par créneau horaire
            ->setParameter('time', $time)
            ->setParameter('hour', $hour);

        return (int) $qb->getQuery()->getSingleScalarResult(); // Obtenir un seul résultat
    }

    // Nombre d'invités le soir
    public function countNbrCouvertDateSoir(string $time, string $hour): int
    {
        $qb = $this->createQueryBuilder('r')
            ->select('SUM(r.nbrGuest)')
            ->where('r.time = :time')
            ->andWhere('r.hour > :hour')
            ->setParameter('time', $time)
            ->setParameter('hour', $hour);

        return (int) $qb->getQuery()->getSingleScalarResult(); // Obtenir un seul résultat
    }
}
