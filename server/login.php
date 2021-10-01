<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "connect.php";
    require 'vendor/autoload.php';

    use Lindelius\JWT\Algorithm\HMAC\HS256;
    use Lindelius\JWT\JWT;

    class MyJWT extends JWT
    {
        use HS256;
    }


    $json = $_REQUEST['data'];
    $data = json_decode($json);  

    $query = "SELECT * FROM [dbo].[tb_usuario] WHERE email = '$data->email';";

    $result =  sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));

    $json = array();

    if (0 !== sqlsrv_num_rows($result)){
        while ($row = sqlsrv_fetch_array($result)) {
            if($row['pass']==$data->pass){
                //echo "usuario correcto";

                $jwt = MyJWT::create('HS256');
                // Include whatever data is required by your use case
                $jwt->id = $row['idusuario'];
                $jwt->email = $row['email'];
                // Let the JWT expire after 20 minutes (optional, but recommended)
                $jwt->exp = time() + (60 * 20);
                // Encode the JWT using a key suitable for the chosen algorithm
                $encodedJwtHash = $jwt->encode('sishc2021');
                $json = array(
                    'estado' => 200,
                    'access_token' => $encodedJwtHash,
                    'msg' => 'usuario correcto'
                );   
                sqlsrv_close($conn);
                echo json_encode($json);
                die();
            }else{
                //echo 'contraseña incorrecta';
                $json = array(
                    'estado' => 300,
                    'msg' => 'contraseña incorrecta'
                ); 
                sqlsrv_close($conn);
                echo json_encode($json);
                die();
            }
        }
    }else{
        $json = array(
            'estado' => 404,
            'msg' => 'El usuario no existe'
        ); 
        sqlsrv_close($conn);
        echo json_encode($json);
        die();
    }





    //echo 'El usuario no existe';
    $json = array(
        'estado' => 404,
        'msg' => 'El usuario no existe'
    ); 
    sqlsrv_close($conn);
    echo json_encode($json);
    die();


?>