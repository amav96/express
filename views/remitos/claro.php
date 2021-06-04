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
        $remito ->setOrden($_GET["cd"]);
        $cliente = $remito->obtainCustomerDataToIssueInvoice();
        $getCliente= $cliente->fetch_object();

        $this->SetFillColor(18,64,97);
        $this->Rect(0,255,220,50,'F');
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(255,255,255);
        $this->SetY(-20);
        $this->SetX(80);
        $this->Write(15,$getCliente->id_orden_pass.'.');
        $this->Write(15,$getCliente->id_user);
    
    }
}

                     $fpdf = new pdf('P','mm','letter',true);
                     $fpdf->AddPage('portrait', 'letter');
                     $fpdf->SetMargins(10,30,20,40);
                     $fpdf->SetFont('Arial','B',8);
                     $fpdf->SetTextColor(255,255,255);

                     $fpdf->Image('estilos/imagenes/logo.png',2,0.1, 25);
                     $fpdf->Image('estilos/imagenes/empresas/qr1.png',190,1.7,25,20);

                     $fpdf->SetY(28);
                     $fpdf->SetX(40);
                     $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
                     $fpdf->Ln();
                     $fpdf->Image('estilos/imagenes/empresas/claro.png',50,25);
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
                     $fpdf->Cell(100,9,utf8_decode($getCliente->identificacion),1,0,'C',1);
                     $fpdf->SetX(140.3);
                     $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
                     $fpdf->SetX(170.5);
                     $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
                     $fpdf->SetY(84.5);
                     $fpdf->SetX(10);
                     $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
                     $fpdf->SetX(40);
                     $fpdf->Cell(100,9,utf8_decode($getCliente->telefono1),1,0,'C',1);
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
                    
                     $fpdf->Cell(166.3,9,utf8_decode($getCliente->direccion),1,0,'C',1);


                    
                     $fpdf->SetY(114);
                     $fpdf->SetX(10);
                     $fpdf->SetTextColor(255,255,255);
                     $fpdf->SetFillColor(79,78,77);
                     $fpdf->Cell(196,5,' DATOS DEL EQUIPO / TERMINAL / COMPONENTES - RETIRADOS',0,0,'C',1);


                    
                        $fpdf->SetLineWidth(1);
                        $fpdf->SetTextColor(40,40,40);
                        $fpdf->SetFillColor(255,255,255);
                        $fpdf->SetDrawColor(80,80,80);
                        $fpdf->SetFont('Arial','B',7);

                        $firma = $remito->getSignatureData();
                        $datosfirma = $firma->fetch_object();

                        if(is_object($datosfirma)){
                            $path = 'resources/firmas/'.$datosfirma->created_at.$datosfirma->orden_general.'.png';
                        
                            if(file_exists($path)){
                                
                                $fpdf->Image('resources/firmas/'.$datosfirma->created_at.$datosfirma->orden_general.'.png',46,205,40,32);
                                $fpdf->SetDrawColor(255,255,255);
                                $fpdf->SetFont('Arial','B',7);
                                $fpdf->SetY(230);
                                $fpdf->SetX(76);
                                $fpdf->Cell(58,9,utf8_decode($datosfirma->aclaracion),1,0,'C',1);
                                $fpdf->Cell(38,9,utf8_decode($datosfirma->documento),1,0,'C',1);
                            }else{
                                $fpdf->Image('estilos/imagenes/empresas/firmadefect.png',46,172.5,40,32);
                            $fpdf->SetDrawColor(255,255,255);
                            $fpdf->SetFont('Arial','B',7);
                            $fpdf->SetY(230);
                            $fpdf->SetX(76);
                            $fpdf->Cell(58,9,utf8_decode('No disponible'),1,0,'C',1);
                            $fpdf->Cell(38,9,utf8_decode($getCliente->identificacion),1,0,'C',1);
                            }
                        }else{

                            $fpdf->Image('estilos/imagenes/empresas/firmadefect.png',46,172.5,40,32);
                            $fpdf->SetDrawColor(255,255,255);
                            $fpdf->SetFont('Arial','B',7);
                            $fpdf->SetY(230);
                            $fpdf->SetX(76);
                            $fpdf->Cell(58,9,utf8_decode('No disponible'),1,0,'C',1);
                            $fpdf->Cell(38,9,utf8_decode($getCliente->identificacion),1,0,'C',1);
                        }

                        $fpdf->SetLineWidth(0.5);
                        $fpdf->SetTextColor(40,40,40);
                        $fpdf->SetFillColor(255,255,255);
                        $fpdf->SetDrawColor(80,80,80);
                        $fpdf->SetFont('Arial','B',7);

                        $fpdf->SetY(240);
                        $fpdf->SetX(35);
                        $fpdf->Cell(46,7,'Firma',1,0,'C',1);
                        $fpdf->Cell(46,7,'Aclaracion',1,0,'C',1);
                        $fpdf->Cell(46,7,'Dni',1,0,'C',1);



                    
                     $fpdf->SetY(119.6);
                     $fpdf->SetTextColor(255,255,255);
                     $fpdf->SetFillColor(79,78,77);
                     $fpdf->Cell(33,10,'Mac',0,0,'C',1);
                     $fpdf->Cell(40,10,'Cable red',0,0,'C',1);
                     $fpdf->Cell(30,10,'equipo',0,0,'C',1);
                     $fpdf->Cell(25,10,'cable hdmi',0,0,'C',1);
                     $fpdf->Cell(13,10,'cable av',0,0,'C',1);
                     $fpdf->Cell(20,10,'fuente',0,0,'C',1);
                     $fpdf->Cell(20,10,'control',0,0,'C',1);
                     $fpdf->Cell(15,10,'Tipo',0,0,'C',1);
                    
                     $fpdf->Ln();
                    
                     $fpdf->SetLineWidth(1);
                     $fpdf->SetTextColor(0,0,0);
                     $fpdf->SetFillColor(255,255,255);
                     $fpdf->SetDrawColor(80,80,80);
                     $total= 0;

                     
                    
                                  foreach($equipo as $detail)

{
                                        $fpdf->Cell(36,10,utf8_decode($detail["serie"]),'B',0,'C',1);
                                        $fpdf->Cell(35,10, utf8_decode($detail["tarjeta"]),'B',0,'C',1);
                                        ($detail["estado"] === 'RECUPERADO')
                                        ? $fpdf->Cell(36,10, utf8_decode($detail["equipo"]),'B',0,'C',1)
                                        : $fpdf->Cell(36,10, 'A VERIFICAR','B',0,'C',1);
                                        
                                        $fpdf->Cell(18,10,$detail["accesorio_uno"],'B',0,'C',1);
                                        $fpdf->Cell(18,10,$detail["accesorio_dos"],'B',0,'C',1);
                                        $fpdf->Cell(18,10,$detail["accesorio_tres"],'B',0,'C',1);
                                        $fpdf->Cell(18,10,$detail["accesorio_cuatro"],'B',0,'C',1);
                                        ($detail["estado"] === 'RECUPERADO')
                                        ? $fpdf->Cell(16.9,10,'B','B',0,'C',1)
                                        : $fpdf->Cell(16.9,10,'A','B',0,'C',1);
                                        $fpdf->Ln();
                                        if($detail["accesorios"] !== ''){
                                            $fpdf->Cell(196,8,'Observacion: '.' '.utf8_decode($detail["accesorios"]),'B',0,'C',0);
                                            $fpdf->Ln();
                                        }
                                       
                                        $fpdf->SetAutoPageBreak(10,80);
                                  }

                      $fpdf->Output('I','Remitos.pdf');
                      $fpdf->Output('F','Remitos.pdf');