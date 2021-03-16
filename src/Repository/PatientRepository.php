<?php

namespace App\Repository;

use App\Entity\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    public function getIdUtilisateurPatient(){
        $em = $this->getEntityManager();
        $query = $em->createQuery("SELECT u.id, u.NomUtilisateur, u.PrenomUtilisateur 
                                   FROM App\Entity\Utilisateur u
                                   WHERE u.Grade = 'Patient'");

        return $query->getScalarResult();
    }

    public function setIdUtilisateurPatient($id, $nom_user, $prenom_user){
        $em = $this->getEntityManager();
        $query = $em->createQuery("UPDATE App\Entity\Patient p
                                   SET p.IdUtilisateur = '$id'
                                   WHERE p.NomPatient = '$nom_user'
                                   AND p.PrenomPatient = '$prenom_user'");
        return $query->execute();
    }

}