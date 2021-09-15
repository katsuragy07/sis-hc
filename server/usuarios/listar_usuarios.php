<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    require_once "../connect.php";


    $size = $_GET['size'];
    $offset = $_GET['offset'];
    $query = "SELECT * FROM usuarios INNER JOIN (SELECT idusuario FROM usuarios ORDER BY idusuario DESC LIMIT $size OFFSET $offset) AS res USING(idusuario);"; 

    $result = $mysqli->query($query);


    if(!$result){
        die("Query error " . mysqli_error($mysqli));
    }

    $json = array();

    while($row = $result->fetch_array()){

        $json[] = array(
            'id' => $row['idusuario'],
            'privilegios' => $row['privilegios'],
            'sub' => $row['sub'],
            'email' => $row['email'],
            'name' => $row['name'],
            'family_name' => $row['family_name'],
            'given_name' => $row['given_name'],
            'modalidad' => $row['modalidad']
        );   
    
    }

    echo json_encode($json);



?>