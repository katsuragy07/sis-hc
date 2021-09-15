<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    require_once "../connect.php";


    $size = $_GET['size'];
    $offset = $_GET['offset'];
    $query = "SELECT * FROM filtros INNER JOIN (SELECT idfiltro FROM filtros ORDER BY idfiltro DESC LIMIT $size OFFSET $offset) AS res USING(idfiltro);"; 

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



?>