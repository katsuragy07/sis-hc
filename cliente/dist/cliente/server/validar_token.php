<?php

    require 'vendor/autoload.php';

    use Lindelius\JWT\Algorithm\HMAC\HS256;
    use Lindelius\JWT\JWT;

    class MyJWT extends JWT
    {
        use HS256;
    }

    function validarToken($tk){
        require "connect.php";
        try {
            $decodedJwt = MyJWT::decode($tk);
            $decodedJwt->verify('sishc2021');
            $id = $decodedJwt->id;

            $query = "SELECT * FROM [dbo].[tb_usuario] WHERE idusuario = '$id';";
            $result = sqlsrv_query($conn, $query, array(), array("Scrollable" => SQLSRV_CURSOR_KEYSET ));
            if($result === false){
                die( print_r( sqlsrv_errors(), true));
            }
            if (0 !== sqlsrv_num_rows($result)){
            while ($row = sqlsrv_fetch_array($result)) {
                $get_id = $row['idusuario'];
                $get_privilegios = $row['privilegios'];
                $get_accesos = $row['accesos'];
                $get_email = $row['email'];
                $get_nombre = $row['nombre'];
                $get_apellido = $row['apellido']; 
            }
        }
            
            //return '{"code": "200", "id":"'.$get_id.'"}';
            return '{"code": "200", "id":"'.$get_id.'", "privilegios":"'.$get_privilegios.'", "accesos":"'.$get_accesos.'", "email":"'.$get_email.'", "nombre":"'.$get_nombre.'", "apellido":"'.$get_apellido.'"}';
        }catch (\Exception $e) {
            return '{"code": "404"}';
        }
        catch (\Throwable $e) {
            return '{"code": "404"}';
        }
 
       
        
        //return '{"code": "200", "privilegios": "1", "res":"'.$decodedJwt->verify('sishc2021').'"}';

       /*
        $tk_curl = curl_init();
        curl_setopt_array($tk_curl, array(
            CURLOPT_URL => 'graph.microsoft.com/oidc/userinfo',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $tk"
            ),
        ));
        $tk_response = curl_exec($tk_curl);
        curl_close($tk_curl);
    
    
        if(substr($tk_response,2,5)==="error"){
            $tk_response = substr_replace($tk_response, '"code":404,', 1, 0);
        }else{
            $tk_response = substr_replace($tk_response, '"code":200,', 1, 0);

            
            $mysqli = new mysqli(
                SERVER,USER,PASSWORD,DBNAME
            );
            $parse = json_decode($tk_response);
            $query2 = "SELECT * FROM usuarios WHERE sub='$parse->sub';";
            $result = $mysqli->query($query2);
            if(!$result){
                die("Query error " . mysqli_error($mysqli));
            }
            $json = array();
            while($row = $result->fetch_array()){
                $json[] = array(
                    'id' => $row['idusuario'],
                    'privilegios' => $row['privilegios']
                );   
            }
            if(count($json)>=1){
                $tk_response = substr_replace($tk_response, '"privilegios":'.$json[0]["privilegios"].',', 1, 0);
                $tk_response = substr_replace($tk_response, '"idusuario":'.$json[0]["id"].',', 1, 0);
            }else{
                $tk_response = substr_replace($tk_response, '"privilegios":0,', 1, 0);
            }

            

        }
        


        
        return $tk_response;
        */
    }


    

?>