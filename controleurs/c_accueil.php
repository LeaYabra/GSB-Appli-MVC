<?php
/**
* Gestion de l'accueil
*
* PHP Version 7
*
*@category  PPE
* @package   GSB
* @author    beth sefer, Léa Yabra
*/



if (estComptableconnecte()) {
   include 'vues/v_accueil_Comptable.php';// on est redirigé vers la vue accueil
} else if (estVisiteurconnecte()) {
   include 'vues/v_accueil.php';// on est redirigé vers la vue accueil
}else {
// si elle est vide
   include 'vues/v_connexion.php';// on va vers vue connexion
}