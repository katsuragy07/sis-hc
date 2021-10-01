<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    require_once "../connect.php";

    if(isset($_GET['size']) && isset($_GET['offset'])){
        $size = $_GET['size'];
        $offset = $_GET['offset'];
        $query = "SELECT * FROM [dbo].[tb_usuario] ORDER BY idusuario DESC  OFFSET $offset ROWS FETCH NEXT $size ROWS ONLY;"; 
    }else{
        $query = "SELECT * FROM [dbo].[tb_usuario] ORDER BY idusuario DESC;";
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



?>