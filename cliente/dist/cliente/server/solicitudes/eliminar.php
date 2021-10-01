<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "../connect.php";
    require_once "../validar_token.php";

    
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
        $query = "DELETE FROM [dbo].[solicitud_hc] WHERE id_solicitud_hc='$data->id';";
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