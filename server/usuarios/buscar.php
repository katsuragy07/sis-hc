<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "../connect.php";
    


    $key = $_GET['index'];
    $type = $_GET['type'];

    switch ($type) {
        case 'email':
                    
            $query = "SELECT TOP(30) * FROM [dbo].[tb_usuario] WHERE email LIKE '%$key%' ORDER BY idusuario DESC;";
            break;
        
        case 'nombre':
            $query = "SELECT TOP(30) * FROM [dbo].[tb_usuario] WHERE nombre LIKE '%$key%' ORDER BY idusuario DESC;";
            break;
    }


    $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));
    if($result === false){
        die( print_r( sqlsrv_errors(), true));
    }

    $json = array();

    if (0 !== sqlsrv_num_rows($result)){
        while ($row = sqlsrv_fetch_array($result)) {
            $json[] = array(
                'id' => $row['idusuario'],
                'privilegios' => $row['privilegios'],
                'accesos' => $row['accesos'],
                'email' => $row['email'],
                'pass' => $row['pass'],
                'nombre' => $row['nombre'],
                'apellido' => $row['apellido']
            );   
        }
    }

    echo json_encode($json);


    function br2nl($string){
        return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
    }

?>