<?php

require('../fpdf/fpdf.php');
require('../../model/pdf/model.php');



$cod_orden=$_GET['cod_orden'];
 
$model = new Datos();

$datosunicos = $model->DatosUnicos($cod_orden);
$datosclientes = $model->DatosCaptura($cod_orden);
$datosfirma = $model->DatosFirma($cod_orden);
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
         global $cod_orden;
         $data = new Datos();
        $datosunicos = $data->DatosUnicos($cod_orden);
        // $this->SetFillColor(79,199,255);
        // $this->Rect(0,230,220,35,'F');
      
        
        $this->SetFillColor(18,64,97);
        $this->Rect(0,255,220,50,'F');
        $this->SetFont('Arial','B',10);
        $this->SetTextColor(255,255,255);
        $this->SetY(-20);
        $this->SetX(80);
        $this->Write(15,$datosunicos->id_orden_pass);
        $this->Write(15,'.'.$datosunicos->id_recolector_2);
       
    }
}

$fpdf = new pdf('P','mm','letter',true);
$fpdf->AddPage('portrait', 'letter');
$fpdf->SetMargins(10,30,20,40);
$fpdf->SetFont('Arial','B',8);
$fpdf->SetTextColor(255,255,255);



$fpdf->Image('../../estilos/imagenes/logo.png',2,0.1, 25);
$fpdf->Image('../../estilos/imagenes/empresas/qr1.png',190,1.7,25,20);




if($datosunicos->identificacion){
                    $identificacioncomparar=$datosunicos->identificacion;
                    $directv='DT';
                    $antina='AN';
                    $antinap='AP';
                    $antinai='AI';
                    $lapos='LA';
                    $intv='IN';
                    $iplan='IP';
                    $iplandos='ip';
                    $iplantres = 'iP';
                    $iplancuatro = 'Ip'; 
                    $metrotel='MT';
                    $cablevision='CV';
                    $posnet='PS';
                     $supercanal='SC';
                     $movistar='MV';
//--------------------------------------------PLANTILLA DIRECTV----------------------------------------------------
                    $cadena=substr($identificacioncomparar,0,2);
                    if ($cadena==$directv){
                        $fpdf->SetY(28);
                        $fpdf->SetX(40);
                        $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
                        $fpdf->Ln();
                        $fpdf->Image('../../estilos/imagenes/empresas/directv.png',50,30);
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
                        $fpdf->Cell(100,9,$datosunicos->nombre_cliente,1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
                        $fpdf->SetX(170.5);
                        $fpdf->Cell(35.6,9,$datosunicos->horario_rec,1,0,'C',1);
                        $fpdf->SetY(75);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'IDENTIFICACION:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(100,9,$datosunicos->identificacion,1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
                        $fpdf->SetX(170.5);
                        $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
                        $fpdf->SetY(84.5);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(100,9,$datosunicos->telefono1,1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
                        $fpdf->SetX(170.5);
                        $fpdf->Cell(35.6,9,$datosunicos->codigo_postal,1,0,'C',1);
                        $fpdf->SetY(94);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'LOCALIDAD:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(100,9,$datosunicos->localidad,1,0,'C',1);
                        $fpdf->SetX(140.3);
                        $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
                        $fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',7);
                        $fpdf->Cell(35.6,9,$datosunicos->provincia,1,0,'C',1);
                        $fpdf->SetFont('Arial','B',9);
                        $fpdf->SetY(103.5);
                        $fpdf->SetX(10);
                        $fpdf->Cell(30,9,'DIRECCION:',1,0,'C',1);
                        $fpdf->SetX(40);
                        $fpdf->Cell(166.3,9,$datosunicos->direccion,1,0,'C',1);
                        
                        
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
                        
                                        foreach($datosclientes as $detail)
                                        {
                                            $fpdf->Cell(36,10,$detail->serie,'B',0,'C',1);
                                            $fpdf->Cell(35,10,$detail->tarjeta,'B',0,'C',1);
                                            $fpdf->Cell(36,10,$detail->equipo,'B',0,'C',1);
                                            $fpdf->Cell(18,10,$detail->cable_hdmi,'B',0,'C',1);
                                            $fpdf->Cell(18,10,$detail->cable_av,'B',0,'C',1);
                                            $fpdf->Cell(18,10,$detail->fuente,'B',0,'C',1);
                                            $fpdf->Cell(18,10,$detail->control_1,'B',0,'C',1);
                                            $fpdf->Cell(18,10,$detail->otrosaccesorios,'B',0,'C',1);
                                            $fpdf->Ln();
                                        }
                            
                        }
//--------------------------------------------END PLANTILLA DIRECTV----------------------------------------------------



//--------------------------------------------PLANTILLA ANTINA----------------------------------------------------
                if ($cadena==$antina || $cadena==$antinap || $cadena==$antinai ){
                    $fpdf->SetY(28);
                        $fpdf->SetX(40);
                        $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
                        $fpdf->Ln();
                    $fpdf->Image('../../estilos/imagenes/empresas/an5.png',50,30);
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
                    $fpdf->Cell(100,9,$datosunicos->nombre_cliente,1,0,'C',1);
                    $fpdf->SetX(140.3);
                    $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
                    $fpdf->SetX(170.5);
                    $fpdf->Cell(35.6,9,$datosunicos->horario_rec,1,0,'C',1);
                    $fpdf->SetY(75);
                    $fpdf->SetX(10);
                    $fpdf->Cell(30,9,'IDENTIFICACION:',1,0,'C',1);
                    $fpdf->SetX(40);
                    $fpdf->Cell(100,9,$datosunicos->identificacion,1,0,'C',1);
                    $fpdf->SetX(140.3);
                    $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
                    $fpdf->SetX(170.5);
                    $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
                    $fpdf->SetY(84.5);
                    $fpdf->SetX(10);
                    $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
                    $fpdf->SetX(40);
                    $fpdf->Cell(100,9,$datosunicos->telefono1,1,0,'C',1);
                    $fpdf->SetX(140.3);
                    $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
                    $fpdf->SetX(170.5);
                    $fpdf->Cell(35.6,9,$datosunicos->codigo_postal,1,0,'C',1);
                    $fpdf->SetY(94);
                    $fpdf->SetX(10);
                    $fpdf->Cell(30,9,'LOCALIDAD:',1,0,'C',1);
                    $fpdf->SetX(40);
                    $fpdf->Cell(100,9,$datosunicos->localidad,1,0,'C',1);
                    $fpdf->SetX(140.3);
                    $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
                    $fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',7);
                    $fpdf->Cell(35.6,9,$datosunicos->provincia,1,0,'C',1);
                    $fpdf->SetFont('Arial','B',9);
                    $fpdf->SetY(103.5);
                    $fpdf->SetX(10);
                    $fpdf->Cell(30,9,'DIRECCION:',1,0,'C',1);
                    $fpdf->SetX(40);
                    $fpdf->Cell(166.3,9,$datosunicos->direccion,1,0,'C',1);
                    
                    
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
                    
                                    foreach($datosclientes as $detail)
                                    {
                                        $fpdf->Cell(36,10,$detail->serie,'B',0,'C',1);
                                        $fpdf->Cell(35,10,$detail->tarjeta,'B',0,'C',1);
                                        $fpdf->Cell(36,10,$detail->equipo,'B',0,'C',1);
                                        $fpdf->Cell(18,10,$detail->cable_hdmi,'B',0,'C',1);
                                        $fpdf->Cell(18,10,$detail->cable_av,'B',0,'C',1);
                                        $fpdf->Cell(18,10,$detail->fuente,'B',0,'C',1);
                                        $fpdf->Cell(18,10,$detail->control_1,'B',0,'C',1);
                                        $fpdf->Cell(18,10,$detail->otrosaccesorios,'B',0,'C',1);
                                        $fpdf->Ln();
                                    }
                        
                    }
//--------------------------------------------END PLANTILLA ANTINA----------------------------------------------------




//--------------------------------------------PLANTILLA LAPOS----------------------------------------------------
if ($cadena==$lapos){
    $fpdf->SetY(28);
                        $fpdf->SetX(40);
                        $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
                        $fpdf->Ln();
    $fpdf->Image('../../estilos/imagenes/empresas/lapos1.png',50,30);
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
    $fpdf->Cell(100,9,$datosunicos->nombre_cliente,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->horario_rec,1,0,'C',1);
    $fpdf->SetY(75);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'IDENTIFICACION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->identificacion,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
    $fpdf->SetY(84.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->telefono1,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->codigo_postal,1,0,'C',1);
    $fpdf->SetY(94);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'LOCALIDAD:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->localidad,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
    $fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',7);
    $fpdf->Cell(35.6,9,$datosunicos->provincia,1,0,'C',1);
    $fpdf->SetFont('Arial','B',9);
    $fpdf->SetY(103.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'DIRECCION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(166.3,9,$datosunicos->direccion,1,0,'C',1);
    
    
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
    
                    foreach($datosclientes as $detail)
                    {
                        $fpdf->Cell(36,10,$detail->serie,'B',0,'C',1);
                        $fpdf->Cell(35,10,$detail->tarjeta,'B',0,'C',1);
                        $fpdf->Cell(36,10,$detail->equipo,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_hdmi,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_av,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->fuente,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->control_1,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->otrosaccesorios,'B',0,'C',1);
                        $fpdf->Ln();
                    }
        
    }

//--------------------------------------------END PLANTILLA LAPOS----------------------------------------------------


//--------------------------------------------PLANTILLA INTV----------------------------------------------------
if ($cadena==$intv){
    $fpdf->SetY(28);
                        $fpdf->SetX(40);
                        $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
                        $fpdf->Ln();
    $fpdf->Image('../../estilos/imagenes/empresas/intv1.jpg',50,30);
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
    $fpdf->Cell(100,9,$datosunicos->nombre_cliente,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->horario_rec,1,0,'C',1);
    $fpdf->SetY(75);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'IDENTIFICACION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->identificacion,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
    $fpdf->SetY(84.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->telefono1,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->codigo_postal,1,0,'C',1);
    $fpdf->SetY(94);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'LOCALIDAD:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->localidad,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
    $fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',7);
    $fpdf->Cell(35.6,9,$datosunicos->provincia,1,0,'C',1);
    $fpdf->SetFont('Arial','B',9);
    $fpdf->SetY(103.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'DIRECCION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(166.3,9,$datosunicos->direccion,1,0,'C',1);
    
    
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
    
                    foreach($datosclientes as $detail)
                    {
                        $fpdf->Cell(36,10,$detail->serie,'B',0,'C',1);
                        $fpdf->Cell(35,10,$detail->tarjeta,'B',0,'C',1);
                        $fpdf->Cell(36,10,$detail->equipo,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_hdmi,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_av,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->fuente,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->control_1,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->otrosaccesorios,'B',0,'C',1);
                        $fpdf->Ln();
                    }
        
    }
//--------------------------------------------END PLANTILLA INTV----------------------------------------------------



//--------------------------------------------PLANTILLA IPLAN----------------------------------------------------
$cadena=substr($identificacioncomparar,0,2);
if (($cadena===$iplan) || ($cadena===$iplandos) || ($cadena===$iplantres) || ($cadena===$iplancuatro) ){
    $fpdf->SetY(28);
                        $fpdf->SetX(40);
                        $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
                        $fpdf->Ln();
    $fpdf->Image('../../estilos/imagenes/empresas/iplan3.jpg',50,30);
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
    $fpdf->Cell(100,9,$datosunicos->nombre_cliente,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->horario_rec,1,0,'C',1);
    $fpdf->SetY(75);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'IDENTIFICACION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->identificacion,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
    $fpdf->SetY(84.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->telefono1,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->codigo_postal,1,0,'C',1);
    $fpdf->SetY(94);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'LOCALIDAD:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->localidad,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
    $fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',7);
    $fpdf->Cell(35.6,9,$datosunicos->provincia,1,0,'C',1);
    $fpdf->SetFont('Arial','B',9);
    $fpdf->SetY(103.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'DIRECCION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(166.3,9,$datosunicos->direccion,1,0,'C',1);
    
    
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
    
                    foreach($datosclientes as $detail)
                    {
                        $fpdf->Cell(36,10,$detail->serie,'B',0,'C',1);
                        $fpdf->Cell(35,10,$detail->tarjeta,'B',0,'C',1);
                        $fpdf->Cell(36,10,$detail->equipo,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_hdmi,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_av,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->fuente,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->control_1,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->otrosaccesorios,'B',0,'C',1);
                        $fpdf->Ln();
                    }
        
    }

//--------------------------------------------END PLANTILLA IPLAN----------------------------------------------------



//--------------------------------------------PLANTILLA METROTEL----------------------------------------------------
$cadena=substr($identificacioncomparar,0,2);
if ($cadena==$metrotel){
    $fpdf->SetY(28);
                        $fpdf->SetX(40);
                        $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
                        $fpdf->Ln();
    $fpdf->Image('../../estilos/imagenes/empresas/metrotel1.png',50,30);
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
    $fpdf->Cell(100,9,$datosunicos->nombre_cliente,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->horario_rec,1,0,'C',1);
    $fpdf->SetY(75);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'IDENTIFICACION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->identificacion,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
    $fpdf->SetY(84.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->telefono1,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->codigo_postal,1,0,'C',1);
    $fpdf->SetY(94);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'LOCALIDAD:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->localidad,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
    $fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',7);
    $fpdf->Cell(35.6,9,$datosunicos->provincia,1,0,'C',1);
    $fpdf->SetFont('Arial','B',9);
    $fpdf->SetY(103.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'DIRECCION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(166.3,9,$datosunicos->direccion,1,0,'C',1);
    
    
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
    
                    foreach($datosclientes as $detail)
                    {
                        $fpdf->Cell(36,10,$detail->serie,'B',0,'C',1);
                        $fpdf->Cell(35,10,$detail->tarjeta,'B',0,'C',1);
                        $fpdf->Cell(36,10,$detail->equipo,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_hdmi,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_av,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->fuente,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->control_1,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->otrosaccesorios,'B',0,'C',1);
                        $fpdf->Ln();
                    }
        
    }

//--------------------------------------------END PLANTILLA METROTEL----------------------------------------------------


//--------------------------------------------PLANTILLA CABLEVISION----------------------------------------------------
$cadena=substr($identificacioncomparar,0,2);
if ($cadena==$cablevision){
    $fpdf->SetY(28);
                        $fpdf->SetX(40);
                        $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro +598-22051878 / comercial@expressmetropolitana.com');
                        $fpdf->Ln();
    $fpdf->Image('../../estilos/imagenes/empresas/cablevision.png',50,30);
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
    $fpdf->Cell(100,9,$datosunicos->nombre_cliente,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->horario_rec,1,0,'C',1);
    $fpdf->SetY(75);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'IDENTIFICACION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->identificacion,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
    $fpdf->SetY(84.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->telefono1,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->codigo_postal,1,0,'C',1);
    $fpdf->SetY(94);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'LOCALIDAD:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->localidad,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
    $fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',7);
    $fpdf->Cell(35.6,9,$datosunicos->provincia,1,0,'C',1);
    $fpdf->SetFont('Arial','B',9);
    $fpdf->SetY(103.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'DIRECCION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(166.3,9,$datosunicos->direccion,1,0,'C',1);
    
    
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
    
                    foreach($datosclientes as $detail)
                    {
                        $fpdf->Cell(36,10,$detail->serie,'B',0,'C',1);
                        $fpdf->Cell(35,10,$detail->tarjeta,'B',0,'C',1);
                        $fpdf->Cell(36,10,$detail->equipo,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_hdmi,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_av,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->fuente,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->control_1,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->otrosaccesorios,'B',0,'C',1);
                        $fpdf->Ln();
                    }

                   
        
    }
//--------------------------------------------END PLANTILLA CABLEVISION----------------------------------------------------


//--------------------------------------------PLANTILLA SUPER----------------------------------------------------
$cadena=substr($identificacioncomparar,0,2);
if ($cadena==$supercanal){
    $fpdf->SetY(28);
                        $fpdf->SetX(40);
                        $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro +598-22051878 / comercial@expressmetropolitana.com');
                        $fpdf->Ln();
    $fpdf->Image('../../estilos/imagenes/empresas/supercanal.png',50,30);
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
    $fpdf->Cell(100,9,$datosunicos->nombre_cliente,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->horario_rec,1,0,'C',1);
    $fpdf->SetY(75);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'IDENTIFICACION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->identificacion,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
    $fpdf->SetY(84.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->telefono1,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
    $fpdf->SetX(170.5);
    $fpdf->Cell(35.6,9,$datosunicos->codigo_postal,1,0,'C',1);
    $fpdf->SetY(94);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'LOCALIDAD:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(100,9,$datosunicos->localidad,1,0,'C',1);
    $fpdf->SetX(140.3);
    $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
    $fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',7);
    $fpdf->Cell(35.6,9,$datosunicos->provincia,1,0,'C',1);
    $fpdf->SetFont('Arial','B',9);
    $fpdf->SetY(103.5);
    $fpdf->SetX(10);
    $fpdf->Cell(30,9,'DIRECCION:',1,0,'C',1);
    $fpdf->SetX(40);
    $fpdf->Cell(166.3,9,$datosunicos->direccion,1,0,'C',1);
    
    
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
    
                    foreach($datosclientes as $detail)
                    {
                        $fpdf->Cell(36,10,$detail->serie,'B',0,'C',1);
                        $fpdf->Cell(35,10,$detail->tarjeta,'B',0,'C',1);
                        $fpdf->Cell(36,10,$detail->equipo,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_hdmi,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->cable_av,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->fuente,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->control_1,'B',0,'C',1);
                        $fpdf->Cell(18,10,$detail->otrosaccesorios,'B',0,'C',1);
                        $fpdf->Ln();
                    }
        
    }
//--------------------------------------------END PLANTILLA SUPERCANAL----------------------------------------------------


//--------------------------------------------PLANTILLA POSNET----------------------------------------------------
$cadena=substr($identificacioncomparar,0,2);
if ($cadena==$posnet){
    $fpdf->SetY(28);
     $fpdf->SetX(40);
     $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
     $fpdf->Ln();
    $fpdf->Image('../../estilos/imagenes/empresas/posnetclover1.jpg',10,26);
    
    
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
$fpdf->Cell(100.5,9,$datosunicos->nombre_cliente,1,0,'C',1);
$fpdf->SetX(140.3);
$fpdf->Cell(30,9,'CUIT:',1,0,'C',1);
$fpdf->SetX(170.5);
$fpdf->Cell(35.6,9,$datosunicos->identificacion,1,0,'C',1);

$fpdf->SetY(75);
$fpdf->SetX(10);
$fpdf->Cell(36.5,9,'TELEFONO:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(100.5,9,$datosunicos->telefono1,1,0,'C',1);
$fpdf->SetX(140.3);
$fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
$fpdf->SetX(170.5);
$fpdf->Cell(35.6,9,$datosunicos->codigo_postal,1,0,'C',1);
$fpdf->SetY(84.5);
$fpdf->SetX(10);
$fpdf->Cell(36.5,9,'LOCALIDAD:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(100.5,9,$datosunicos->localidad,1,0,'C',1);
$fpdf->SetX(140.3);
$fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
$fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',7);
$fpdf->Cell(35.6,9,$datosunicos->provincia,1,0,'C',1);
$fpdf->SetFont('Arial','B',9);
$fpdf->SetY(94);
$fpdf->SetX(10);
$fpdf->Cell(36.5,9,'DIRECCION:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(160,9,$datosunicos->direccion,1,0,'C',1);
$fpdf->SetY(103);
$fpdf->SetX(10);







$fpdf->Cell(36.5,9,'EMAIL:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(100.5,9,$datosunicos->emailcliente,1,0,'C',1);

$fpdf->SetX(140.3);
$fpdf->Cell(30,9,'MOTIVO:',1,0,'C',1);
$fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',6);
$fpdf->Cell(35.6,9,$datosunicos->motivo_retiro,1,0,'C',1);
$fpdf->SetFont('Arial','B',9);
$fpdf->SetFont('Arial','B',10);
$fpdf->SetY(113.5);
$fpdf->SetX(10);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->Cell(196,5,' DATOS DEL EQUIPO / TERMINAL / COMPONENTES - RETIRADOS',0,0,'C',1);

//abajo de los datos----------------
$fpdf->SetLineWidth(1);
$fpdf->SetTextColor(40,40,40);
$fpdf->SetFillColor(255,255,255);
$fpdf->SetDrawColor(80,80,80);
$fpdf->SetFont('Arial','B',7);

$fpdf->Image('../firmas/'.$datosfirma->fecha_general.$datosfirma->orden_general.'.png',46,172.5,40,32);

$fpdf->SetDrawColor(255,255,255);
$fpdf->SetFont('Arial','B',7);

$fpdf->SetY(194);
$fpdf->SetX(90);

$fpdf->Cell(58,9,$datosfirma->aclaracion,1,0,'C',1);
$fpdf->Cell(38,9,$datosfirma->documento,1,0,'C',1);


$fpdf->SetLineWidth(0.5);
$fpdf->SetTextColor(40,40,40);
$fpdf->SetFillColor(255,255,255);
$fpdf->SetDrawColor(80,80,80);
$fpdf->SetFont('Arial','B',7);

$fpdf->SetY(204);
$fpdf->SetX(50);
$fpdf->Cell(46,7,'Firma',1,0,'C',1);
$fpdf->Cell(46,7,'Aclaracion',1,0,'C',1);
$fpdf->Cell(46,7,'Dni',1,0,'C',1);

$fpdf->SetY(212);

$fpdf->Cell(196,5,'Entregamos a Posnet S.R.L y esta recibe el equipamiento cuyos datos figuran en el presente informe, a revisar y sin prestar conformidad  respecto de su estado y fun-',0,0,'C',1);
$fpdf->Ln();
$fpdf->Cell(196,5,'cionamiento. Si Posnet S.R.L   determinara la existencia de componentes danados y/o faltantes nos obligamos a continuar abonando el servicio hasta su devolucion   ',0,0,'C',1);
$fpdf->Ln();
$fpdf->Cell(196,5,'y/o reparacion o bien hasta el efectivo pago de los cargos correspondientes. Dejamos constancia asimismo de la inexistencia de operaciones cargadas en el equipa-  ',0,0,'C',1);
$fpdf->Ln();
$fpdf->Cell(196,5,'pendientes de cierre de lote.                                                                                                                                                                                                                                             ',0,0,'C',1);
$fpdf->Ln();
$fpdf->Cell(196,5,'                                                                                                                                                 ',0,0,'C',1);

$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->SetFont('Arial','B',10);
$fpdf->SetY(232);
$fpdf->SetX(10);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->Cell(196,5,'RECOLECTOR                                                                         ENTREGA Nro '.$datosunicos->order_rec,0,0,'C',1);
$fpdf->SetX(40);
$fpdf->SetLineWidth(0.2);
$fpdf->SetFillColor(240,240,240);
$fpdf->SetTextColor(40,40,40);
$fpdf->SetDrawColor(255,255,255);
$fpdf->SetY(240);
$fpdf->SetX(10);
$fpdf->Cell(31,9,'Retira:',1,0,'C',1);
$fpdf->SetX(37);
$fpdf->Cell(69.5,9,$datosunicos->id_recolector_2,1,0,'C',1);
$fpdf->SetX(106.5);
$fpdf->Cell(30,9,'Fecha Emision:',1,0,'C',1);
$fpdf->SetX(137);
$fpdf->Cell(70,9,date('d/m/Y'),1,0,'C',1);


//aca termina ---------------------------
$fpdf->SetFont('Arial','B',8.5);
$fpdf->SetY(120);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->Cell(32,10,'Terminal',0,0,'C',1);
$fpdf->Cell(51,10,'Material',0,0,'C',1);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,80,80);
$fpdf->Cell(22,10,'Descripcion',0,0,'C',1);

 $fpdf->Cell(34,10,'Nro de serie',0,0,'C',1);
 $fpdf->SetFont('Arial','B',7);
 $fpdf->Cell(20,10,'C. telefonico',0,0,'C',1);
 $fpdf->Cell(19,10,'C. fuente',0,0,'C',1);
 $fpdf->Cell(18,10,'Base',0,0,'C',1);
 
 $fpdf->SetFont('Arial','B',7.5);
$fpdf->Ln(10);

$fpdf->SetTextColor(0,0,0);
$fpdf->SetFillColor(255,255,255);
$fpdf->SetDrawColor(80,80,80);
$total= 0;

                foreach($datosclientes as $detail)
                {
                   
                    $fpdf->SetX(10.5);
                     $fpdf->Cell(29,6,$detail->serie,'B',0,'C',1);
                     $fpdf->SetFont('Arial','B',5.5);
                   
                     $fpdf->Cell(52.5,6,utf8_encode($detail->equipo),'B',0,'C',1);
                     $fpdf->SetFont('Arial','B',7);
                   
                   
                      $fpdf->SetX(93);
                     $fpdf->Cell(22,6,'Dispositivo','B',0,'C',1);
                     $fpdf->Cell(36,6,$detail->cpu2,'B',0,'C',1);
                     $fpdf->SetFont('Arial','B',7);
                     $fpdf->Cell(18.5,6,$detail->cable_hdmi,'B',0,'C',1);
                     $fpdf->Cell(19.5,6,$detail->cable_av,'B',0,'C',1);
                     $fpdf->Cell(17,6,$detail->control_1,'B',0,'C',1);
                     

                     $fpdf->Ln(6.5);
                     
                     $fpdf->Cell(29,6,'Tipo','B',0,'C',1);
                     $fpdf->Cell(53,6,$detail->tipo,'B',0,'C',1);
                     $fpdf->SetX(93);
                     $fpdf->Cell(22,6,'Nro Sim','B',0,'C',1);
                     $fpdf->Cell(36,6,$detail->tarjeta,'B',0,'C',1);
                    
                    
                     $fpdf->Cell(22,6,'Sim alt','B',0,'C',1);
                     $fpdf->Cell(33,6,$detail->nro_sim_alt,'B',0,'C',1);
                     
                     $fpdf->Ln(6.5);
                     $fpdf->SetX(93);
                     $fpdf->Cell(22,6,'Serie Base','B',0,'C',1);
                     $fpdf->Cell(36,6,$detail->serie_base,'B',0,'C',1);
                     $fpdf->Ln(5.5);
                     $fpdf->SetTextColor(255,255,255);
                     $fpdf->SetFillColor(80,80,80);
                     $fpdf->Cell(196,1,'',0,0,'C',1);
                     $fpdf->Ln();

                   
$fpdf->SetTextColor(0,0,0);
$fpdf->SetFillColor(255,255,255);
$fpdf->SetDrawColor(80,80,80);
                    // $fpdf->Cell(38,10,$detail->tarjeta,'B',0,'C',1);
                    // $fpdf->Cell(24,10,$detail->cable_hdmi,'B',0,'C',1);
                    // $fpdf->Cell(35,10,$detail->cable_av,'B',0,'C',1);
                    // $fpdf->Cell(14,10,$detail->fuente,'B',0,'C',1);
                    // $fpdf->Cell(16.9,10,$detail->otrosaccesorios,'B',0,'C',1);
                    $fpdf->Ln();
                    $fpdf->SetAutoPageBreak(10,100);
                }
                
       
}

//--------------------------------------------END PLANTILLA POSNET----------------------------------------------------


//--------------------------------------------PLANTILLA MOVISTAR----------------------------------------------------
$cadena=substr($identificacioncomparar,0,2);
if ($cadena==$movistar){
    $fpdf->SetY(28);
     $fpdf->SetX(40);
     $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
     $fpdf->Ln();
    $fpdf->Image('../../estilos/imagenes/empresas/a.png',10,26);
$fpdf->SetTextColor(0,0,0);
$fpdf->SetFont('Arial','B',25);
$fpdf->SetY(38);
$fpdf->SetX(90);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->Cell(29,12,'BAJA',0,0,'C',1);

$fpdf->SetTextColor(79,199,255);
$fpdf->SetFont('Arial','B',15);
$fpdf->SetY(39);
$fpdf->SetX(130);
$fpdf->SetTextColor(79,199,255);

$fpdf->Write(10,'REMITO ELECTRONICO');



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
$fpdf->SetFont('Arial','B',10);
$fpdf->SetY(65.5);
$fpdf->SetX(10);
$fpdf->Cell(36,9,'NOMBRE:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(100.5,9,$datosunicos->nombre_cliente,1,0,'C',1);
$fpdf->SetX(140.3);
$fpdf->Cell(30,9,'DNI:',1,0,'C',1);
$fpdf->SetX(170.5);
$fpdf->Cell(35.6,9,$datosunicos->identificacion,1,0,'C',1);

$fpdf->SetY(75);
$fpdf->SetX(10);
$fpdf->Cell(36.5,9,'TELEFONO:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(100.5,9,$datosunicos->telefono1,1,0,'C',1);
$fpdf->SetX(140.3);
$fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
$fpdf->SetX(170.5);
$fpdf->Cell(35.6,9,$datosunicos->codigo_postal,1,0,'C',1);
$fpdf->SetY(84.5);
$fpdf->SetX(10);
$fpdf->Cell(36.5,9,'LOCALIDAD:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(100.5,9,$datosunicos->localidad,1,0,'C',1);
$fpdf->SetX(140.3);
$fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
$fpdf->SetX(170.5);
$fpdf->SetFont('Arial','B',7);
$fpdf->Cell(35.6,9,$datosunicos->provincia,1,0,'C',1);
$fpdf->SetFont('Arial','B',9);
$fpdf->SetY(94);
$fpdf->SetX(10);
$fpdf->Cell(36.5,9,'DIRECCION:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(160,9,$datosunicos->direccion,1,0,'C',1);
$fpdf->SetY(103);
$fpdf->SetX(10);
$fpdf->Cell(36.5,9,'EMAIL:',1,0,'C',1);
$fpdf->SetX(46);
$fpdf->Cell(160,9,$datosunicos->emailcliente,1,0,'C',1);

$fpdf->SetFont('Arial','B',10);
$fpdf->SetY(113.5);
$fpdf->SetX(10);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->Cell(196,5,' DATOS DEL DECODIFICADOR / TERMINAL / COMPONENTES - RETIRADOS',0,0,'C',1);

//abajo de los datos----------------
$fpdf->SetLineWidth(1);
$fpdf->SetTextColor(40,40,40);
$fpdf->SetFillColor(255,255,255);
$fpdf->SetDrawColor(80,80,80);
$fpdf->SetFont('Arial','B',7);
$fpdf->SetY(212);

$fpdf->Cell(196,5,'Entregamos a Posnet S.R.L y esta recibe el equipamiento cuyos datos figuran en el presente informe, a revisar y sin prestar conformidad  respecto de su estado y fun-',0,0,'C',1);
$fpdf->Ln();
$fpdf->Cell(196,5,'cionamiento. Si Posnet S.R.L   determinara la existencia de componentes danados y/o faltantes nos obligamos a continuar abonando el servicio hasta su devolucion   ',0,0,'C',1);
$fpdf->Ln();
$fpdf->Cell(196,5,'y/o reparacion o bien hasta el efectivo pago de los cargos correspondientes. Dejamos constancia asimismo de la inexistencia de operaciones cargadas en el equipa-  ',0,0,'C',1);
$fpdf->Ln();
$fpdf->Cell(196,5,'pendientes de cierre de lote.                                                                                                                                                                                                                                             ',0,0,'C',1);
$fpdf->Ln();
$fpdf->Cell(196,5,'                                                                                                                                                 ',0,0,'C',1);

$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->SetFont('Arial','B',10);
$fpdf->SetY(232);
$fpdf->SetX(10);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->Cell(196,5,'RECOLECTOR                                                                         ENTREGA Nro '.$datosunicos->order_rec,0,0,'C',1);
$fpdf->SetX(40);
$fpdf->SetLineWidth(0.2);
$fpdf->SetFillColor(240,240,240);
$fpdf->SetTextColor(40,40,40);
$fpdf->SetDrawColor(255,255,255);
$fpdf->SetY(240);
$fpdf->SetX(10);
$fpdf->Cell(31,9,'Retira:',1,0,'C',1);
$fpdf->SetX(37);
$fpdf->Cell(69.5,9,$datosunicos->id_recolector_2,1,0,'C',1);
$fpdf->SetX(106.5);
$fpdf->Cell(30,9,'Fecha Emision:',1,0,'C',1);
$fpdf->SetX(137);
$fpdf->Cell(70,9,date('d/m/Y'),1,0,'C',1);




//aca termina ---------------------------
$fpdf->SetFont('Arial','B',9.5);
$fpdf->SetY(120);
$fpdf->SetTextColor(255,255,255);
$fpdf->SetFillColor(79,199,255);
$fpdf->Cell(33,10,'Serie',0,0,'C',1);
$fpdf->Cell(40,10,'Sim Card',0,0,'C',1);
$fpdf->Cell(26.9,10,'Material',0,0,'C',1);
$fpdf->Cell(35,10,'Cable telefonico',0,0,'C',1);
$fpdf->Cell(30,10,'Cargador fuente',0,0,'C',1);
$fpdf->Cell(19,10,'Base',0,0,'C',1);
$fpdf->Cell(12.5,10,'Otros',0,0,'C',1);



$fpdf->Ln();


$fpdf->SetLineWidth(1);
$fpdf->SetTextColor(0,0,0);
$fpdf->SetFillColor(255,255,255);
$fpdf->SetDrawColor(80,80,80);
$total= 0;


                foreach($datosclientes as $detail)
                {
                    $fpdf->Cell(33,10,$detail->serie,'B',0,'C',1);
                    $fpdf->Cell(35,10,$detail->tarjeta,'B',0,'C',1);
                    $fpdf->Cell(38,10,$detail->equipo,'B',0,'C',1);
                    $fpdf->Cell(24,10,$detail->cable_hdmi,'B',0,'C',1);
                    $fpdf->Cell(35,10,$detail->cable_av,'B',0,'C',1);
                    $fpdf->Cell(14,10,$detail->fuente,'B',0,'C',1);
                    $fpdf->Cell(16.9,10,$detail->otrosaccesorios,'B',0,'C',1);
                    $fpdf->Ln();
                    $fpdf->SetAutoPageBreak(10,60);
                }
               
                   
}





//--------------------------------------------END PLANTILLA MOVISTAR----------------------------------------------------
            }




 $fpdf->Output('I','Remitos.pdf');
 $fpdf->Output('F','Remitos.pdf');



 

 


?>




 