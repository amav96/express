<?php 

class pdf extends FPDF
{

}

        $fpdf = new pdf('P','mm','letter',true);
        
        foreach ($object as $element){

        
             $fpdf->AddPage('portrait', 'letter');
             $fpdf->SetMargins(10,30,20,40);
             $fpdf->SetFillColor(18,64,97); 
             $fpdf->Rect(0,0,220,24,'F');
             $fpdf->SetTextColor(255,255,255);
    
             $fpdf->Image('../estilos/imagenes/logo.png',2,0.1, 25);
             $fpdf->Image('../estilos/imagenes/empresas/qr1.png',190,1.7,25,20);

             $fpdf->SetY(28);
             $fpdf->SetX(40);
             $fpdf->SetFont('Arial','B',9);
             $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
             $fpdf->Ln();
             $fpdf->Image('../estilos/imagenes/empresas/lapos1.png',50,30);
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
             $fpdf->Cell(100,9,utf8_decode($element["nombre_cliente"]),1,0,'C',1);
             $fpdf->SetX(140.3);
             $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
             $fpdf->SetX(170.5);
             $fpdf->Cell(35.6,9,utf8_decode($element["created_at"]),1,0,'C',1);
             $fpdf->SetY(75);
             $fpdf->SetX(10);
             $fpdf->Cell(30,9,'IDENTIFICACION:',1,0,'C',1);
             $fpdf->SetX(40);
             $fpdf->Cell(100,9,utf8_decode($element["identificacion"]),1,0,'C',1);
             $fpdf->SetX(140.3);
             $fpdf->Cell(30,9,'EMISION:',1,0,'C',1);
             $fpdf->SetX(170.5);
             $fpdf->Cell(35.6,9,date('d/m/Y'),1,0,'C',1);
             $fpdf->SetY(84.5);
             $fpdf->SetX(10);
             $fpdf->Cell(30,9,'TELEFONO:',1,0,'C',1);
             $fpdf->SetX(40);
             $fpdf->Cell(100,9,utf8_decode($element["telefono_cel4"].' '.$element["telefono_cel5"].' '.$element["telefono_cel6"]),1,0,'C',1);
             $fpdf->SetX(140.3);
             $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
             $fpdf->SetX(170.5);
             $fpdf->Cell(35.6,9,utf8_decode($element["codigo_postal"]),1,0,'C',1);
             $fpdf->SetY(94);
             $fpdf->SetX(10);
             $fpdf->Cell(30,9,'LOCALIDAD:',1,0,'C',1);
             $fpdf->SetX(40);
             $fpdf->Cell(100,9,utf8_decode($element["localidad"]),1,0,'C',1);
             $fpdf->SetX(140.3);
             $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
             $fpdf->SetX(170.5);
             $fpdf->SetFont('Arial','B',7);
            
             $fpdf->Cell(35.6,9,utf8_decode($element["provincia"]),1,0,'C',1);
             $fpdf->SetFont('Arial','B',9);
             $fpdf->SetY(103.5);
             $fpdf->SetX(10);
             $fpdf->Cell(30,9,'DIRECCION:',1,0,'C',1);
             $fpdf->SetX(40);
             $fpdf->Cell(166.3,9,utf8_decode($element["direccion"]),1,0,'C',1);
        
        
             $fpdf->SetY(114);
             $fpdf->SetX(10);
             $fpdf->SetTextColor(255,255,255);
             $fpdf->SetFillColor(79,78,77);
             $fpdf->Cell(196,5,' DATOS DEL EQUIPO / TERMINAL / COMPONENTES - RETIRADOS',0,0,'C',1);
        

        
             $fpdf->SetY(119.6);
             $fpdf->SetTextColor(255,255,255);
             $fpdf->SetFillColor(79,78,77);
             $fpdf->Cell(17,10,'Serie',0,0,'C',1);
             $fpdf->Cell(22,10,'Terminal',0,0,'C',1);
             $fpdf->Cell(33,10,'Tarjeta',0,0,'C',1);
             $fpdf->Cell(35,10,'equipo',0,0,'C',1);
             $fpdf->Cell(25,10,'Cable tlf',0,0,'C',1);
             $fpdf->Cell(13,10,'Sim',0,0,'C',1);
             $fpdf->Cell(20,10,'Cargador',0,0,'C',1);
             $fpdf->Cell(20,10,'Base',0,0,'C',1);
             $fpdf->Cell(11,10,'Tipo',0,0,'C',1);

             $fpdf->Ln();
                    
            $fpdf->SetLineWidth(1);
            $fpdf->SetTextColor(0,0,0);
            $fpdf->SetFillColor(255,255,255);
            $fpdf->SetDrawColor(80,80,80);

            $fpdf->Cell(20,10,utf8_decode($element["terminal"]),'B',0,'C',1);
            $fpdf->Cell(25,10,utf8_decode($element["serie"]),'B',0,'C',1);
            $fpdf->Cell(34,10,utf8_decode($element["tarjeta"]),'B',0,'C',1);
            $fpdf->SetFont('Arial','B',6);
            ($element["estado"] === 'RECUPERADO')
            ? $fpdf->Cell(34,10,utf8_decode($element["equipo"]),'B',0,'C',1)
            : $fpdf->Cell(34,10,'A VERIFICAR','B',0,'C',1);
            
            $fpdf->SetFont('Arial','B',8);
            $fpdf->Cell(17.5,10,$element["accesorio_uno"],'B',0,'C',1);
            $fpdf->Cell(17.5,10,$element["accesorio_dos"],'B',0,'C',1);
            $fpdf->Cell(17.5,10,$element["accesorio_tres"],'B',0,'C',1);
            $fpdf->Cell(17.5,10,$element["accesorio_cuatro"],'B',0,'C',1);
            ($element["estado"] === 'RECUPERADO')
            ? $fpdf->Cell(13.5,10,'B','B',0,'C',1)
            : $fpdf->Cell(13.5,10,'A','B',0,'C',1);
            $fpdf->Ln();
            if($element["accesorios"] !== ''){
                $fpdf->Cell(196,8,'Observacion: '.' '.utf8_decode($element["accesorios"]),'B',0,'C',0);
                $fpdf->Ln();
            }

            
            $path = '../resources/firmas/'.$element["fecha_firma"].$element["id_orden_pass"].'.png';
            $aclaracion = substr($element["aclaracion"],0,25);
            $nombre = substr($element["nombre_cliente"],0,25);
            if(file_exists($path)){
                $fpdf->Image($path,50,187,40,32);
                $fpdf->SetDrawColor(255,255,255);
                $fpdf->SetFont('Arial','B',7);
                $fpdf->SetY(210);
                $fpdf->SetX(90);
                $fpdf->Cell(58,9,utf8_decode($nombre),1,0,'C',1);
                $fpdf->Cell(38,9,utf8_decode($element["identificacion"]),1,0,'C',1);

                $fpdf->SetY(220);

                $fpdf->SetLineWidth(0.5);
                $fpdf->SetTextColor(40,40,40);
                $fpdf->SetFillColor(255,255,255);
                $fpdf->SetDrawColor(80,80,80);
                $fpdf->SetFont('Arial','B',7);
                $fpdf->SetX(50);
                $fpdf->Cell(46,7,'Firma',1,0,'C',1);
                $fpdf->Cell(46,7,'Aclaracion',1,0,'C',1);
                $fpdf->Cell(46,7,'Dni',1,0,'C',1);
             }else{

                $fpdf->SetDrawColor(255,255,255);
                $fpdf->SetFont('Arial','B',7);
                $fpdf->SetY(210);
                $fpdf->SetX(90);
                $fpdf->Cell(58,9,utf8_decode($nombre),1,0,'C',1);
                $fpdf->Cell(38,9,utf8_decode($element["identificacion"]),1,0,'C',1);

                $fpdf->SetY(220);

                $fpdf->SetLineWidth(0.5);
                $fpdf->SetTextColor(40,40,40);
                $fpdf->SetFillColor(255,255,255);
                $fpdf->SetDrawColor(80,80,80);
                $fpdf->SetFont('Arial','B',7);
                $fpdf->SetX(50);
                $fpdf->Cell(46,7,'Firma',1,0,'C',1);
                $fpdf->Cell(46,7,'Aclaracion',1,0,'C',1);
                $fpdf->Cell(46,7,'Dni',1,0,'C',1);

             }

            $fpdf->SetFont('Arial','B',9);
            $fpdf->SetFillColor(18,64,97);
            $fpdf->Rect(0,255,220,25,'F');
            
            $fpdf->SetY(244);
            // $fpdf->SetTextColor(255,255,255);
            $fpdf->SetTextColor(40,40,40);
            $fpdf->SetX(71);
            $codigo = $element["id_orden_pass"].'.'.$element["id_user"];
            $codigoSubStr = substr($codigo,0,100);
            $fpdf->Write(15,$codigoSubStr);
    
            

        }
        // $fpdf->SetAutoPageBreak(10,120);
            //   test
            //  $fpdf->Output('I','../resources/pdf/rendicion.pdf');
             $fpdf->Output('F','../resources/pdf/rendicion'.$FileName.'.pdf');


        