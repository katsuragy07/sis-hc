<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "connect.php";
    require_once "validar_token.php";

    if(isset($_REQUEST['authorization']) && $_REQUEST['authorization']!=null && $_REQUEST['authorization']!=""){
        $token = $_REQUEST['authorization'];
        $val_token = validarToken($token);
        $parset_token = json_decode($val_token);
        
        echo json_encode($parset_token);

    }else{
        die('{"code":404}');
    }



    

?>