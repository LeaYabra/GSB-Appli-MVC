<?php

/**
 * Gestion de l'accueil
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
$idComptable = $_SESSION['id']; // on met le contenu de la colonne idcomptable ds la variable $idcomptable
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); //filtre sur la variable action
$moisAnnee = getMois(date('d/m/Y'));


switch ($action) {


    case 'selectionnerMoisVisiteur':
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $lesCles1 = array_keys($lesVisiteurs);
        $visiteurASelectionner = $lesCles1[0];
        $mois = getMois(date('d/m/Y'));
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

        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $visiteurASelectionner = $idVisiteur;
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $moisASelectionner = $mois;
        $lesFrais = filter_input(INPUT_POST, 'lesFraisF', FILTER_DEFAULT, FILTER_FORCE_ARRAY);

        if (lesQteFraisValides($lesFrais)) {
            var_dump($idVisiteur,$mois,$lesFrais);
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
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
        $visiteurASelectionner = $idVisiteur;
        $mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $moisASelectionner = $mois;
        $dateHF = filter_input(INPUT_POST, 'dateHF', FILTER_SANITIZE_STRING);
        $libelle = filter_input(INPUT_POST, 'libelleHF', FILTER_SANITIZE_STRING);
        $montantHF = filter_input(INPUT_POST, 'montantHF', FILTER_SANITIZE_STRING);
        $lesFraisHF = filter_input(INPUT_POST, 'lesFraisHF', FILTER_SANITIZE_STRING);
        if(isset($_POST ['corriger'])) { 
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
        
        
}if(isset($_POST ['reporter'])){
           
              //$idVisiteur = filter_input(INPUT_POST, 'lstVisiteurs', FILTER_SANITIZE_STRING);
               //$mois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);

              $idFraisHF = filter_input(INPUT_POST, 'lesFraisHF', FILTER_SANITIZE_NUMBER_INT);
              $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);       
              $montant = filter_input(INPUT_POST, 'montant', FILTER_SANITIZE_STRING);


               $pdo->majLibelle($idVisiteur, $mois, $idFraisHF);
              
               
               $pdo->creeNouveauFraisHorsForfait($idVisiteur, $mois,$idFraisHF,$date, $montant);
                include 'vues/v_afficherFrais.php';
      }
      
    
        
        break;
}

  


   

     
    



   
