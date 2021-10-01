<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "../connect.php";

    if(isset($_GET['size']) && isset($_GET['offset'])){
        $size = $_GET['size'];
        $offset = $_GET['offset'];
        $query = "EXEC dbo.pr_s_pago_offset @offset = '$offset', @size = '$size'"; 
    }else{
        $query = "exec dbo.pr_s_pago;";
    }
    

    $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if($result === false){
        die( print_r( sqlsrv_errors(), true));
    }

    $json = array();

    if (0 !== sqlsrv_num_rows($result)){
        while ($row = sqlsrv_fetch_array($result)) {
            $json[] = array(
                'id' => $row['id_solicitud_hc'],
                'expediente_sgd' => $row['expediente_sgd'],
                'id_estado_solicitud' => $row['id_estado_solicitud'],
                'estado_solicitud' => $row['estado_solicitud'],

                
                'sol_id' => $row['id_solicitante'],
                /*'sol_dni' => $row['nro_documento_solicitante'],*/
                'sol_nombre' => $row['solicitante'],
                'sol_parentesco' => $row['id_parentesco'],
                'sol_solicitud' => $row['id_tipo_solicitud'],
                'parentesco' => $row['parentesco'],
                'tipo_solicitud' => $row['tipo_solicitud'],


                'pac_id' => $row['id_paciente'],
                'pac_nro_historia' => $row['nro_historia'],
                'pac_nombre' => $row['paciente'],
                'pac_situacion' => $row['condicion_egr'],
                'pac_fecha_situacion' => $row['fecha_egreso'],
                

                'encontro_fisico' => $row['encontro_fisico'],
                'orden_cronologico' => $row['orden_cronologico'],
                'rotulo' => $row['rotulo'],
                'cruce_informacion' => $row['cruce_informacion'],
                'control_calidad' => $row['control_calidad'],
                'id_fedatario' => $row['id_fedatario'],
                'fedatario' => $row['fedatario'],
                'f_emergencia' => $row['f_emergencia'],
                'f_hospitalizacion' => $row['f_hospitalizacion'],
                'f_uci' => $row['f_uci'],
                'f_anestesio' => $row['f_anestesio'],
                'f_enfermeria' => $row['f_enfermeria'],
                'f_salud_mental' => $row['f_salud_mental'],
                'f_infectologia' => $row['f_infectologia'],
                'f_laboratorio' => $row['f_laboratorio'],
                'f_rx' => $row['f_rx'],
                'f_farmacia' => $row['f_farmacia'],
                'observacion' => $row['observacion'],

                'pag_id_pago' => $row['id_pago'],
                'pag_id_tipo_pago' => $row['id_tipo_pago'],
                'pag_tipo_pago' => $row['tipo_pago'],
                'pag_fecha' => $row['fecha_pago'],
                'pag_total' => $row['total_pago'],
            );
        }  
    }

    echo json_encode($json);


?>