<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "../connect.php";
    


    $key = $_GET['index'];
    $type = $_GET['type'];

    switch ($type) {
        case 'name':
            $query = "SELECT * FROM filtros INNER JOIN (
                SELECT idfiltro FROM filtros WHERE filtro_nombre LIKE '%$key%' ORDER BY idfiltro DESC LIMIT 20)
                AS my_results USING (idfiltro);";
            break;
        
        case 'email':
            $query = "SELECT * FROM filtros INNER JOIN (
                SELECT idfiltro FROM filtros WHERE filtro_email LIKE '%$key%' ORDER BY idfiltro DESC LIMIT 20)
                AS my_results USING (idfiltro);";
            break;
    }


    $result = $mysqli->query($query);


    if(!$result){
        die("Query error " . mysqli_error($mysqli));
    }

    $json = array();

    while($row = $result->fetch_array()){
        
        $json[] = array(
            'id' => $row['idfiltro'],
            'name' => $row['filtro_nombre'],
            'email' => $row['filtro_email'] 
        ); 
    
    }

    echo json_encode($json);


    function br2nl($string){
        return preg_replace('/\<br(\s*)?\/?\>/i', "\n", $string);
    }

?>