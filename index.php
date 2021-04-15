<?php
/**
 * Index du projet GSB
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

require_once 'includes/fct.inc.php';
   //fct => fct simples
   // INC= pas fichiers en soit mais qu'on va intégrer dans un autre fichiers
   // require= erreur fatale, arret du programme
   // includes= warning
require_once 'includes/class.pdogsb.inc.php';
   // classe.pdogsb :c'est un fichiersfichier qui contient des fonctions ac des requetes sql qui vont interagir dans la BDD.   
session_start();
  // methode qui fait appel a la session et a fait démarrer; la session c'est une énorme variables(super global) qui peut contenir plein de variables.
$pdo = PdoGsb::getPdoGsb();
  //pdo= variable , donc on met avant un $;on lui affecte le resultat de la requete getpdogsb , ::= reccourci d'ecriture,
  //le getpdogsb elle nous connecte a la bdd; On appelle le résultat de la méthode getGsb() qui vient de la classe PdoGsb.
$estConnecte = estConnecte();
// le resultat de la fonction est connecte est affecte dans la variable est connecte.
require 'vues/v_entete.php';
//   require = va lancer le fichier si ca marche pas il s'arrette; 
 //   vues/v_entete.php =  le fichier v_entete  se trouve dans le dossier vue.
$uc = filter_input(INPUT_GET, 'uc', FILTER_SANITIZE_STRING);
//filter-input = methode elle sert a verifier le contenu dans un element; uc et action c'est des variables qu'n utilise tout au long et qui change tout le temps de variable; 
//filter input va verifier le contenu de uc et verifier 
if ($uc && !$estConnecte) {//si c'est pas connecté
   $uc = 'connexion';//alors $uc prend la valeur 'acceuil'
} elseif (empty($uc)) {//si $uc est vide, on affecte la valeur connexion à $uc
   $uc = 'accueil';//=> on met connexion
}
switch ($uc) {
//switch=sur la valeur uc on va faire plusieurs cas ; c'est une facon de donner un cas multiple
case 'connexion':
// case= cas 
    include 'controleurs/c_connexion.php';
//si uc prend la valeur connexion alors on ouvre le fichiers c_connexion du dossier controleur
    break;
case 'accueil':
    include 'controleurs/c_accueil.php';
    break;
//si prend la valeur acceuil alors faudra
case 'gererFrais':
    include 'controleurs/c_gererFrais.php';
    break;
case 'etatFrais':
    include 'controleurs/c_etatFrais.php';
    break;
case 'deconnexion':
    include 'controleurs/c_deconnexion.php';
    break;
case 'validerFrais':
    include'controleurs/c_validerFrais.php';
    break;
case 'suivrePaiementFrais':
    include 'controleurs/c_suivrePaiementFrais.php';
    break;


}
require 'vues/v_pied.php';
//dans tout les cas on lance le fichiers v_pied , pied de page qui se trouve dans le dossier vues
