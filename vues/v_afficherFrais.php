<?php
/*
 *@category  PPE
* @package   GSB
* @author    beth sefer, Léa Yabra
*/

?>
<form action="index.php?uc=validerFrais&action=corrigerFraisForfait" role="form" method="post">
    <div class="row">
        <div class="col-md-4">

<?php //liste déroulante des visiteurs ?>

            <div class="form-group" style="display: inline-block"> 
                <label for="lstVisiteurs" accesskey="n">Choisir le visiteur : </label>
                <select id="lstVisiteurs" name="lstVisiteurs" class="form-control">
<?php
foreach ($lesVisiteurs as $unVisiteur) {
    $id = $unVisiteur['id'];
    $nom = $unVisiteur['nom'];
    $prenom = $unVisiteur['prenom'];
    if ($id == $visiteurASelectionner) {
        ?>
                            <option selected value="<?php echo $id ?>">
                            <?php echo $nom . ' ' . $prenom ?> </option>
                                <?php
                            } else {
                                ?>
                            <option value="<?php echo $id ?>">
                            <?php echo $nom . ' ' . $prenom ?> </option>
                                <?php
                            }
                        }
                        ?>    

                </select>
            </div>

<?php //liste déroulante des mois ?>

            &nbsp;  <div class="form-group" style="display: inline-block">
                <label for="lstMois" accesskey="n">Mois : </label>
                <select id="lstMois" name="lstMois" class="form-control">
<?php
foreach ($lesMois as $unMois) {//on met le mois en local
    //(on renomme la variable $lesMois qui vient d'une autre
    //classe en $unMois)
    $mois = $unMois['mois'];
    $numAnnee = $unMois['numAnnee'];
    $numMois = $unMois['numMois'];
    if ($mois == $moisASelectionner) {
        ?>
                            <option selected value="<?php echo $mois ?>">
                            <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <!-- on affiche le mois / l'annee -->
                                <?php
                            } else {
                                ?>
                            <option value="<?php echo $mois ?>">
                            <?php echo $numMois . '/' . $numAnnee ?> </option>
                                <?php
                            }
                        }
                        ?>    
                </select>
            </div>
        </div>
    </div>


    <!--
    elements forfaitisés-->

    <div class="valide">
        <div class="row">    

            <h2 style = "color : orange">Valider la fiche de frais</h2>
            <h3>Eléments forfaitisés</h3> 
            <div class="col-md-4"> 
                <input type="hidden" id="lstMois" name="lstMois" <?php echo $moisASelectionner ?>>
                <input type="hidden" id="lstVisiteurs" name="lstVisiteurs" <?php echo $visiteurASelectionner ?>>
                <!-- On va ds l'index -->
                <fieldset>      
<?php
foreach ($lesFraisForfait as $unFrais) {
    //on va boucler sur le tableau lesFraisForfait, foreact => chaque ligne du tableau
    $idFrais = $unFrais['idfrais']; //on récupère l'idfrais pour chaque ligne du tableau
    $libelle = htmlspecialchars($unFrais['libelle']);
    $quantite = $unFrais['quantite'];
    ?>
                        <div class="form-group">
                            <label for="idFrais"><?php echo $libelle ?></label><!-- On affiche le libellé -->
                            <input type="text" id="idFrais"
                                   name="lesFraisF"<?php echo $idFrais ?>
                                   size="10" maxlength="5"
                                   value="<?php echo $quantite ?>"
                                   class="form-control">
                        </div>

                        <?php
                    }
                    ?>


                    <button class="btn btn-success" type="edit">Corriger</button>
                    <button class="btn btn-danger" type="reset">Réinitialiser</button>

                </fieldset>
            </div>
        </div>
    </div>
</form>
<br> <br> <br>


<!--
element hors forfait-->



<div class="panel panel-info-comptable">
    <div class="panel-heading">Descriptif des éléments hors forfait </div>
    <table class="table table-bordered table-responsive">
        <form method="post"
              accept-charset=""action="index.php?uc=validerFrais&action=corrigerFraisHorsForfait"
              accesskey=""role="form">     
            <tr>
                <th class="date">Date</th>
                <th class="libelle">Libellé</th>
                <th class='montant'>Montant</th>
                <th></th>
            </tr>
            <?php
            foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                $date = $unFraisHorsForfait['date'];
                $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                $montant = $unFraisHorsForfait['montant'];
                $lesFraisHF = $unFraisHorsForfait['id'];
                ?>

                <input name="lstMois" type="hidden" id="lstMois" class="form-control" value="<?php echo $moisASelectionner ?>">
                <input name="lstVisiteurs" type="hidden" id="lstVisiteurs" class="form-control" value="<?php echo $visiteurASelectionner ?>">

                <tr>
                    <td><input name="dateHF" type="text" id="txtDateHF" class="form-control" value="<?php echo $date ?>"></td>
                    <td><input name="libelleHF" type="text" id="txtLibelleHF" class="form-control" value="<?php echo $libelle ?>"></td>
                    <td><input name="montantHF" type="text" id="txtMontantHF" class="form-control" value="<?php echo $montant ?>"></td>
                    <td><input name="lesFraisHF" type="hidden" id="idFHF" class="form-control" value="<?php echo $lesFraisHF ?>"></td>
                    <th><button class="btn btn-success" type="edit" name="corriger" value="corriger">Corriger</button>
                        <button class="btn btn-danger" type="reset">Reinitialiser</button>
                    </th>
                    <td>
                       <button class="btn btn-success" type="submit" name="reporter" value="reporter" onclick="return confirm('Voulez-vous vraiment reporter ce frais?');">Reporter</button>    
                    </td>              
                </tr>

                <?php
            }
            ?>

    </table>
</div>
</form>


<form action="index.php?uc=validerFrais&action=validModif"
      method="post" role="form">
    <div class="row">  
        <div class="col-md-4">
            <button class="btn btn-success" type="submit">Valider</button>
            <button class="btn btn-danger" type="reset">Réinitialiser</button>

        </div>
    </div>

</form>   

