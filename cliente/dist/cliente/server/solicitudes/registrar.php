<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "../connect.php";
    require_once "../validar_token.php";
    
    function saltoLinea($str) { 
        return str_replace(array("\r\n", "\r", "\n"), "<br />", $str); 
    }  
    //Modo de uso 
    //$comentarios = saltoLinea($comentarios);

    $json = $_REQUEST['data'];
    $data = json_decode($json);   

    if(isset($_REQUEST['authorization']) && $_REQUEST['authorization']!=null && $_REQUEST['authorization']!=""){
        $token = $_REQUEST['authorization'];
        $val_token = validarToken($token);
        $parset_token = json_decode($val_token);
    }else{
        die('{"code":404}');
    }


    if($parset_token->code=="200" && $parset_token->privilegios=="1"){
        $resultadoBD = false;
        $query = "EXEC [dbo].[pr_i_solicitud_hc] 	
                @expediente_sgd = '$data->expediente_sgd'
                ,@id_tipo_solicitud = '$data->sol_solicitud'
                ,@id_solicitante = '$data->sol_id'
                ,@id_parentesco = '$data->sol_parentesco'
                ,@id_paciente = '$data->pac_id'

                ,@nro_historia = '$data->pac_nro_historia'
                ,@condicion_egr = '$data->pac_situacion'
                ,@fecha_egreso = '$data->pac_fecha_situacion'

                ,@id_estado_solicitud = 1
                ,@encontro_fisico = 0
                ,@orden_cronologico = 0
                ,@rotulo = 0
                ,@cruce_informacion = 0
                ,@control_calidad = 0
               
                ,@id_fedatario = NULL

                ,@f_emergencia = 0
                ,@f_hospitalizacion = 0
                ,@f_uci = 0
                ,@f_anestesio = 0
                ,@f_enfermeria = 0
                ,@f_salud_mental = 0
                ,@f_infectologia = 0
                ,@f_laboratorio = 0
                ,@f_rx = 0
                ,@f_farmacia = 0
                ,@observacion = ''
                ,@id_usuario_registra = 0
                ,@ip_usuario = ''
                ,@nombre_pc = '';"; 
    }else{
        die($parset_token);
    }
    
    
       
    $result =  sqlsrv_query($conn, $query, array());
    if ($result === false){
        die( print_r( sqlsrv_errors(), true));
    }else{
        $resultadoBD = true;
    }
    
    
    if($resultadoBD){
        echo '200';
    }else{
        echo '302';
    }
  
    




?>