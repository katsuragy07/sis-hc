<?php

require_once "../../connect.php";

switch($_GET['consulta']){
    case 'buscar': $query = 'SELECT top 20 id,fecha, hora, persona, vinculo, paciente, empresa, telefono, motivo, operador  FROM vw_registro_llamada where estado = 1 order by id desc'; break;
    case 'editar': $id = $_GET['id'];
                   $query = "SELECT * FROM vw_registro_llamada WHERE id='$id'"; break;
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
            'persona' => $row['persona'],
            'vinculo' => $row['vinculo'],
            'fecha' => $row['fecha'],
            'hora' => $row['hora'],
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