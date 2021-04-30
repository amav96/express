<?php


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
        $remito = new Equipos();
        $remito->setIdentificacionCliente($_GET["cd"]);
        $datosCliente = $remito->getDataCustomerOnConsignment();
        $getCliente = $datosCliente->fetch_object();
        $this->SetFillColor(18,64,97);
        $this->Rect(0,255,220,50,'F');
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(255,255,255);
        $this->SetY(-20);
        $this->SetX(98);  
        $this->Write(15,$getCliente->numero_documento);
        $this->Write(15,'.'.$getCliente->id_user);
    }
}

$fpdf = new pdf('P','mm','letter',true);
$fpdf->AddPage('portrait', 'letter');
$fpdf->SetMargins(10,30,20,40);
$fpdf->SetFont('Arial','B',8);
$fpdf->SetTextColor(255,255,255);

$fpdf->Image('estilos/imagenes/logo/logo.png',2,0.1, 25);
$fpdf->Image('estilos/imagenes/empresas/qr1.png',190,1.7,25,20);
   
//--------------------------------------------PLANTILLA 
                  
                        $fpdf->SetY(28);
                        $fpdf->SetX(40);
                        $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
                        $fpdf->Ln();
                        $fpdf->Image('estilos/imagenes/logo/logo.png',90,30,40,28);
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
                        $fpdf->Cell(100,9,utf8_decode($getCliente->nombre),1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
                        $fpdf->SetX(170.5);
                        $fpdf->Cell(35.6,9,utf8_decode($getCliente->created_at),1,0,'C',1);
                        $fpdf->SetY(75);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'IDENTIFICACION:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(100,9,utf8_decode($getCliente->numero_documento),1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
                        $fpdf->SetX(170.5);
                        $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
                        $fpdf->SetY(84.5);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(100,9,utf8_decode($getCliente->telefono),1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
                        $fpdf->SetX(170.5);
                        $fpdf->Cell(35.6,9,utf8_decode($getCliente->codigo_postal),1,0,'C',1);
                        $fpdf->SetY(94);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'LOCALIDAD:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(100,9,utf8_decode($getCliente->localidad),1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
                        $fpdf->SetX(170.5);
                        $fpdf->SetFont('Arial','B',7);
                        $fpdf->Cell(35.6,9,utf8_decode($getCliente->provincia),1,0,'C',1);
                        $fpdf->SetFont('Arial','B',9);
                        $fpdf->SetY(103.5);
                         $fpdf->SetX(10);
                         $fpdf->Cell(30,9,'DIRECCION:',1,0,'C',1);
                         $fpdf->SetX(40);
                         $fpdf->Cell(166.3,9,utf8_encode($getCliente->direccion),1,0,'C',1);

                        
                        
                        
                        $fpdf->SetY(114);
                        $fpdf->SetX(10);
                        $fpdf->SetTextColor(255,255,255);
                        $fpdf->SetFillColor(79,78,77);
                        $fpdf->Cell(196,5,utf8_encode(' DATOS DEL EQUIPO / TERMINAL / A CONSIGNACIÓN DE EMPRESA : '.utf8_decode($getCliente->empresa) ),0,0,'C',1);
                        
                        
                        $fpdf->SetY(125);
                        $fpdf->SetX(55);
                        $fpdf->SetTextColor(255,255,255);
                        $fpdf->SetFillColor(79,78,77);
                        $fpdf->Cell(33,10,'Terminal',0,0,'C',1);
                        $fpdf->Cell(40,10,'Serie',0,0,'C',1);
                        $fpdf->Cell(35,10,'Modelo',0,0,'C',1);
                        
                        
                        
                        $fpdf->Ln();
                        
                        $fpdf->SetLineWidth(1);
                        $fpdf->SetTextColor(0,0,0);
                        $fpdf->SetFillColor(255,255,255);
                        $fpdf->SetDrawColor(80,80,80);
                        $total= 0;

                                         foreach($datosEquipo as $detail)
                                         {

                                            
                                             $fpdf->SetX(55);
                                              $fpdf->Cell(36,10,$detail["terminal"],'B',0,'C',1);
                                              $fpdf->Cell(35,10,$detail["serie"],'B',0,'C',1);
                                              $fpdf->Cell(36,10,$detail["modelo"],'B',0,'C',1);
                                        
                                            
                                              $fpdf->Ln();
                                         }

  $fpdf->Output('I','Remitos.pdf');
  $fpdf->Output('F','Remitos.pdf');


?>




 