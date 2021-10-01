<?php

    require_once "../../connect.php";

    $persona = $_POST['inputpersona'];
    $vinculo = $_POST['inputvinculo'];
    $paciente = $_POST['inputpaciente'];
    $empresa = $_POST['inputempresa'];
    $telefono = $_POST['inputtelefono'];
    $motivo = $_POST['inputmotivo'];
    $descripcion = $_POST['inputdescripcion'];
    $operador = $_POST['inputoperador'];
    
    function saltoLinea($str) { 
        return str_replace(array("\r\n", "\r", "\n"), "<br />", $str); 
    }  
    //Modo de uso 
    //$comentarios = saltoLinea($comentarios);
    

    
    $resultadoBD = false;
    

    $query = "INSERT INTO tb_registro_llamada(fecha,persona,vinculo,paciente,empresa,telefono,motivo,descripcion,operador, estado) VALUES (GETDATE(),'$persona','$vinculo','$paciente','$empresa','$telefono','$motivo','$descripcion','$operador', '1');"; 
       
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