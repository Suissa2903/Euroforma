<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<form action="index.php?uc=CRformateurs&action=Heuresenseignement" " 
      method="post" role="form">

    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th class="Formateur"style="border-bottom: 1px solid #ff6f02; border-right:1px solid #ff6f02; " >Formateur</th>
                <th class="Matière" style="border-bottom: 1px solid #ff6f02;border-right:1px solid #ff6f02;">Matière(s)</th>  
                <th class="Heure" style="border-bottom: 1px solid #ff6f02; border-right:1px solid #ff6f02;">Heure(s)</th>  

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($matiereFormateur as $uneMatiere) {

        $dureematiere = $pdo->getdureematiere($uneMatiere['matiere']);
        
       
                ?>  
            <tr >
                <td style="border-right:1px solid #660033;"><input type="text" name="Formateur" id="Formateur" size="10" value="<?php echo $formateur ?>" class="form-control"/></td>
                <td style="border-right:1px solid #660033;"><input type="text" name="Matière" id="Matière" size="10" value="<?php echo $uneMatiere['matiere'] ?>" class="form-control"/></td>
                <td style="border-right:1px solid #660033;"><input type="text" name="Heure" id="Heure" size="10" value="<?php echo $dureematiere[0] ?>" class="form-control"/></td>
            </tr>
            
        <?php } ?> 
            <tr>
                <td style="border-right:1px solid #660033;"></td>
                <td style="border-right:1px solid #660033;"><input type="text" name="Matière" id="Matière" size="10" value="<?php echo" HEURE(S) TOTALE(S) "?>" class="form-control"/></td>
                <td style="border-right:1px solid #660033;"><input type="text" name="Heure" id="Heure" size="10" value="<?php echo $heuresformateur[0]  ?>" class="form-control"/></td>
            </tr>
           </tbody>
    </table>













