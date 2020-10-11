<?php

namespace App\Repository;

use App\Entity\Projet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * @method Projet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projet[]    findAll()
 * @method Projet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projet::class);
    }

    // /**
    //  * @return Projet[] Returns an array of Projet objects
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
    public function findOneBySomeField($value): ?Projet
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function rechercheTout($nbreDeProjetParPage, $page)
    {
    $qb = $this->createQueryBuilder('p')
                ->andWhere('p.active = :val')
                ->setParameter('val', true)
                ->orderBy('p.datecreation','DESC');
    
    $qb
    
    // On définit le projet à partir de laquelle commencer la liste
    ->setFirstResult(($page - 1) * $nbreDeProjetParPage)
    // Ainsi que le nombre de projet à afficher sur une page
    ->setMaxResults($nbreDeProjetParPage)
    ->getQuery()
;

// Enfin, on retourne l'objet Paginator correspondant à la requête construite
return new Paginator($qb, true);
    }

    public function rechercheAvant($nbreDeProjet)
    {
    $qb = $this->createQueryBuilder('p')
                ->andWhere('p.active = :val')
                ->setParameter('val', true)
                ->orderBy('p.avant','DESC');
    
    $qb
    

    // Ainsi que le nombre de projet à afficher sur une page
    ->setMaxResults($nbreDeProjet)
    ->getQuery()
;

// Enfin, on retourne l'objet Paginator correspondant à la requête construite
return new Paginator($qb, true);
    }
}
