<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "../connect.php";

    $clave = $_GET['index'];


   
    $query = "SELECT TOP(20) * FROM [HLEVLIMAESTE].[dbo].[tb_pbi_paciente] WHERE nombres LIKE '%$clave%' ORDER BY paciente DESC;";
    

 
    $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));


    if($result === false){
        die( print_r( sqlsrv_errors(), true));
    }


    $json = array();
    
    if (0 !== sqlsrv_num_rows($result)){
        while ($row = sqlsrv_fetch_array($result)) {
 
            $json[] = array(
                'id' => $row['paciente'],
                'nro_historia' => $row['nro_historia'],
                'id_tipo_documento' => $row['id_tipo_documento'],
                'nro_documento' => $row['nro_documento'],
                'nombres' => $row['nombres'],
                'situacion' => $row['situacion'],
                'fecha_situacion' => $row['fecha_situacion']
            );   
        }
    }
    
    echo json_encode($json);





?>