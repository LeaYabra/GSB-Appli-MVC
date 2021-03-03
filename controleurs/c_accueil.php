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



if (estComptableconnecte()) {
   include 'vues/v_accueil_Comptable.php';// on est redirigé vers la vue accueil
} else if (estVisiteurconnecte()) {
   include 'vues/v_accueil.php';// on est redirigé vers la vue accueil
}else {
// si elle est vide
   include 'vues/v_connexion.php';// on va vers vue connexion
}