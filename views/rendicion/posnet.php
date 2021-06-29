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
             $fpdf->SetTextColor(255,255,255);
    
             $fpdf->Image('../estilos/imagenes/logo.png',2,0.1, 25);
             $fpdf->Image('../estilos/imagenes/empresas/qr1.png',190,1.7,25,20);
    
             $fpdf->SetY(28);
             $fpdf->SetX(30);
             $fpdf->SetFont('Arial','B',9);
             $fpdf->Write(-15,'IMPORTANTE Por consulta sobre el presente retiro 4844-4777 / informes@postalmarketing.com.ar');
             $fpdf->Ln();
             $fpdf->Image('../estilos/imagenes/empresas/posnetclover1.jpg',10,26);
    
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
             $fpdf->Cell(100.5,9,utf8_decode($element["nombre_cliente"]),1,0,'C',1);
             $fpdf->SetX(140.3);
             $fpdf->Cell(30,9,'CUIT:',1,0,'C',1);
             $fpdf->SetX(170.5);
             $fpdf->Cell(35.6,9,utf8_decode($element["identificacion"]),1,0,'C',1);
    
             $fpdf->SetY(75);
             $fpdf->SetX(10);
             $fpdf->Cell(36.5,9,'TELEFONO:',1,0,'C',1);
             $fpdf->SetX(46);
             $fpdf->Cell(100.5,9,utf8_decode($element["telefono_cel4"].' '.$element["telefono_cel5"].' '.$element["telefono_cel6"]),1,0,'C',1);
             $fpdf->SetX(140.3);
             $fpdf->Cell(30,9,'C.POSTAL:',1,0,'C',1);
             $fpdf->SetX(170.5);
             $fpdf->Cell(35.6,9,utf8_decode($element["codigo_postal"]),1,0,'C',1);
             $fpdf->SetY(84.5);
             $fpdf->SetX(10);
             $fpdf->Cell(36.5,9,'LOCALIDAD:',1,0,'C',1);
             $fpdf->SetX(46);
             $fpdf->Cell(100.5,9,utf8_decode($element["localidad"]),1,0,'C',1);
             $fpdf->SetX(140.3);
             $fpdf->Cell(30,9,'PROVINCIA:',1,0,'C',1);
             $fpdf->SetX(170.5);
             $fpdf->SetFont('Arial','B',7);
             $fpdf->Cell(35.6,9,utf8_decode($element["provincia"]),1,0,'C',1);
             $fpdf->SetFont('Arial','B',9);
             $fpdf->SetY(94);
             $fpdf->SetX(10);
             $fpdf->Cell(36.5,9,utf8_decode('DIRECCION:'),1,0,'C',1);
             $fpdf->SetX(40);
    
             $fpdf->SetFont('Arial','B',7);
             $fpdf->Cell(100.5,9,utf8_decode($element["direccion"]),1,0,'C',1);
             $fpdf->SetFont('Arial','B',9);
             $fpdf->Cell(30,9,'RETIRO:',1,0,'C',1);
              
             $date = date_create($element["created_at"]);
             $date_format =  date_format($date,"d/m/Y H:i:s");
            
             $fpdf->Cell(35,9,utf8_decode($date_format),1,0,'C',1);

             $fpdf->SetY(103);
             $fpdf->SetX(10);

             $fpdf->Cell(36.5,9,'EMAIL:',1,0,'C',1);
             $fpdf->SetX(46);
             $fpdf->Cell(100.5,9,utf8_decode($element["email"]),1,0,'C',1);

             $fpdf->SetX(140.3);
             $fpdf->Cell(30,9,'MOTIVO:',1,0,'C',1);
             $fpdf->SetX(170.5);
             $fpdf->SetFont('Arial','B',6);
             $fpdf->Cell(35.6,9,utf8_decode($element["motivo"]),1,0,'C',1);
             $fpdf->SetFont('Arial','B',9);
             $fpdf->SetFont('Arial','B',10);
             $fpdf->SetY(113.5);
             $fpdf->SetX(10);
             $fpdf->SetTextColor(255,255,255);
             $fpdf->SetFillColor(79,199,255);
             $fpdf->Cell(196,5,' DATOS DEL EQUIPO / TERMINAL / COMPONENTES - RETIRADOS',0,0,'C',1);


             
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

             $fpdf->SetX(10.5);
             $fpdf->Cell(29,6,utf8_decode($element["terminal"]),'B',0,'C',1);
             $fpdf->SetFont('Arial','B',5.5);
        
             ($element["estado"] === 'RECUPERADO')
             ?$fpdf->Cell(52.5,6,utf8_encode($element["equipo"]),'B',0,'C',1)
             :$fpdf->Cell(52.5,6,'A VERIFICAR','B',0,'C',1);
            
             $fpdf->SetFont('Arial','B',7);
            
            
             $fpdf->SetX(93);
             $fpdf->Cell(22,6,'Dispositivo','B',0,'C',1);
             $fpdf->Cell(36,6,utf8_decode($element["serie"]),'B',0,'C',1);
             $fpdf->SetFont('Arial','B',7);
             $fpdf->Cell(18.5,6,$element["accesorio_uno"],'B',0,'C',1);
             $fpdf->Cell(19.5,6,$element["accesorio_tres"],'B',0,'C',1);
             $fpdf->Cell(17,6,$element["accesorio_cuatro"],'B',0,'C',1);
            
             $fpdf->Ln(6.5);
            
             $fpdf->Cell(29,6,'Tipo','B',0,'C',1);
             $fpdf->Cell(53,6,$element["tipo"],'B',0,'C',1);
             $fpdf->SetX(93);
             $fpdf->Cell(22,6,'Nro Sim','B',0,'C',1);
             $fpdf->Cell(36,6,$element["tarjeta"],'B',0,'C',1);
        
        
             $fpdf->Cell(22,6,'Sim alt','B',0,'C',1);
             $fpdf->Cell(33,6,utf8_decode($element["chip_alternativo"]),'B',0,'C',1);
            
             $fpdf->Ln(6.5);
             $fpdf->SetX(93);
             $fpdf->Cell(22,6,'Serie Base','B',0,'C',1);
             $fpdf->Cell(36,6,$element["serie_base"],'B',0,'C',1);
             $fpdf->Cell(22,6,'Tipo Rec','B',0,'C',1);
             ($element["estado"] === 'RECUPERADO')
             ?$fpdf->Cell(33,6,'B','B',0,'C',1)
             :$fpdf->Cell(33,6,'A','B',0,'C',1) ; 
             $fpdf->Ln();
             if($element["accesorios"] !== ''){
                 $fpdf->Cell(196,8,'Observacion: '.' '.utf8_decode($element["accesorios"]),'B',0,'C',0);
                 $fpdf->Ln();
             }
             $fpdf->SetTextColor(255,255,255);
             $fpdf->SetFillColor(80,80,80);
             $fpdf->Cell(196,1,'',0,0,'C',1);
             $fpdf->Ln();

             $fpdf->SetTextColor(0,0,0);
             $fpdf->SetFillColor(255,255,255);
             $fpdf->SetDrawColor(80,80,80);
            
             $fpdf->Ln(20);

             $path = '../resources/firmas/'.$element["fecha_firma"].$element["id_orden_pass"].'.png';
                if(file_exists($path)){
                    
                echo '<pre>';
                print_r($path);
                echo '</pre>';
                }
            
             $fpdf->SetAutoPageBreak(10,120);
        }
       
         $fpdf->Output('I','../resources/pdf/rendicion.pdf');
        //  $fpdf->Output('F','../resources/pdf/rendicion.pdf');

        