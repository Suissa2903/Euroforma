
<?php

?>
<form action="index.php?uc=comptes-rendus&action=presenceformateur" 
              method="post" role="form">
            
            <div class="header">
                <div class="row vertical-align">
                    <div align="center">
                        <h1>
                            <img src="./images/logo.png" class="img-responsive" 
                                 alt="L'école de comptabilité" 
                                 title="euroforma">
                        </h1>
                    </div>
              
           
            <h3> Le CFA EUROFORMA
                <p>Située au 145 rue St Maur, 75011 Paris, certifie que :</p>
                <p>Mme  <?php echo $prenom . ' ' . $nom ?></p>
            <p>Née le  <?php echo $Datedenaissance ?> </p>
            <p>Demeurant <?php echo $Adresse  ?></p> 
          <p> Salariée de l'entreprise  <?php echo $Societe  ?></p> 
          <p> A suivi l’action de formation de comptabilité</P>
           <p>du 01<?php echo(date("/m/Y"))?> au 31<?php echo(date("/m/Y"))?></p>
           <br>
            
            <p><b>Nombre de séances total : <?php echo $NBSeancetotal ?></b></p>
            <p><b>Nombre de séances suivi par le/la stagiaire: <?php echo $NBPresences ?></b></p>
            <P><b>Soit une durée de: <?php echo $Heurespresence ?> heures</b></p>
            <p> <b>Et un taux de réalisation de <?php echo ceil( $Pourcentageabs) ?>%.</b></p>
            <br>
           
            <p> Fait à Paris, le <?php echo date("d/m/Y") ?></p>
            </h3>
            </div>
                </form>
<form method="post" 
              action="index.php?uc=comptes-rendus&action=telechargerpdf" 
              role="form">
            <input name="lsteleve" type="hidden" id="lsteleve" class="form-control" value="<?php echo $idEleve ?>">
            <button class="btn btn-success" type="submit" link="">Telecharger PDF</button>
</form>
<!--<form method="post" 
              action="index.php?uc=genererCR&action=envoiPDF" 
              role="form">    
    <input name="lstEleves" type="hidden" id="lstEleves" class="form-control" value="<?php echo $idEleve ?>">
    <input class="btn btn-success" type="submit"value="Envoi du pdf"/>
</form>-->

 
                </select>