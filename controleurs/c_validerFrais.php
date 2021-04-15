<?php

/**
 * Gestion de la validation de frais
 *
 * PHP Version 7
 *
 @category  PPE
* @package   GSB
* @author    beth sefer, Léa Yabra
*/
$idComptable = $_SESSION['id']; // on met le contenu de la colonne idcomptable ds la variable $idcomptable
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); //filtre sur la variable action
$moisAnnee = getMois(date('d/m/Y'));
$mois = getMois(date('d/m/Y'));

switch ($action) {


    case 'selectionnerMoisVisiteur':
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $lesCles1 = array_keys($lesVisiteurs);
        $visiteurASelectionner = $lesCles1[0];
        $lesMois = lesdouzederniermois($mois);
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];

        include 'vues/v_visiteursMois.php';
        break;
// Afin de sélectionner par défaut le dernier mois dans la zone de liste (le plus recent)
    // on demande toutes les clés, et on prend la première,
    // les mois étant triés décroissants   



    case 'afficherFrais':
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $visiteurASelectionner = $idVisiteur;
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_DEFAULT, FILTER_SANITIZE_STRING);
        $lesMois = lesdouzederniermois($moisAnnee);
        $moisASelectionner = $mois;
        $infosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);
        $lesFraisForfait = $pdo->getlesFraisForfait($idVisiteur, $mois);
        $lesFraisHorsForfait = $pdo->getlesFraisHorsForfait($idVisiteur, $mois);
        
    if (!is_array($infosFicheFrais)) {
            ajouterErreur('Pas de fiche de frais pour ce visiteur et ce mois');
            include 'vues/v_erreurs.php';
        } else {
            include 'vues/v_afficherFrais.php';
        }
        break;


    case 'corrigerFraisForfait':
      $lesVisiteurs = $pdo->getLesVisiteurs();
        $lesMois = lesdouzederniermois($mois);
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $visiteurASelectionner = $idVisiteur;
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $moisASelectionner = $mois;
        $lesFrais = filter_input(INPUT_POST, 'lesFraisF', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
    
        if (lesQteFraisValides($lesFrais)) {
            $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
            echo "La modification a bien été prise en compte.";
        } else {
            ajouterErreur('Les valeurs des frais doivent être numériques');
            include 'vues/v_erreurs.php';
        }
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
        include 'vues/v_afficherFrais.php';

        break;

    case 'corrigerFraisHorsForfait':
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $lesMois = lesdouzederniermois($mois);
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $visiteurASelectionner = $idVisiteur;
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $moisASelectionner = $mois;
        $dateHF = filter_input(INPUT_POST, 'dateHF', FILTER_SANITIZE_STRING);
        $libelle = filter_input(INPUT_POST, 'libelleHF', FILTER_SANITIZE_STRING);
        $montantHF = filter_input(INPUT_POST, 'montantHF', FILTER_SANITIZE_STRING);
        $lesFraisHF = filter_input(INPUT_POST, 'lesFraisHF', FILTER_SANITIZE_STRING);
        if(isset($_POST['corriger'])) { 
          if(nbErreurs()!=0){
              ajouterErreur('Les valeurs contiennent une erreur');
              include 'vues/v_erreurs.php';
          }else{
                $pdo->majFraisHorsForfait($idVisiteur,$mois,$libelle,$dateHF,$montantHF,$lesFraisHF);
                echo "La modification a bien été prise en compte.";
          }
          $lesFraisHorsForfait = $pdo->getlesFraisHorsForfait($idVisiteur, $mois);
          $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
          include 'vues/v_afficherFrais.php';
        
        
}if(isset($_POST['reporter'])){
           
              //$idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
               //$mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);

              $idFraisHF = filter_input(INPUT_POST, 'lesFraisHF', FILTER_SANITIZE_NUMBER_INT);
              $date = filter_input(INPUT_POST, 'dateHF', FILTER_SANITIZE_STRING);       
              $montant = filter_input(INPUT_POST, 'montantHF', FILTER_SANITIZE_STRING);
             
              
            $laDerniereFiche = $pdo->getLesInfosFicheFrais($idVisiteur, $mois);
            
               $pdo->majLibelle($idVisiteur, $mois, $idFraisHF);
               
               if ($laDerniereFiche['idEtat'] == 'CR') {
               $pdo->majEtatFicheFrais($idVisiteur, $mois, 'CL');
              }
               
               $lemois=$mois+1;
               $pdo->creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle,$date, $montant);
                include 'vues/v_afficherFrais.php';
                
             
                
      }
      
      //valide maj etat date et enregistre nbrde justificatif
   case'validerfichefrais':
   $nbrjustificatifs = filter_input(INPUT_POST, 'nombrejustificatifs', FILTER_SANITIZE_NUMBER_INT);
   $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
   $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
   $pdo->majNbJustificatifs($idVisiteur, $mois, $nbrjustificatifs);
   
   
   if(!$nbrjustificatifs){
          $pdo->majEtatFicheFrais($idVisiteur, $mois, 'VA');
           echo "Cette fiche a été validee";
       }else{
           ajouterErreur('Les valeurs contiennent une erreur');
              include 'vues/v_erreurs.php';
       }
       
   $sommeF= $pdo->CalculeSommeF($idVisiteur,$mois);
   $sommeHF= $pdo->CalculeSommeHF($idVisiteur,$mois);
   $sommeTotale=  $sommeF+ $sommeHF;
   $pdo->MontantValide($idVisiteur,$mois,$sommeTotale);
   
   
   
       
    
   
          
        break;
}
     
    



   
