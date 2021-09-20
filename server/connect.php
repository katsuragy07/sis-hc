<?php

$serverName = "127.0.0.1, 1433"; //"serverName\instanceName"
$connectionInfo = array( "Database"=>"SIGHEAV_ESTADISTICA", "UID"=>"sa", "PWD"=>"", 'ReturnDatesAsStrings'=>true , "CharacterSet" => "UTF-8");
$conn = sqlsrv_connect($serverName, $connectionInfo);


    if($conn){
         
    }else{
        echo "Conexión no se pudo establecer.<br />";
        die( print_r( sqlsrv_errors(), true));
    }



//printf("Conjunto de caracteres inicial: %s\n", $mysqli->character_set_name());



?>