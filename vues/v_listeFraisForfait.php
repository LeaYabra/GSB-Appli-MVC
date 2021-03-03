<?php
/**
* Vue Liste des frais au forfait
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
<div class="row">    
   <h2>Renseigner ma fiche de frais du mois
       <?php echo $numMois . '-' . $numAnnee ?>
   </h2>
   <h3>Eléments forfaitisés</h3>
   <div class="col-md-4">
       <form method="post"
             action="index.php?uc=gererFrais&action=majFraisForfait"
             role="form">
           <!-- On va ds l'index -->
           <fieldset>      
               <?php
               foreach ($lesFraisForfait as $unFrais) {//on va boucler sur le tableau lesFraisForfait, foreact => chaque ligne du tableau
                   $idFrais = $unFrais['idfrais'];//on récupère l'idfrais pour chaque ligne du tableau
                   $libelle = htmlspecialchars($unFrais['libelle']);
                   $quantite = $unFrais['quantite']; ?>
                   <div class="form-group">
                       <label for="idFrais"><?php echo $libelle ?></label><!-- On affiche le libellé -->
                       <input type="text" id="idFrais"
                              name="lesFrais[<?php echo $idFrais ?>]"
                              size="10" maxlength="5"
                              value="<?php echo $quantite ?>"
                              class="form-control">
                   </div>
                   <?php
               }
               ?>
               
               <button class="btn btn-success" type="submit">Ajouter</button>
               <button class="btn btn-danger" type="reset">Effacer</button>
           </fieldset>
       </form>
   </div>
</div>