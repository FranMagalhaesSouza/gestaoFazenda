<?php

namespace App\Repository;

use App\Entity\ProducaoLeite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProducaoLeite>
 *
 * @method ProducaoLeite|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProducaoLeite|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProducaoLeite[]    findAll()
 * @method ProducaoLeite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProducaoLeiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProducaoLeite::class);
    }

    public function save(ProducaoLeite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ProducaoLeite $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ProducaoLeite[] Returns an array of ProducaoLeite objects
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

//    public function findOneBySomeField($value): ?ProducaoLeite
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
