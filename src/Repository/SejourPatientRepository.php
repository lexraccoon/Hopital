<?php

namespace App\Repository;

use App\Entity\SejourPatient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SejourPatient|null find($id, $lockMode = null, $lockVersion = null)
 * @method SejourPatient|null findOneBy(array $criteria, array $orderBy = null)
 * @method SejourPatient[]    findAll()
 * @method SejourPatient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SejourPatientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SejourPatient::class);
    }

    public function getIdLit()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT MIN(l.id)
                                    FROM App\Entity\Lit l
                                    WHERE l.Disponibilite = 1");
        $id = $query->getSingleScalarResult();
        return $id;
    }

    public function makeLitIndisponible($idLit)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("UPDATE App\Entity\Lit l
                                   SET l.Disponibilite = 0
                                   WHERE l.NumeroLit = '$idLit'");
        return $query->execute();
    }
}
