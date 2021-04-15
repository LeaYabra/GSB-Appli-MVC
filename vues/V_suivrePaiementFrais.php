<?php

/**
* Vue suivre Paiement Frais
*
* PHP Version 7
*
@category  PPE
* @package   GSB
* @author    beth sefer, Léa Yabra
*/
?>
<h2>Suivre le Paiement de la Fiche de Frais</h2>
<div class="row">
   <div class="choix visiteur">
       <form action="index.php?uc=suivrePaiementFrais&action=afficherFrais"
             method="post" role="form">
          
                   
                   
                   
           <div class="form-group">
               <label for="lstVisiteurs" accesskey="n">choisir le visiteur : </label>
               <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
                   <?php
                   foreach ($lesVisiteurs as $unVisiteur) {
                       $visiteur = $unVisiteur['id'];
                       $nom = $unVisiteur['nom'];
                       $prenom = $unVisiteur['prenom'];
                       if ($visiteurASelectionner == $unVisiteur) {
                           ?>
                           <option selected value="<?php echo $visiteur ?> ">
                               <?php echo $nom . ' ' . $prenom ?>
                           </option>
                           <?php
                       } else {
                           ?>
                           <option value="<?php echo $visiteur ?> ">
                               <?php echo $nom . ' ' . $prenom ?></option>
                               
                           <?php
                       }
                   }
                   ?>    

               </select>
           </div>
           
                            
           <div class="choix mois">
               <label for="lstMois" accesskey="n">Mois : </label>
               <select id="lstMois" name="lstMois" class="form-control">
                   <?php
                   foreach ($lesMois as $unMois) {//on met le mois en local (on renomme la variable §lesMois qui vient d'une autre classe en $unMois)
                       $mois = $unMois['mois'];
                       $numAnnee = $unMois['numAnnee'];
                       $numMois = $unMois['numMois'];
                       
                       if ($mois==$moisASelectionner ) {
                           ?>
                           <option selected value="<?php echo $mois ?>">
                               <?php echo $numMois . '/' . $numAnnee ?> </option>> <!-- on affiche le mois / l'anne -->
                        
                           <?php
                       } else {
                           ?>
                           <option value="<?php echo $mois ?>">
                               <?php echo $numMois . '/' . $numAnnee ?> </option>
                                
                           <?php
                           }
                          }
                   ?>
           
               </select><br>
           </div>
          
                <input id="ok" type="submit" value="Valider" class="btn btn-success" 
                       role="button" >        
       </form>
          </div>   
  </div>
