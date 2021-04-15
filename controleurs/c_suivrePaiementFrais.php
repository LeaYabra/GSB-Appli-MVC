<?php

/**
 * Gestion du suivi de payement de frais
 *
 * PHP Version 7
 *
 @category  PPE
* @package   GSB
* @author    beth sefer, Léa Yabra
*/
$idVisiteur= $_SESSION['id']; // on met le contenu de la colonne idvisiteur ds la variable $idcomptable
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); //filtre sur la variable action
$moisAnnee = getMois(date('d/m/Y'));
$mois = getMois(date('d/m/Y'));

switch ($action) {

//on selectionne le visiteur et le mois
    case 'selectionnerMoisVisiteur':
        $lesVisiteurs = $pdo->getLesVisiteurs();
        $lesCles1 = array_keys($lesVisiteurs);
        $visiteurASelectionner = $lesCles1[0];
        $lesMois = lesdouzederniermois($mois);
        $lesCles = array_keys($lesMois);
        $moisASelectionner = $lesCles[0];

        include 'vues/v_suivrePaiementFrais.php';
        break;
    
   
    
    case 'afficherFrais':
    $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);//on recupere ce qui a ete selectionné ds la liste deroulante de nummois(qui se trouve dans v_listemois).
    $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
    $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
    $lesInfosFicheFrais = $pdo->getLesInfosFicheFrais($idVisiteur, $leMois);
    $numAnnee = substr($leMois, 0, 4);
    $numMois = substr($leMois, 4, 2);
    $libEtat = $lesInfosFicheFrais['libEtat'];
    $montantValide = $lesInfosFicheFrais['montantValide'];
    $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
    $dateModif = dateAnglaisVersFrancais($lesInfosFicheFrais['dateModif']);
    include 'vues/v_etatFrais.php';
    
}



