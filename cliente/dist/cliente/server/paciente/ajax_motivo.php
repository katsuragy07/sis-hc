<?php

require_once "../../connect.php";


$query = 'SELECT * FROM motivo;'; 


$result = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));


if($result === false){
    die( print_r( sqlsrv_errors(), true));
}

$json = array();


if (0 !== sqlsrv_num_rows($result)){
    while ($row = sqlsrv_fetch_array($result)) {

      

        $json[] = array(
            'id' => $row['id'],
            'motivo' => $row['motivo'],
            'descripcion' => $row['descripcion']
        );   
    }
}



echo json_encode($json);



?>