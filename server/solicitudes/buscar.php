<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "../connect.php";

    $clave = $_GET['index'];


   
    $query = "SELECT * FROM solicitante WHERE nro_documento = '$clave';";
    

 
    $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));


    if($result === false){
        die( print_r( sqlsrv_errors(), true));
    }


    $json = array();
    
    if (0 !== sqlsrv_num_rows($result)){
        while ($row = sqlsrv_fetch_array($result)) {
 
            $json = array(
                'id' => $row['id_solicitante'],
                'nombre_completo' => $row['nombre_completo']
            );   
        }
    }
    
    echo json_encode($json);





?>