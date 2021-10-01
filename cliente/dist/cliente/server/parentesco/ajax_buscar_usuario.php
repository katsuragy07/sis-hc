<?php

    require_once "../../connect.php";

    $clave = $_GET['clave'];
    $tipo = $_GET['tipo'];

    if($tipo=="EXPEDIENTE"){
        $query = "SELECT id, fecha, hora,persona, vinculo, paciente, empresa, telefono, motivo, operador FROM vw_registro_llamada WHERE paciente LIKE '%$clave%' or empresa LIKE '%$clave%' and estado = 1 order by id desc;";
    }
    
 
    $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));


    if($result === false){
        die( print_r( sqlsrv_errors(), true));
    }


    $json = array();
    
    if (0 !== sqlsrv_num_rows($result)){
        while ($row = sqlsrv_fetch_array($result)) {
    
          
    
            $json[] = array(
                'id' => $row['id'],
                'fecha' => $row['fecha'],
                'hora' => $row['hora'],
                'persona' => $row['persona'],
                'vinculo' => $row['vinculo'],
                'paciente' => $row['paciente'],
                'empresa' => $row['empresa'],
                'telefono' => $row['telefono'],
                'motivo' => $row['motivo'],
                'operador' => $row['operador']
            );   
        }
    }
    
    echo json_encode($json);





?>