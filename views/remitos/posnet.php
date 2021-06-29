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

        
        //abajo de los datos----------------
        $this->SetLineWidth(1);
        $this->SetTextColor(40,40,40);
        $this->SetFillColor(255,255,255);
        $this->SetDrawColor(80,80,80);
        $this->SetFont('Arial','B',7);

        $firma = $remito->getSignatureData();
        $datosfirma = $firma->fetch_object();

        if(is_object($datosfirma)){
            $path = 'resources/firmas/'.$datosfirma->created_at.$datosfirma->orden_general.'.png';
        
            if(file_exists($path)){
                
            $this->Image('resources/firmas/'.$datosfirma->created_at.$datosfirma->orden_general.'.png',46,172.5,40,32);
            $this->SetDrawColor(255,255,255);
            $this->SetFont('Arial','B',7);
            $this->SetY(194);
            $this->SetX(90);
            $this->Cell(58,9,utf8_decode($datosfirma->aclaracion),1,0,'C',1);
            $this->Cell(38,9,utf8_decode($datosfirma->documento),1,0,'C',1);
            }else{
            $this->Image('estilos/imagenes/empresas/firmadefect.png',46,172.5,40,32);
            $this->SetDrawColor(255,255,255);
            $this->SetFont('Arial','B',7);
            $this->SetY(194);
            $this->SetX(90);
            $this->Cell(58,9,utf8_decode('No quiso firmar'),1,0,'C',1);
            $this->Cell(38,9,utf8_decode($getCliente->identificacion),1,0,'C',1);
            }
        }else{

            $this->Image('estilos/imagenes/empresas/firmadefect.png',46,172.5,40,32);
            $this->SetDrawColor(255,255,255);
            $this->SetFont('Arial','B',7);
            $this->SetY(194);
            $this->SetX(90);
            $this->Cell(58,9,utf8_decode('No quiso firmar'),1,0,'C',1);
            $this->Cell(38,9,utf8_decode($getCliente->identificacion),1,0,'C',1);
        }

            $this->SetLineWidth(0.5);
            $this->SetTextColor(40,40,40);
            $this->SetFillColor(255,255,255);
            $this->SetDrawColor(80,80,80);
            $this->SetFont('Arial','B',7);

            $this->SetY(204);
            $this->SetX(50);
            $this->Cell(46,7,'Firma',1,0,'C',1);
            $this->Cell(46,7,'Aclaracion',1,0,'C',1);
            $this->Cell(46,7,'Dni',1,0,'C',1);



            $this->SetY(212);

            $this->Cell(196,5,'Entregamos a Posnet S.R.L y esta recibe el equipamiento cuyos datos figuran en el presente informe, a revisar y sin prestar conformidad  respecto de su estado y fun-',0,0,'C',1);
            $this->Ln();
            $this->Cell(196,5,'cionamiento. Si Posnet S.R.L   determinara la existencia de componentes danados y/o faltantes nos obligamos a continuar abonando el servicio hasta su devolucion   ',0,0,'C',1);
            $this->Ln();
            $this->Cell(196,5,'y/o reparacion o bien hasta el efectivo pago de los cargos correspondientes. Dejamos constancia asimismo de la inexistencia de operaciones cargadas en el equipa-  ',0,0,'C',1);
            $this->Ln();
            $this->Cell(196,5,'pendientes de cierre de lote.                                                                                                                                                                                                                                             ',0,0,'C',1);
            $this->Ln();
            $this->Cell(196,5,'                                                                                                                                                 ',0,0,'C',1);

            $this->SetTextColor(255,255,255);
            $this->SetFillColor(79,199,255);
            $this->SetFont('Arial','B',10);
            $this->SetY(232);
            $this->SetX(10);
            $this->SetTextColor(255,255,255);
            $this->SetFillColor(79,199,255);
            $this->Cell(196,5,'RECOLECTOR                                                                         ENTREGA Nro '.$getCliente->orden,0,0,'C',1);
            $this->SetX(40);
            $this->SetLineWidth(0.2);
            $this->SetFillColor(240,240,240);
            $this->SetTextColor(40,40,40);
            $this->SetDrawColor(255,255,255);
            $this->SetY(240);
            $this->SetX(10);
            $this->Cell(31,9,'Retira:',1,0,'C',1);
            $this->SetX(37);
            $this->Cell(69.5,9,utf8_decode($getCliente->id_user),1,0,'C',1);
            $this->SetX(106.5);
            $this->Cell(30,9,'Fecha Emision:',1,0,'C',1);
            $this->SetX(137);
            $this->Cell(70,9,date('d/m/Y'),1,0,'C',1);

        

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

$datosfirma = $firma->fetch_object();

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
 $fpdf->Image('estilos/imagenes/empresas/posnetclover1.jpg',10,26);


$fpdf->SetTextColor(0,0,0);
$fpdf->SetFont('Arial','B',25);
$fpdf->SetY(38);
$fpdf->SetX(90);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->Cell(29,12,'BAJA',0,0,'C',1);

$fpdf->SetTextColor(79,199,255);
$fpdf->SetFont('Arial','B',19);
$fpdf->SetY(39);
$fpdf->SetX(130);
$fpdf->SetTextColor(79,199,255);

$fpdf->Write(10,'INFORME TECNICO');



$fpdf->SetFont('Arial','B',10);
$fpdf->SetY(60);
$fpdf->SetX(10);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->Cell(196,5,'DATOS DEL CLIENTE',0,0,'C',1);

$fpdf->SetLineWidth(0.2);
$fpdf->SetFillColor(240,240,240);
$fpdf->SetTextColor(40,40,40);
$fpdf->SetDrawColor(255,255,255);
$fpdf->SetFont('Arial','B',9);
$fpdf->SetY(65.5);
$fpdf->SetX(10);
$fpdf->Cell(36,9,'NOMBRE FANTASIA:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(100.5,9,utf8_decode($getCliente->nombre),1,0,'C',1);
$fpdf->SetX(140.3);
$fpdf->Cell(30,9,'CUIT:',1,0,'C',1);
$fpdf->SetX(170.5);
$fpdf->Cell(35.6,9,utf8_decode($getCliente->identificacion),1,0,'C',1);

$fpdf->SetY(75);
$fpdf->SetX(10);
$fpdf->Cell(36.5,9,'TELEFONO:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(100.5,9,utf8_decode($getCliente->telefono1),1,0,'C',1);
$fpdf->SetX(140.3);
$fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
$fpdf->SetX(170.5);
$fpdf->Cell(35.6,9,utf8_decode($getCliente->codigo_postal),1,0,'C',1);
$fpdf->SetY(84.5);
$fpdf->SetX(10);
$fpdf->Cell(36.5,9,'LOCALIDAD:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(100.5,9,utf8_decode($getCliente->localidad),1,0,'C',1);
$fpdf->SetX(140.3);
$fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
$fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',7);
$fpdf->Cell(35.6,9,utf8_decode($getCliente->provincia),1,0,'C',1);
$fpdf->SetFont('Arial','B',9);
$fpdf->SetY(94);
$fpdf->SetX(10);
$fpdf->Cell(36.5,9,utf8_decode('DIRECCION:'),1,0,'C',1);
$fpdf->SetX(40);

$fpdf->SetFont('Arial','B',7);
$fpdf->Cell(100.5,9,utf8_decode($getCliente->direccion),1,0,'C',1);
$fpdf->SetFont('Arial','B',9);
$fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
// fecha entrega
$date = date_create($equipo->fetch_object()->created_at);
$date_format =  date_format($date,"d/m/Y H:i:s");

$fpdf->Cell(35,9,utf8_decode($date_format),1,0,'C',1);
$fpdf->SetY(103);
$fpdf->SetX(10);


$fpdf->Cell(36.5,9,'EMAIL:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(100.5,9,utf8_decode($getCliente->email),1,0,'C',1);

$fpdf->SetX(140.3);
$fpdf->Cell(30,9,'MOTIVO:',1,0,'C',1);
$fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',6);
$fpdf->Cell(35.6,9,utf8_decode($getCliente->motivo),1,0,'C',1);
$fpdf->SetFont('Arial','B',9);
$fpdf->SetFont('Arial','B',10);
$fpdf->SetY(113.5);
$fpdf->SetX(10);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->Cell(196,5,' DATOS DEL EQUIPO / TERMINAL / COMPONENTES - RETIRADOS',0,0,'C',1);


//aca termina ---------------------------
$fpdf->SetFont('Arial','B',8.5);
$fpdf->SetY(120);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->Cell(32,10,'Serie',0,0,'C',1);
$fpdf->Cell(51,10,'Material',0,0,'C',1);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,80,80);
$fpdf->Cell(22,10,'Descripcion',0,0,'C',1);

$fpdf->Cell(34,10,'Terminal',0,0,'C',1);
$fpdf->SetFont('Arial','B',7);
$fpdf->Cell(20,10,'C. telefonico',0,0,'C',1);
$fpdf->Cell(19,10,'C. cargador',0,0,'C',1);
$fpdf->Cell(18,10,'Base',0,0,'C',1);

$fpdf->SetFont('Arial','B',7.5);
$fpdf->Ln(10);

$fpdf->SetTextColor(0,0,0);
$fpdf->SetFillColor(255,255,255);
$fpdf->SetDrawColor(80,80,80);
$total= 0;

            foreach($equipo as $detail)
            {
               
                $fpdf->SetX(10.5);
                 $fpdf->Cell(29,6,utf8_decode($detail["terminal"]),'B',0,'C',1);
                 $fpdf->SetFont('Arial','B',5.5);
               
                 ($detail["estado"] === 'RECUPERADO')
                 ?$fpdf->Cell(52.5,6,utf8_encode($detail["equipo"]),'B',0,'C',1)
                 :$fpdf->Cell(52.5,6,'A VERIFICAR','B',0,'C',1);
                 
                 $fpdf->SetFont('Arial','B',7);
               
               
                  $fpdf->SetX(93);
                 $fpdf->Cell(22,6,'Dispositivo','B',0,'C',1);
                 $fpdf->Cell(36,6,utf8_decode($detail["serie"]),'B',0,'C',1);
                 $fpdf->SetFont('Arial','B',7);
                 $fpdf->Cell(18.5,6,$detail["accesorio_uno"],'B',0,'C',1);
                 $fpdf->Cell(19.5,6,$detail["accesorio_tres"],'B',0,'C',1);
                 $fpdf->Cell(17,6,$detail["accesorio_cuatro"],'B',0,'C',1);
                 
                 $fpdf->Ln(6.5);
                 
                 $fpdf->Cell(29,6,'Tipo','B',0,'C',1);
                 $fpdf->Cell(53,6,$detail["tipo"],'B',0,'C',1);
                 $fpdf->SetX(93);
                  $fpdf->Cell(22,6,'Nro Sim','B',0,'C',1);
                  $fpdf->Cell(36,6,$detail["tarjeta"],'B',0,'C',1);
                
                
                  $fpdf->Cell(22,6,'Sim alt','B',0,'C',1);
                  $fpdf->Cell(33,6,utf8_decode($detail["sim_alternativo"]),'B',0,'C',1);
                 
                 $fpdf->Ln(6.5);
                 $fpdf->SetX(93);
                 $fpdf->Cell(22,6,'Serie Base','B',0,'C',1);
                 $fpdf->Cell(36,6,$detail["serie_base"],'B',0,'C',1);
                 $fpdf->Cell(22,6,'Tipo Rec','B',0,'C',1);
                 ($detail["estado"] === 'RECUPERADO')
                 ?$fpdf->Cell(33,6,'B','B',0,'C',1)
                 :$fpdf->Cell(33,6,'A','B',0,'C',1) ; 
                 $fpdf->Ln();
                if($detail["accesorios"] !== ''){
                    $fpdf->Cell(196,8,'Observacion: '.' '.utf8_decode($detail["accesorios"]),'B',0,'C',0);
                    $fpdf->Ln();
                }
                 $fpdf->SetTextColor(255,255,255);
                 $fpdf->SetFillColor(80,80,80);
                 $fpdf->Cell(196,1,'',0,0,'C',1);
                 $fpdf->Ln();


                $fpdf->SetTextColor(0,0,0);
                $fpdf->SetFillColor(255,255,255);
                $fpdf->SetDrawColor(80,80,80);
                
                $fpdf->Ln();
                $fpdf->SetAutoPageBreak(10,120);
            }

                        $fpdf->Output('I','Remitos.pdf');
                        
                        $fpdf->Output('F','Remitos.pdf');