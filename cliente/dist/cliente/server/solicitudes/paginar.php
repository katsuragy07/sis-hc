
<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "../connect.php";

    $pages_size = $_GET['size'];
    $query = "SELECT COUNT(*) AS filas FROM [dbo].[solicitud_hc];";
    $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));

    if($result === false){
        die( print_r( sqlsrv_errors(), true));
    }
    if (0 !== sqlsrv_num_rows($result)){
        while ($row = sqlsrv_fetch_array($result)){
            $pages_total = $row['filas'];
        }
    }

    $pages = ceil($pages_total / $pages_size); 
    $json = array();

    if($pages==0){
        $json[] = array(
            'pagina' => 1,
            'size' => 0,
            'offset' => 0
        );   
    }else{
        for($i = 0; $i < $pages; $i++){
            $json[] = array(
                'pagina' => $i+1,
                'size' => $pages_size,
                'offset' => $i*$pages_size
            );   
        }
    }


    echo json_encode($json);


?>