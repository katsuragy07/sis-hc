<?php

require_once "connect.php";

$user = $_POST['user_name'];
$pass = $_POST['user_password'];

$query = "SELECT * FROM usuarios WHERE usuario = '$user';";

$result =  sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));



if (0 !== sqlsrv_num_rows($result)){
    while ($row = sqlsrv_fetch_array($result)) {
        if($row['pass']==$pass){
            //echo "usuario correcto";
            session_start();
            $_SESSION['id'] = $row['idusuario'];
            $_SESSION['user'] = $row['usuario'];
            sqlsrv_close($conn);
            header('Location: '."../index.php"); 
            die();
        }else{
            //echo 'contraseña incorrecta';
            sqlsrv_close($conn);
            header('Location: '."../intranet.php?pass=incorrect"); 
            die();
        }
    }
}else{
    die("El usuario no existe, Query error ");
}





//echo 'El usuario no existe';
header('Location: '."../intranet.php?user=incorrect"); 
sqlsrv_close($conn);


?>