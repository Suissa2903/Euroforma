<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);

switch ($action) {
case'Heuresenseignement':
    $idFormateur = filter_input(INPUT_POST, 'lstformateur', FILTER_SANITIZE_STRING);
    $heuresformateur=$pdo->getduree($idFormateur);
    $listeMatieres=$pdo->getListeMatieres();

     $InfosFormateur=$pdo->getInfosFormateur($idFormateur);
       $formateur=$InfosFormateur['formateur'];
 
    $matiereFormateur=$pdo->getmatiere($idFormateur);

    foreach ($matiereFormateur as $uneMatiere){
      $dureematiere=$pdo->getdureematiere($uneMatiere['matiere']);
    
    }
   include 'Vues/v_CRformateur.php';
    break;
}