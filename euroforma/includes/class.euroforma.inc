<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class pdoeuroforma
{
    private static $serveur = 'mysql:host=localhost';//private c est que dans la classe mere static le meme pour tte la classe  
    //
    //localhost serveur locale
    private static $bdd = 'dbname=euroforma';
    private static $user = 'root';
    private static $mdp = '';
    private static $monPdo;
    private static $monPdoeuroforma= null;

    /**
     * Constructeur privé, crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
private function __construct()
    {
        Pdoeuroforma::$monPdo = new PDO(//cree une methode qui va instancier une classe pour creer un nouvel objet 
            Pdoeuroforma::$serveur . ';' . Pdoeuroforma::$bdd,
            Pdoeuroforma::$user,
            Pdoeuroforma::$mdp
        );
        Pdoeuroforma::$monPdo->query('SET CHARACTER SET utf8');//query c est qd on lance la requete 
    }


    /**
     * Méthode destructeur appelée dès qu'il n'y a plus de référence sur un
     * objet donné, ou dans n'importe quel ordre pendant la séquence d'arrêt.
     */
    public function __destruct()
    {
        Pdoeuroforma::$monPdo = null;
    }

    /**
     * Fonction statique qui crée l'unique instance de la classe
     * Appel : $instancePdoGsb = PdoGsb::getPdoGsb();
     *
     * @return l'unique objet de la classe PdoGsb
     */
    public static function getPdoeuroforma()
    {
        if (Pdoeuroforma::$monPdoeuroforma == null) {
            Pdoeuroforma::$monPdoeuroforma = new Pdoeuroforma ();
        }
        return Pdoeuroforma::$monPdoeuroforma;
    }

    /**
     * Retourne les informations d'un visiteur
     *
     * @param String $login Login du visiteur
     * @param String $mdp   Mot de passe du visiteur
     *
     * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
     */
    public function getInfosUtilisateur($login, $mdp)
    {
        $requetePrepare = pdoeuroforma::$monPdo->prepare(
        'SELECT utilisateur.nom AS nom '
            . 'FROM utilisateur '
            . 'WHERE utilisateur.login = :unLogin AND utilisateur.mdp = :unMdp'
        );
        $requetePrepare->bindParam(':unLogin', $login, PDO::PARAM_STR);
        $requetePrepare->bindParam(':unMdp', $mdp, PDO::PARAM_STR);
        $requetePrepare->execute();
        return $requetePrepare->fetch();
    }
 public function getListeEleves()
   {
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT  eleve.idEleve AS id,'
           . 'eleve.nom as nom,'
           . 'eleve.prenom AS prenom '
           . 'FROM eleve'

       );
       $requetePrepare->execute();
       return $requetePrepare->fetchAll();
   }
   public function getListeFormateurs()
   {
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT  formateur.idFormateur AS id,'
           . 'formateur.nom as nom,'
           . 'formateur.prenom AS prenom '
           . 'FROM formateur'
        );
       $requetePrepare->execute();
       return $requetePrepare->fetchAll();
   }
   public function getListeMatieres()
   {
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT DISTINCT idMatiere, '
           . ' matiere '
            . 'FROM seance '
        );
       $requetePrepare->execute();
       return $requetePrepare->fetchAll();
   }
   
   public function getheurespresence($idEleve)
   {
       $dateactuelle= date('m');
       $dateactuel= strval($dateactuelle);
       $date=$dateactuel.substr($dateactuel,4,2);

       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT SUM(duree)'
               . ' FROM eleve join emargement USING(idEleve) '
               . '            join seance USING(idSeance) '
               . 'WHERE idEleve=:unidEleve AND presence="OUI" AND substr(date,4,2)=:date '
          
      
         );
       $requetePrepare->bindParam(':unidEleve', $idEleve, PDO::PARAM_STR);
       $requetePrepare->bindParam(':date', $date, PDO::PARAM_STR);       
       $requetePrepare->execute();
       return $requetePrepare->fetchAll();
   }
   public function getNbPresences($idEleve)
   {
       $dateactuelle= date('m');
       $dateactuel= strval($dateactuelle);
       $date=$dateactuel.substr($dateactuel,4,2);
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT COUNT(presence) '
               . ' FROM eleve join emargement USING(idEleve) '
               . '               join seance USING(idSeance) '
               . 'WHERE idEleve=:unidEleve AND presence="OUI" AND substr(date,4,2)=:date '
          
      
         );
       $requetePrepare->bindParam(':unidEleve', $idEleve, PDO::PARAM_STR);
       $requetePrepare->bindParam(':date', $date, PDO::PARAM_STR);       
       $requetePrepare->execute();
       return $requetePrepare->fetchAll();
   }
   public function getNbSeanceTotal()
   {  $dateactuelle= date('m');
       $dateactuel= strval($dateactuelle);
       $date=$dateactuel.substr($dateactuel,4,2);
        $requetePrepare = pdoeuroforma::$monPdo->prepare(
                'SELECT COUNT(idSeance) '
                . 'FROM seance '
                 . 'WHERE substr(date,4,2)=:date '
                
                  );
               $requetePrepare->bindParam(':date', $date, PDO::PARAM_STR);
       $requetePrepare->execute();
       return $requetePrepare->fetch();
                
   }

   
    function Pourcentage($NbAbsences, $NbSeanceTotal) {
	return $NbAbsences * 100 / $NbSeanceTotal;
}

 public function getheuresformateur()
   {
        $requetePrepare = pdoeuroforma::$monPdo->prepare(
                'SELECT(duree) '
                . 'FROM seance '
                 . 'GROUP BY idFormateur'
                  );
           
       $requetePrepare->execute();
       return $requetePrepare->fetchAll();
                
   }
public function getheuresmatiere()
   {
        $requetePrepare = pdoeuroforma::$monPdo->prepare(
                'SELECT COUNT(duree) '
                . 'FROM seance '
                . 'GROUP BY idMatiere'
                  );
        
      
           
       $requetePrepare->execute();
       return $requetePrepare->fetchAll();
                
   }
   
   public function getInfosEleve($idEleve)
   {
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT eleve.idEleve, '
           . 'eleve.nom as nom,'
           . 'eleve.prenom AS prenom '
           . 'FROM eleve '
           . 'WHERE idEleve=:unIdEleve'

       );
       $requetePrepare->bindParam(':unIdEleve', $idEleve, PDO::PARAM_STR);
       $requetePrepare->execute();
       return $requetePrepare->fetch();
   }
   
   public function getInfosFormateur($idFormateur)
   { $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT formateur '
           . 'FROM seance '
           . 'WHERE idFormateur=:unIdFormateur'

       );
       $requetePrepare->bindParam(':unIdFormateur', $idFormateur, PDO::PARAM_STR);
       $requetePrepare->execute();
       return $requetePrepare->fetch();
   }
   
      public function getdatedenaissance($idEleve)
   {
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT datedenaissance '
           . 'FROM eleve '
           . 'WHERE idEleve=:unIdEleve'

       );
       $requetePrepare->bindParam(':unIdEleve', $idEleve, PDO::PARAM_STR);
       $requetePrepare->execute();
       return $requetePrepare->fetch();
   }
    public function getadresse($idEleve)
   {
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT adresse '
           . 'FROM eleve '
           . 'WHERE idEleve=:unIdEleve '

       );
       $requetePrepare->bindParam(':unIdEleve', $idEleve, PDO::PARAM_STR);
       $requetePrepare->execute();
       return $requetePrepare->fetch();
   }
    public function getsociete($idEmployeur)
   {
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT entreprise '
           . 'FROM employeur '
           . 'WHERE idEmployeur=:unIdEmployeur'

       );
       $requetePrepare->bindParam(':unIdEmployeur', $idEmployeur, PDO::PARAM_STR);
       $requetePrepare->execute();
       return $requetePrepare->fetch();
   }
   public function getemployeur($idEleve)
   {
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT employeur.nom, '
           . 'employeur.prenom, '
           .'employeur.idEmployeur '
           . 'FROM eleve join employeur USING (idEmployeur) '
           . 'WHERE idEleve=:unIdEleve'

       );
       $requetePrepare->bindParam(':unIdEleve', $idEleve, PDO::PARAM_STR);
       $requetePrepare->execute();
       return $requetePrepare->fetch();
   }
     public function getduree($idFormateur)
   {
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT SUM(duree) '
           . 'FROM seance '
           . 'WHERE idFormateur=:unIdFormateur'

       );
       $requetePrepare->bindParam(':unIdFormateur', $idFormateur, PDO::PARAM_STR);
       $requetePrepare->execute();
       return $requetePrepare->fetch();
   }
     public function getmatiere($idFormateur)
   {
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT DISTINCT matiere '
           . 'FROM seance '
           . 'WHERE idFormateur=:unIdFormateur '

       );
       $requetePrepare->bindParam(':unIdFormateur', $idFormateur, PDO::PARAM_STR);
       $requetePrepare->execute();
       return $requetePrepare->fetchAll();
   }
   
 public function getdureematiere($idMatiere)
   {
       $requetePrepare = pdoeuroforma::$monPdo->prepare(
           'SELECT SUM(duree) '
           . 'FROM seance '
           . 'WHERE matiere=:uneMatiere '

       );
       $requetePrepare->bindParam(':uneMatiere', $idMatiere, PDO::PARAM_STR);
       $requetePrepare->execute();
       return $requetePrepare->fetch();
   }
   
   }
           

           
   
