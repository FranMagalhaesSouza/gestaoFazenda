<?php

namespace App\Repository;

use App\Entity\Animal;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Animal>
 *
 * @method Animal|null find($id, $lockMode = null, $lockVersion = null)
 * @method Animal|null findOneBy(array $criteria, array $orderBy = null)
 * @method Animal[]    findAll()
 * @method Animal[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnimalRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Animal::class);
    }

    public function save(Animal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Animal $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
    public function findAnimal()
    {
        return $this->createQueryBuilder('a')
            ->getQuery();
    }

    public function findAnimalByLikeDescricao($descricao)
    {
        return $this->createQueryBuilder('a')
            ->where('a.descricao LIKE :descricao')
            ->setParameter('descricao', "%$descricao%")
            ->getQuery();
    }

    public function findAnimalForAbate()
    {

        return $this->createQueryBuilder('a')
            ->where("TIMESTAMPDIFF(YEAR, a.dtNasc, CURRENT_DATE())>5 and a.status=0")
            ->orWhere("a.qtdleite < 40 and a.status=0")
            ->orWhere("(a.qtdleite < 70 and ((a.qtdracao / 7) > 50))and a.status=0 ")
            ->orWhere("a.peso > (18*15) and a.status=0")
            ->addOrderBy(" a.descricao,TIMESTAMPDIFF(YEAR, a.dtNasc, CURRENT_DATE()) ")
            ->getQuery();
    }

    public function findByStatus($status)
    {
        return $this->createQueryBuilder('a')
            ->where('a.status = :status')
            ->setParameter('status', "$status")
            ->getQuery();
    }

    public function findBySunLeite()
    {
        return $this->createQueryBuilder('a')
            ->andwhere('a.status = 0')
            ->select('SUM(a.qtdleite)as qtdleite')
            ->getQuery()
            ->getResult();
    }

    public function findBySUMRacao()
    {
        return $this->createQueryBuilder('a')
            ->andwhere('a.status = 0')
            ->select('SUM(a.qtdracao)as qtdracao')
            ->getQuery()
            ->getResult();
    }

    public function findByIdade()
    {
        return $this->createQueryBuilder('a')
            ->where("TIMESTAMPDIFF(YEAR, a.dtNasc, CURRENT_DATE())<=1")
            ->andwhere('a.status = 0')
            ->andWhere("a.qtdracao > 500 ")
            ->select('count(a.qtdracao)as qtdanimal')
            ->getQuery()
            ->getResult();
    }




    //    /**
    //     * @return Animal[] Returns an array of Animal objects
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

    //    public function findOneBySomeField($value): ?Animal
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
