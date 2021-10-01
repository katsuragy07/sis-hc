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
        $query = "exec pr_u_solicitud_hc 	
                @id_solicitud_hc = '$data->id'
                ,@expediente_sgd = '$data->expediente_sgd'
                ,@id_tipo_solicitud = '$data->sol_solicitud'
                ,@id_solicitante = '$data->sol_id'
                ,@id_parentesco = '$data->sol_parentesco'
                ,@id_paciente = '$data->pac_id'
                ,@nro_historia = '$data->pac_nro_historia'
                ,@condicion_egr = '$data->pac_situacion'
                ,@fecha_egreso = '$data->pac_fecha_situacion'
                ;";
    }else{
        die("Usuario no autorizado!");
    }
    

   
    $result = sqlsrv_query($conn, $query, array());
    if($result === false){
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