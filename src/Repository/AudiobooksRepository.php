<?php

namespace App\Repository;

use App\Entity\Audiobooks;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Audiobooks>
 */
class AudiobooksRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Audiobooks::class);
    }

    public function searchByTitle(string $searchTerm)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.title LIKE :searchTerm') // Filter by title
            ->setParameter('searchTerm', '%' . $searchTerm . '%') // Use wildcard for partial matches
            ->getQuery()
            ->getResult(); // Execute the query and return the result
    }


//    /**
//     * @return Audiobooks[] Returns an array of Audiobooks objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Audiobooks
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
