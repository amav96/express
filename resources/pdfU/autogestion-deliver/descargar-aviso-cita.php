<?php 

require('../../fpdf/fpdf.php');
require('../../../model/deliver/MDatos-cliente-aviso-descarga.php');

$persona = new PersonaCliente();

class pdf extends FPDF
{

    public function header()
    {
        
        $this->SetFillColor(18,64,97); 
        $this->Rect(0,0,220,24,'F');
        $this->SetY(25);
        $this->SetFont('Arial','B',45);
        $this->SetTextColor(255,255,255);
        
        
    }
    
    public function footer()
    {
         
        
        // $this->SetFillColor(79,199,255);
        // $this->Rect(0,230,220,35,'F');
        $persona = new PersonaCliente();
        $this->SetFillColor(18,64,97);
        $this->Rect(0,255,220,50,'F');
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(255,255,255);
        $this->SetY(-20);
        $this->SetX(80);
        $this->Write(15,$persona->identificacion);
        $this->Write(15,'hola');
       
    }

    
}

// instanciar la clase 



$fpdf = new pdf('P','mm','letter',true);
$fpdf->AddPage('portrait', 'letter');
$fpdf->SetMargins(10,30,20,40);
$fpdf->SetFont('Arial','B',8);
$fpdf->SetTextColor(255,255,255);

// $fpdf->Image('../images/logo.png',2,0.1, 25);
// $fpdf->Image('../images/empresas/qr1.png',190,1.7,25,20);

$fpdf->SetY(28);
                        $fpdf->SetX(40);
                        $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
                        $fpdf->Ln();
                        // $fpdf->Image('../images/empresas/directv.png',50,30);
                        $fpdf->SetTextColor(0,0,0);

                        $fpdf->SetY(60);
                        $fpdf->SetX(10);
                        $fpdf->SetTextColor(255,255,255);
                        $fpdf->SetFillColor(79,78,77);
                        $fpdf->Cell(196,5,'DATOS DEL CLIENTE',0,0,'C',1);
                        
                        $fpdf->SetLineWidth(0.2);
                        $fpdf->SetFillColor(240,240,240);
                        $fpdf->SetTextColor(40,40,40);
                        $fpdf->SetDrawColor(255,255,255);
                        
                        
                        $fpdf->SetY(65.5);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'NOMBRE:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(100,9,$persona->nombreCliente,1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
                        $fpdf->SetX(170.5);
                        $fpdf->Cell(35.6,9,$persona->horaRecogida,1,0,'C',1);
                        $fpdf->SetY(75);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'IDENTIFICACION:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(100,9,'hola',1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
                        $fpdf->SetX(170.5);
                        $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
                        $fpdf->SetY(84.5);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(100,9,'hola',1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
                        $fpdf->SetX(170.5);
                        $fpdf->Cell(35.6,9,'hola',1,0,'C',1);
                        $fpdf->SetY(94);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'LOCALIDAD:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(100,9,'hola',1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
                        $fpdf->SetX(170.5);
                        $fpdf->Cell(35.6,9,'hola',1,0,'C',1);
                        $fpdf->SetY(103.5);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'DIRECCION:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(166.3,9,'DIRECCION:',1,0,'C',1);
                        
                        
                        $fpdf->SetY(114);
                        $fpdf->SetX(10);
                        $fpdf->SetTextColor(255,255,255);
                        $fpdf->SetFillColor(79,78,77);
                        $fpdf->Cell(196,5,' DATOS DEL EQUIPO / TERMINAL / COMPONENTES - RETIRADOS',0,0,'C',1);
                        
                        
                        $fpdf->SetY(119.6);
                        $fpdf->SetTextColor(255,255,255);
                        $fpdf->SetFillColor(79,78,77);
                        $fpdf->Cell(33,10,'Serie',0,0,'C',1);
                        $fpdf->Cell(40,10,'Tarjeta',0,0,'C',1);
                        $fpdf->Cell(30,10,'equipo',0,0,'C',1);
                        $fpdf->Cell(25,10,'cable hdmi',0,0,'C',1);
                        $fpdf->Cell(13,10,'cable av',0,0,'C',1);
                        $fpdf->Cell(20,10,'fuente',0,0,'C',1);
                        $fpdf->Cell(20,10,'control',0,0,'C',1);
                        $fpdf->Cell(15,10,'Otros',0,0,'C',1);
                        
                        $fpdf->Ln();
                        
                        $fpdf->SetLineWidth(1);
                        $fpdf->SetTextColor(0,0,0);
                        $fpdf->SetFillColor(255,255,255);
                        $fpdf->SetDrawColor(80,80,80);
                        $total= 0;
                                                                        
                     $info=$persona->fechaE.$persona->identificacion.".pdf";
                     $fpdf->Output("F","../../../resources/comprobante-visita"."$info");

                    // $fpdf->Output("pdf.pdf","I");
                  
                   