<?php

    require_once "../../connect.php";

    $id = $_POST['id']; 
   

    $query = "UPDATE tb_registro_llamada SET estado = 0 WHERE id='$id';";
    
   
    $result =  sqlsrv_query($conn, $query, array());


    if($result === false){
        die( print_r( sqlsrv_errors(), true));
    }else{
        echo '200';
    }
 

?>