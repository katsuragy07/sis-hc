<?php

    require_once "../../connect.php";

    $id = $_POST['id']; 
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
    //$comentarios = saltoLinea($comentarios);

    $resultadoBD = false;


    $query = "UPDATE tb_registro_llamada SET persona='$persona',vinculo='$vinculo' paciente='$paciente', empresa='$empresa', telefono='$telefono', motivo='$motivo', descripcion='$descripcion' , operador='$operador' WHERE id='$id';";
    
    
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