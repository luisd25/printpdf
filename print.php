<?php
    require_once('fpdf\fpdf.php');
    require_once('conn.php');
   //$conn = new connect('clientes');  

class PDF extends FPDF
{
   public $data;
    // Cabecera de p�gina
    function Header()
    {  
        // Logo
        //$this->Image('logo_pb.png',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Movernos a la derecha
        $this->Cell(80);
        // T�tulo
        $this->Cell(50,10,'Carta de Intimacion',1,0,'C');
        // Salto de l�nea
        $this->Ln(20);
    }

    // Pie de p�gina
    function Footer()
    {
        // Posici�n: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // N�mero de p�gina
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
 
     
  }


// Creaci�n del objeto de la clase heredada
$pdf = new PDF();
$conn = new connect();

$values=$conn->select('intimaciones');
//echo $values["nombre"][0];
//echo $values["status"][0];

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

//for($i=1;$i<=20;$i++)
	//$pdf->Cell(0,10,'Imprimiendo l�nea n�mero '.$i,0,1);
$lengthx = max( array_map( 'count',  $values ) );

for($i=0;$i<$lengthx;$i++){
    $pdf->Cell(0,10,'por la presente se le informa a '.$values['nombre'][$i],0,1);
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
}
$pdf->Output();
?>
