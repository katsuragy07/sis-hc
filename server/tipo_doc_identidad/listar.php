<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

require_once "../connect.php";



$query = "SELECT * FROM tipo_documento_identidad;";

$result = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));


if($result === false){
    die( print_r( sqlsrv_errors(), true));
}

$json = array();


if (0 !== sqlsrv_num_rows($result)){
    while ($row = sqlsrv_fetch_array($result)) {
        $json[] = array(
            'id' => $row['id_tipo_documento_identidad'],
            'descripcion' => $row['descripcion'],
            'observacion' => $row['observacion'],
            'nro_caracter' => $row['nro_caracter'],
            'tipo_documento_his' => $row['tipo_documento_his'],
            'estado' => $row['estado'],
            'es_reniec' => $row['es_reniec'],
            'es_reclamo' => $row['es_reclamo']
        );   
    }
}


echo json_encode($json);



?>