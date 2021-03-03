<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 
/**
* Vue Accueil Comptable
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
?>
<div id="accueilComptable">
   <h2>
       Gestion des frais<small> - Comptable :
           <?php
           echo $_SESSION['prenom'] . ' ' . $_SESSION['nom']// la vue va afficher le nom et le prenom du comptable
           ?></small>
   </h2>
</div>
<div class="row">
   <div class="col-md-12">
       <div class="panel panel-primary">
           <div class="panel-heading">
               <h3 class="panel-title">
                   <span class="glyphicon glyphicon-bookmark"></span>
                   Navigation
               </h3>
           </div>
           <div class="panel-body">
               <div class="row">
                   <div class="col-xs-12 col-md-12">
                       <a href="index.php?uc=validerFrais&action=selectionnerMoisVisiteur"
                          class="btn btn-success btn-lg" role="button"><!--Qd elle va cliquer sur le bouton, uc aurait la valeur gererFrais et action aurait la valeur saisirfrais -->
                           <span class="glyphicon glyphicon-ok"></span>
                           <br>Valider la fiche de frais</a>
                       <a href="index.php?uc=suivrePaiementFrais&action=afficherFrais"
                          class="btn btn-primary btn-lg" role="button">
                           <span class="glyphicon glyphicon-euro"></span>
                           <br>Suivre les fiches de frais</a>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>

