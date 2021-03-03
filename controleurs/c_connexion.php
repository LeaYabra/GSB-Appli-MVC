<?php
/**
* Gestion de la connexion
*
* PHP Version 7
*
* @category  PPE
* @package   GSB
* @author    beth sefer, Léa Yabra
*/

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);//$action change de val un peu comme uc, mais on l'utilise principalement dans les controleurs
if (!$action) {//si action est vide
   $action = 'demandeConnexion';
}

switch ($action) {//cas multiple
case 'demandeConnexion':
   include 'vues/v_connexion.php';//on va dans ce fichier qui se trouve dans le dossier vues
   break;
case 'valideConnexion':
   $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);//on fait un filter input sur la variable login pour recuperer sa valeur
   $mdp = filter_input(INPUT_POST, 'mdp', FILTER_SANITIZE_STRING);
   $visiteur = $pdo->getInfosVisiteur($login,$mdp);//on va dans la classe pdo gsb, la méthode getInfosVisiteur
   $comptable = $pdo->getInfoscomptable($login, $mdp);//on va dans la classe pdo gsb, la méthode getInfoscomptable
  
 if (!is_array($visiteur) && !is_array($comptable)) {
       ajouterErreur('Login ou mot de passe incorrect');
       include 'vues/v_erreurs.php';
       include 'vues/v_connexion.php';
       //si y a pas dans le tableau =>on n'a pas trouvé le visiteur qui correspond
        // cette phrase s'affiche
   } else {
           if(is_array($visiteur))  {
               $id= $visiteur ['id'];
               $nom = $visiteur['nom'];
               $prenom = $visiteur['prenom'];
               $statut = 'visiteur';
           }
       elseif(is_array($comptable))  {
           $id= $comptable ['id'];
           $nom = $comptable ['nom'];
           $prenom = $comptable ['prenom'];
           $statut = 'comptable';
       }
       
      connecter($id, $nom, $prenom,$statut);
     
        header('Location: index.php');//balise pr ns dire qu'on va retourner vers l'index
   }
   
   break;
default:
   include 'vues/v_connexion.php';
   break;
}

