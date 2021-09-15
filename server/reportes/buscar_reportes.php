<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "../connect.php";
    

    $desde = $_GET['desde'];
    $hasta = $_GET['hasta'];
    $type = $_GET['type'];
    $key = $_GET['index'];
    

    switch ($type) {
        case 'nombre':
            $query = "SELECT * FROM registros 
                        INNER JOIN usuarios ON registros.usuarios_idusuario = usuarios.idusuario
                        INNER JOIN dependencias ON dependencias.iddependencia = registros.dependencias_iddependencia
                        WHERE registros.fecha >= '$desde' AND registros.fecha <= date_add('$hasta', INTERVAL 1 DAY) AND usuarios.name LIKE '%$key%' ORDER BY registros.fecha ASC;";
            break;
        
        case 'email':
            $query = "SELECT * FROM registros 
                        INNER JOIN usuarios ON registros.usuarios_idusuario = usuarios.idusuario
                        INNER JOIN dependencias ON dependencias.iddependencia = registros.dependencias_iddependencia
                        WHERE registros.fecha >= '$desde' AND registros.fecha <= date_add('$hasta', INTERVAL 1 DAY) AND usuarios.email LIKE '%$key%' ORDER BY registros.fecha ASC;";
            break;

        case 'dependencia':
            $query = "SELECT * FROM registros 
                        INNER JOIN usuarios ON registros.usuarios_idusuario = usuarios.idusuario
                        INNER JOIN dependencias ON dependencias.iddependencia = registros.dependencias_iddependencia
                        WHERE registros.fecha >= '$desde' AND registros.fecha <= date_add('$hasta', INTERVAL 1 DAY) AND dependencias.nombre LIKE '%$key%' ORDER BY registros.fecha ASC;";
            break;
        default:
            $query = "SELECT * FROM registros 
                        INNER JOIN usuarios ON registros.usuarios_idusuario = usuarios.idusuario
                        INNER JOIN dependencias ON dependencias.iddependencia = registros.dependencias_iddependencia
                        WHERE registros.fecha >= '$desde' AND registros.fecha <= date_add('$hasta', INTERVAL 1 DAY) ORDER BY registros.fecha ASC;";
            break;

    }


    $result = $mysqli->query($query);


    if(!$result){
        die("Query error " . mysqli_error($mysqli));
    }

    $json = array();

    while($row = $result->fetch_array()){
        
        $json[] = array(
            'idregistro' => $row['idregistro'],
            'iddependencia' => $row['iddependencia'],
            'idusuario' => $row['idusuario'],
            'sub' => $row['sub'],
            'accion' => $row['accion'],
            'email' => $row['email'],
            'name' => $row['name'],
            'nombre' => $row['nombre'],
            'modalidad' => $row['modalidad'],
            'fecha' => date('d-m-Y h:i A',strtotime($row['fecha'])),
            'actividades' => $row['actividades'],
        ); 
    
    }

    echo json_encode($json);


    function br2nl($string){
        return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
    }

?>