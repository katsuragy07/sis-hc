<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    require_once "../connect.php";
    require_once "../validar_token.php";

    $accion = $_POST['accion'];
    $actividades = $_POST['actividades'];
    $dependencia = $_POST['dependencia'];
    $usuario = $_POST['usuario'];


    function saltoLinea($str) { 
        return str_replace(array("\r\n", "\r", "\n"), "<br />", $str); 
    } 
    $actividades = saltoLinea($actividades);



    if(isset($_REQUEST['authorization']) && $_REQUEST['authorization']!=null && $_REQUEST['authorization']!=""){
        $token = $_REQUEST['authorization'];
        $val_token = validarToken($token);
        $parset_token = json_decode($val_token);
    }else{
        die('{"code":404}');
    }

    

    if($parset_token->code=="200" && isset($parset_token->idusuario)){
        $resultadoBD = false;
        $query = "INSERT INTO `registros` (`accion`, `fecha`, `actividades`, `dependencias_iddependencia`, `usuarios_idusuario`) VALUES ('$accion', now(), '$actividades','$dependencia', '$parset_token->idusuario');";
    }else{
        die("Usuario no autorizado!");
    }
    


    $result = $mysqli->query($query);
    
    if(!$result){
        die("Query error " . mysqli_error($mysqli));
    }else{
        $resultadoBD = true;
    }


    if($resultadoBD){
        echo '200';
    }else{
        echo '302';
    }

?>