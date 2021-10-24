<?php
// Appel de la librairie FPDF
require("fpdf.php");
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('images/logo.png',60,6,90);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    $this->SetLineWidth(0.3);
    // Line break
    $this->Ln(5); 
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial');
    $this->SetFontSize('10');
    // Page number
    $this->Cell(0,10,'149 rue St Maur, 75011 Paris - euroforma.contact@gmail.com - 06 32 05 83 34',0,0,'C');
}
}
           
$buffer = ob_get_clean(); 
        $pdf = new PDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Header();
        $pdf->Cell(5,50,'Le CFA EUROFORMA située au 145 rue St Maur, 75011 Paris, certifie que :' );
        $pdf->SetFont('Arial');
        $pdf->SetFontSize('12');
        $pdf->Cell(0.1,70,'Mme '.$prenom." ".$nom);
        $pdf->Cell(0.1,90,'Née le '.$Datedenaissance);
        $pdf->Cell(0.1,130,'Demeurant'.$Adresse);
        $pdf->Cell(0.1,150,'Salariée de l entreprise'.$Societe);
        $pdf->Cell(0.1,170,'A suivi l action de formation de comptabilité'); 
        $pdf->Cell(0.1,200,'du 01'.(date("m/Y")).'au 31'.(date("m/Y"))); 
        $pdf->Cell(0.1,230,'Nombre de séances total : '.$NBSeancetotal); 
        $pdf->Cell(0.1,260,'Nombre de séances suivi par le/la stagiaire:'.$NBPresences); 
        $pdf->Cell(0.1,300,'Soit une durée de:'.$Heurespresence.'heures'); 
        $pdf->Cell(0.1,330,'Et un taux de réalisation de' .ceil( $Pourcentageabs). '%.'); 
        $pdf->Cell(0.1,330,'Fait à Paris le,' .ceil( $Pourcentageabs). '%.'); 
        
       
        $nom="compte_rendu";
        //$pdf->Output($nom,'I');
        for($i=1;$i<=2;$i++)
	{
	    if($i==1)
	    {
		//sortie du fichier
		$pdf->Output('C:\wamp64\www\Euroforma\tests\pdf_sauvegardé\ '.$nom.'.pdf','F');
	    }
	    else
	    {
		//sortie du fichier
		$pdf->output($nom,'I');
	    }

        }

       ?>
         



