<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "../connect.php";
    
    function saltoLinea($str) { 
        return str_replace(array("\r\n", "\r", "\n"), "<br />", $str); 
    }  
    //Modo de uso 
    //$comentarios = saltoLinea($comentarios);

    $json = $_REQUEST['data'];
    $data = json_decode($json);   

    //echo $data->nro_doc;

    
    $resultadoBD = false;
    $query = "EXEC dbo.pr_i_solicitante @primer_apellido='$data->apellido_pat', @segundo_apellido='$data->apellido_mat', @nombre='$data->nombres', @nombre_completo='$data->nombres', @id_tipo_documento_identidad='$data->tipo_doc', @nro_documento='$data->nro_doc', @telefono='$data->telefono', @correo='$data->correo', @observacion='$data->observacion', @id_usuario_registra='', @ip_usuario='', @nombre_pc='';"; 
       
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