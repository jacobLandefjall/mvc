<?php

namespace App\Repository;

use App\Entity\Projekt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Projekt>
 */
class ProjektRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projekt::class);
    }

    public function save(Projekt $projekt): Projekt
    {
        $this->_em->persist($projekt);
        $this->_em->flush();
    }

    public function findByGoal(string $goal): ?Projekt
    {
        return $this->findBy(['goal' => $goal]);
    }

//    /**
//     * @return Projekt[] Returns an array of Projekt objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Projekt
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
