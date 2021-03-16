<?php

namespace App\Repository;

use App\Entity\RDV;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RDV|null find($id, $lockMode = null, $lockVersion = null)
 * @method RDV|null findOneBy(array $criteria, array $orderBy = null)
 * @method RDV[]    findAll()
 * @method RDV[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RDVRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RDV::class);
    }

    public function findNumeroSecu($idUser)
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT p.NumeroDeSecu
                                    FROM App\Entity\Patient p
                                    WHERE p.IdUtilisateur = '$idUser'");
        $NumSecu = $query->getResult();

        return $NumSecu;
    }

    public function findRdvTaken($nomMedecin, $prenomMedecin){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT r.DateRDV, r.HeureRDV
                                    FROM App\Entity\RDV r
                                    WHERE r.NomMedecin = '$nomMedecin'
                                    AND r.PrenomMedecin = '$prenomMedecin'
                                    AND r.EtatRDV = 'Demandé'");
        $rdvTaken = $query->getResult();

        return json_encode($rdvTaken);
    }
}
