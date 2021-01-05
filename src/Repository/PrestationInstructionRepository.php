<?php

namespace App\Repository;

use App\Entity\PrestationInstruction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PrestationInstruction|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrestationInstruction|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrestationInstruction[]    findAll()
 * @method PrestationInstruction[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrestationInstructionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrestationInstruction::class);
    }

    // /**
    //  * @return PrestationInstruction[] Returns an array of PrestationInstruction objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PrestationInstruction
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
