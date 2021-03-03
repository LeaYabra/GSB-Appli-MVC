<?php
/**
* Gestion des frais
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

$idVisiteur = $_SESSION['id'];// on met le contenu de la colonne idVisiteur ds la variable $idVisiteur
$mois = getMois(date('d/m/Y'));
$numAnnee = substr($mois, 0, 4);// substr() c'est extraire de la variable $mois a partir du 1er caractère jusqu'au 4eme (=> l'annee)
$numMois = substr($mois, 4, 2);//on extrait le mois   (=>10)
$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);//filtre sur la variable action
switch ($action) {
case 'saisirFrais':
   if ($pdo->estPremierFraisMois($idVisiteur, $mois)) {
   $pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
   // par defaut le booleen retourne faux, donc si c faux,
  // il faut appeler la fct creeNouvellesLignesFrais() elle va creer une nouvelle fiche de frais pr ce mois
   }
   break;
   
case 'majFraisForfait':
   $lesFrais = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT ,FILTER_FORCE_ARRAY);
   if (lesQteFraisValides($lesFrais)) {
//si le tableau contient que des nb positifs
       $pdo->majFraisForfait($idVisiteur, $mois, $lesFrais);
       } else {
       ajouterErreur('Les valeurs des frais doivent être numériques');
       include 'vues/v_erreurs.php';
   }
   break;
case 'validerCreationFrais':
   $dateFrais = filter_input(INPUT_POST, 'dateFrais', FILTER_SANITIZE_STRING);
   $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
   $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
   var_dump($montant);//affiche le montant à l'écran
   valideInfosFrais($dateFrais, $libelle, $montant);//elle verifie si ttes les données ont été remplies et si elles correspondent au tyoe de caractere
   if (nbErreurs()!=0) {//si y a une erreur
       include 'vues/v_erreurs.php';
   } else {
       $pdo->creeNouveauFraisHorsForfait(
           $idVisiteur,
           $mois,
           $libelle,
           $dateFrais,
           $montant
       );
   }
   break;
case 'supprimerFrais':
   $idFrais = filter_input(INPUT_GET, 'idFrais', FILTER_SANITIZE_STRING);
   $pdo->supprimerFraisHorsForfait($idFrais);
   break;
}
$lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $mois);
$lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $mois);
require 'vues/v_listeFraisForfait.php';
require 'vues/v_listeFraisHorsForfait.php';
