<?php
/**
* Vue Liste des mois
*
* PHP Version 7
*
@category  PPE
* @package   GSB
* @author    beth sefer, Léa Yabra
*/

?>
<h2>Mes fiches de frais</h2>
<div class="row">
   <div class="col-md-4">
       <h3>Sélectionner un mois : </h3>
   </div>
   <div class="col-md-4">
       <form action="index.php?uc=etatFrais&action=voirEtatFrais"
             method="post" role="form">
           <div class="form-group">
               <label for="lstMois" accesskey="n">Mois : </label>
               <select id="lstMois" name="lstMois" class="form-control"> 
         <!-- id class c'est pour le css, name on reupere les donne ds le controleur? -->
        
              <?php // quand c'est pas langage des balises 
                   foreach ($lesMois as $unMois) {//on met le mois en local (on renomme la variable §lesMois qui vient d'une autre classe en $unMois)
                                                  // foraech parcourir ligne par ligne
                       $mois = $unMois['mois'];// unMois a l'indice mmois
                       $numAnnee = $unMois['numAnnee'];
                       $numMois = $unMois['numMois'];
                       if ($mois==$moisASelectionner ) {
                           ?>
                           <option selected value="<?php echo $mois ?>"> <!-- si on achoisi ce qui est par defaut -->
                               <?php echo $numMois . '/' . $numAnnee ?> </option>> <!-- on affiche le mois / l'anne -->
                           <?php
                       } else {
                           ?>
                           <option value="<?php echo $mois ?>">
                               <?php echo $numMois . '/' . $numAnnee ?> </option> <!-- si on a choisi autre chose-->
                           <?php
                       }
                   }
                   ?>    

               </select>
           </div>
           <input id="ok" type="submit" value="Valider" class="btn btn-success"  role= "button">   <!-- INPUT affiche un elemnt selon le role qu'on lui donne submit= envoyer les element de la facon dont on les a declare-->
                <!-- quoi co style de bouton-->
           <input id="annuler" type="reset" value="Effacer" class="btn btn-danger"
                  role="button"><!-- reset= remet a 0 pas d'action-->
       </form>
   </div>
</div>

