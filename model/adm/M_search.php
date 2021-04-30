<?php



function buscarCliente($DatoBuscar, $connection){
    mysqli_set_charset($connection, 'utf8');

    if (!empty($DatoBuscar)) {

        $query = "SELECT empresa,identificacion,terminal,serie_base,serie,tarjeta,order_rec,emailcliente,horario_rec,estado_rec,localidad,
        provincia,codigo_postal,direccion,id_orden_pass,nombre_cliente,cable_hdmi,cable_av,fuente,control_1,id_recolector_2
        FROM express where identificacion='$DatoBuscar' or serie='$DatoBuscar' OR tarjeta='$DatoBuscar' OR terminal='$DatoBuscar' ORDER BY horario_rec DESC";
        $result = mysqli_query($connection, $query);

        $json = array();

        if (!$result) {
            die('Query Error' . mysqli_error($connection));
        } else {
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {

                    $json[] = array(
                        'result' => 1,
                        'empresa' => $row['empresa'],
                        'estadoRec' => $row['estado_rec'],
                        'orden' => $row['order_rec'],
                        'fechaRec' => $row['horario_rec'],
                        'identificacion' => $row['identificacion'],
                        'terminal' => $row['terminal'],
                        'serie' => $row['serie'],
                        'serie_base' => $row['serie_base'],
                        'tarjeta' => $row['tarjeta'],
                        'nombreCliente' => $row['nombre_cliente'],
                        'direccion' => $row['direccion'],
                        'provincia' => $row['provincia'],
                        'localidad' => $row['localidad'],
                        'codigoPostal' => $row['codigo_postal'],
                        'cableHdmi' => $row['cable_hdmi'],
                        'cableAv' => $row['cable_av'],
                        'fuente' => $row['fuente'],
                        'control' => $row['control_1'],
                        'recolector' => $row['id_recolector_2'],
                        'idOrdenPass' => $row['id_orden_pass']
                    );
                }
            } else {
                $json[] = array(
                    'result' => 0
                );
            }
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
}


function buscarEnTransito($connection){


        $datoABuscarTransito = $_POST["reciboDatoIngresadoTransito"];

        $sql = "SELECT t.id_orden_pass, t.orden, t.id_recolector, t.terminal, t.serie,
        t.serie_base,t.tarjeta,t.chip_alternativo,t.accesorio_uno,t.accesorio_dos,
        t.accesorio_tres,t.accesorio_cuatro,t.estado,t.motivo,t.fecha,e.identificacion,e.nombre_cliente,
        e.direccion, e.provincia, e.localidad, e.codigo_postal from transito t 
        inner join express e on e.identificacion = t.identificacion  WHERE t.identificacion = '$datoABuscarTransito' OR t.terminal= '$datoABuscarTransito' GROUP BY t.id_serv;";

        $ejecutar = mysqli_query($connection,$sql);

        if($ejecutar){

            if($ejecutar->num_rows>0){

                while($transito = mysqli_fetch_assoc($ejecutar)){
                    $objeto[]= array(
                        'id_orden_pass' => $transito["id_orden_pass"],
                        'orden' => $transito["orden"],
                        'id_recolector' => $transito["id_recolector"],
                        'terminal' => $transito["terminal"],
                        'serie' => $transito["serie"],
                        'serie_base' => $transito["serie_base"],
                        'tarjeta' => $transito["tarjeta"],
                        'chip_alternativo' => $transito["chip_alternativo"],
                        'accesorio_uno' => $transito["accesorio_uno"],
                        'accesorio_dos' => $transito["accesorio_dos"],
                        'accesorio_tres' => $transito["accesorio_tres"],
                        'accesorio_cuatro' => $transito["accesorio_cuatro"],
                        'estado' => $transito["estado"],
                        'motivo' => $transito["motivo"],
                        'fecha' => $transito["fecha"],
                       
                        'identificacion' => $transito["identificacion"],
                        'nombre_cliente' => $transito["nombre_cliente"],
                        'direccion' => $transito["direccion"],
                        'provincia' => $transito["provincia"],
                        'localidad' => $transito["localidad"],
                        'codigo_postal' => $transito["codigo_postal"],

                    );

                }
                $jsonstring = json_encode($objeto);
                echo  $jsonstring;

            }else {
                $objeto = array(
                    'result' => false,
                );
                $jsonstring = json_encode($objeto);
                echo  $jsonstring;
            }
        }else {
            echo  "no se ejecuto por algun problema";
        }


}


function buscarRecoPorFecha($recolector, $connection){
        $fechauno = $_POST['ReciboFechaUno'];
        $fechados = $_POST['ReciboFechaDos'];

        //   $recolector = '1174';
        //   $fechauno = '2020-09-03';
        //   $fechados ='2020-09-07';

        if (!empty($recolector)) {

            mysqli_set_charset($connection, 'utf8');

            $query = "SELECT t.id_orden_pass, t.orden, t.id_recolector, t.terminal, t.serie,
            t.serie_base,t.tarjeta,t.chip_alternativo,t.accesorio_uno,t.accesorio_dos,
            t.accesorio_tres,t.accesorio_cuatro,t.estado,t.motivo,t.fecha,e.identificacion,e.nombre_cliente,
            e.direccion, e.provincia, e.localidad, e.codigo_postal from transito t 
            inner join express e on e.identificacion = t.identificacion  WHERE t.id_recolector = '$recolector'
            and t.estado IN('AUTORIZAR','RECUPERADO','PACTADO',
            'RECHAZADA','EN-USO','NO-TUVO-EQUIPO','NO-EXISTE-NUMERO','NO-RESPONDE','TIEMPO-ESPERA','SE-MUDO','YA-RETIRADO',
            'ZONA-PELIGROSA','NO-TUVO-EQUIPO','N/TEL-EQUIVOCADO','NO-COINCIDE-SERIE')
            and t.fecha >= '$fechauno' AND t.fecha <= '$fechados%' GROUP BY t.id_serv;";

            $result = mysqli_query($connection, $query);


            $json = array();

            if (!$result) {
                die('Query Error' . mysqli_error($connection));
            } else {
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {

                        

                        $json[] = array(
                            'result' => 1,
                            'estadoRec' => $row['estado'],
                            'orden' => $row['orden'],
                            'fechaRec' => $row['fecha'],
                            'identificacion' => $row['identificacion'],
                            'terminal' => $row['terminal'],
                            'serie' => $row['serie'],
                            'tarjeta' => $row['tarjeta'],
                            'serie_base' => $row['serie_base'],
                            'sim_alternativo' => $row['chip_alternativo'],
                            
                            'nombreCliente' => $row['nombre_cliente'],
                            'direccion' => $row['direccion'],
                            'provincia' => $row['provincia'],
                            'localidad' => $row['localidad'],
                            'codigoPostal' => $row['codigo_postal'],
                            'cableHdmi' => $row['accesorio_uno'],
                            'cableAv' => $row['accesorio_dos'],
                            'fuente' => $row['accesorio_tres'],
                            'control' => $row['accesorio_cuatro'],
                            'recolector' => $row['id_recolector'],
                            'idOrdenPass' => $row['id_orden_pass']
                        );
                    }
                } else {
                    $json[] = array(
                        'result' => 0
                    );
                }
            }
            $jsonstring = json_encode($json);
            echo $jsonstring;

            $result->close();
            /* close connection */
            $connection->close();
        }
}

function buscarPorFecha($fechauno, $fechados, $connection){


    if (!empty($fechauno)) {
        mysqli_set_charset($connection, 'utf8');
        $query = "SELECT t.id_orden_pass, t.orden, t.id_recolector, t.terminal, t.serie,
        t.serie_base,t.tarjeta,t.chip_alternativo,t.accesorio_uno,t.accesorio_dos,
        t.accesorio_tres,t.accesorio_cuatro,t.estado,t.motivo,t.fecha,e.identificacion,e.nombre_cliente,
        e.direccion, e.provincia, e.localidad, e.codigo_postal from transito t 
        inner join express e on e.identificacion = t.identificacion  WHERE t.estado IN('AUTORIZAR','RECUPERADO','PACTADO',
        'RECHAZADA','EN-USO','NO-TUVO-EQUIPO','NO-EXISTE-NUMERO','NO-RESPONDE','TIEMPO-ESPERA','SE-MUDO','YA-RETIRADO',
        'ZONA-PELIGROSA','NO-TUVO-EQUIPO','N/TEL-EQUIVOCADO','NO-COINCIDE-SERIE')
        and t.fecha >= '$fechauno' AND t.fecha <= '$fechados%' GROUP BY t.id_serv;";


        $result = mysqli_query($connection, $query);

        $json = array();

        if (!$result) {
            die('Query Error' . mysqli_error($connection));
        } else {
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {

                    $json[] = array(
                        'result' => 1,
                        'estadoRec' => $row['estado'],
                            'orden' => $row['orden'],
                            'fechaRec' => $row['fecha'],
                            'identificacion' => $row['identificacion'],
                            'terminal' => $row['terminal'],
                            'serie' => $row['serie'],
                            'tarjeta' => $row['tarjeta'],
                            'serie_base' => $row['serie_base'],
                            'sim_alternativo' => $row['chip_alternativo'],
                            
                            'nombreCliente' => $row['nombre_cliente'],
                            'direccion' => $row['direccion'],
                            'provincia' => $row['provincia'],
                            'localidad' => $row['localidad'],
                            'codigoPostal' => $row['codigo_postal'],
                            'cableHdmi' => $row['accesorio_uno'],
                            'cableAv' => $row['accesorio_dos'],
                            'fuente' => $row['accesorio_tres'],
                            'control' => $row['accesorio_cuatro'],
                            'recolector' => $row['id_recolector'],
                            'idOrdenPass' => $row['id_orden_pass']
                    );
                }
            } else {
                $json[] = array(
                    'result' => 0
                );
            }
        }

        $jsonstring = json_encode($json);
        echo $jsonstring;





        //   $result->close();

        //   $connection->close();

    }
}
