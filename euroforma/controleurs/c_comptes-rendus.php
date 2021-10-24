<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
if (!$action) {
    $action = 'choisirEleveouFormateur';
}
switch ($action) {
    case 'choisirEleveouFormateur':
    $listeEleves=$pdo->getListeEleves();
         $listeFormateurs=$pdo->getListeFormateurs();
         
         include 'Vues/v_comptes-rendus.php';
    break;
         
    case 'affichenbabs':
       $idEleve = filter_input(INPUT_POST, 'lsteleve', FILTER_SANITIZE_STRING);
       $InfosEleve=$pdo->getInfosEleve($idEleve);
       $nom=$InfosEleve['nom'];
       $NbSeanceTotal=$pdo->getNbSeanceTotal();
          
       $NBSeancetotal= $NbSeanceTotal[0];
       $prenom=$InfosEleve['prenom'];
       $employeur=$pdo->getemployeur($idEleve);
       
       $idEmployeur=$employeur[2];
       $heurespresence=$pdo->getheurespresence($idEleve);
       
       $Heurespresence=$heurespresence[0][0];
       $NbPresences=$pdo->getNbPresences($idEleve);

       $NBPresences= $NbPresences[0][0];
       $datedenaissance=$pdo->getdatedenaissance($idEleve);
       
       $Datedenaissance=$datedenaissance[0];
       $adresse=$pdo->getadresse($idEleve);
     
      $Adresse=$adresse[0];
       
       $societe=$pdo->getsociete($idEmployeur);
       $Societe=$societe[0];
            
   
     $Pourcentageabs=($NBPresences/$NBSeancetotal)*100;
    
    
    include 'Vues/v_compte-rendu-eleve.php';
    break;
    case'telechargerpdf':
               $idEleve = filter_input(INPUT_POST, 'lsteleve', FILTER_SANITIZE_STRING);
       $InfosEleve=$pdo->getInfosEleve($idEleve);
       $nom=$InfosEleve['nom'];
       $NbSeanceTotal=$pdo->getNbSeanceTotal();
          
       $NBSeancetotal= $NbSeanceTotal[0];
       $prenom=$InfosEleve['prenom'];
       $employeur=$pdo->getemployeur($idEleve);
       
       $idEmployeur=$employeur[2];
       $heurespresence=$pdo->getheurespresence($idEleve);
       
       $Heurespresence=$heurespresence[0][0];
       $NbPresences=$pdo->getNbPresences($idEleve);

       $NBPresences= $NbPresences[0][0];
       $datedenaissance=$pdo->getdatedenaissance($idEleve);
       
       $Datedenaissance=$datedenaissance[0];
       $adresse=$pdo->getadresse($idEleve);
     
      $Adresse=$adresse[0];
       
       $societe=$pdo->getsociete($idEmployeur);
       $Societe=$societe[0];
            
   
     $Pourcentageabs=($NBPresences/$NBSeancetotal)*100;
    
     include 'includes/class.pdf.php';
 
        break;
}

  
    
   
    
    

    



             
        

    
    

