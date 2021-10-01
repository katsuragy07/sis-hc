<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "../connect.php";
    require_once "../validar_token.php";
    

    $json = $_REQUEST['data'];
    $data = json_decode($json);   


    function saltoLinea($str) { 
        return str_replace(array("\r\n", "\r", "\n"), "<br />", $str); 
    }  


    if(isset($_REQUEST['authorization']) && $_REQUEST['authorization']!=null && $_REQUEST['authorization']!=""){
        $token = $_REQUEST['authorization'];
        $val_token = validarToken($token);
        $parset_token = json_decode($val_token);
    }else{
        die('{"code":404}');
    }

    
    if($parset_token->code=="200" && $parset_token->privilegios=="1"){
        $resultadoBD = false;
        $query = "EXEC [pr_u_atencion_hc] 
                    @id_solicitud_hc = '$data->id'
                    ,@id_estado_solicitud = '$data->id_estado_solicitud'
                    ,@encontro_fisico = '$data->encontro_fisico'
                    ,@orden_cronologico = '$data->orden_cronologico'
                    ,@rotulo = '$data->rotulo'
                    ,@cruce_informacion = '$data->cruce_informacion'
                    ,@control_calidad = '$data->control_calidad'
                    ,@id_fedatario = NULL
                    ,@f_emergencia = '$data->f_emergencia'
                    ,@f_hospitalizacion = '$data->f_hospitalizacion'
                    ,@f_uci = '$data->f_uci'
                    ,@f_anestesio = '$data->f_anestesio'
                    ,@f_enfermeria = '$data->f_enfermeria'
                    ,@f_salud_mental = '$data->f_salud_mental'
                    ,@f_infectologia = '$data->f_infectologia'
                    ,@f_laboratorio = '$data->f_laboratorio'
                    ,@f_rx = '$data->f_rx'
                    ,@f_farmacia = '$data->f_farmacia'
                    ,@observacion = '$data->observacion'
                    ;";
    }else{
        die("Usuario no autorizado!");
    }
    

   
    $result = sqlsrv_query($conn, $query, array());
    if($result === false){
        die( print_r( sqlsrv_errors(), true));
    }else{
        $resultadoBD = true;

        $query2 = "EXEC dbo.pr_i_pago  
                    @id_solicitud_hc = '$data->id'
                    ,@id_tipo_pago = '1'
                    ,@nro_folio_fisico = '$data->pag_folios'
                    ,@otro_gasto = '$data->pag_otros_gastos'
                    ,@total_pago = '$data->pag_total'
                    ;";

        $result2 = sqlsrv_query($conn, $query2, array());
        if($result2 === false){
            die( print_r( sqlsrv_errors(), true));
        }else{
            $resultadoBD2 = true;
        }


    }
    
   
    if($resultadoBD && $resultadoBD2){
        echo '200';
    }else{
        echo '302';
    }
   


?>