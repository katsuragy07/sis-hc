<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

    require_once "connect.php";
    require_once "validar_token.php";

    
    if(isset($_REQUEST['authorization']) && $_REQUEST['authorization']!=null && $_REQUEST['authorization']!=""){
        $access_token = $_REQUEST['authorization'];
    }else{
        die('{"code":404}');
    }
    

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'graph.microsoft.com/oidc/userinfo',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $access_token"
        ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);



    if(substr($response,2,5)==="error"){
        $response = substr_replace($response, '"code":404,', 1, 0);
    }else{
        $parse = json_decode($response);

        $query = "SELECT * FROM filtros WHERE filtro_email='$parse->email';";
        $result = $mysqli->query($query);
        $json0 = array();
        while($row = $result->fetch_array()){
            $json0[] = array(
                'id' => $row['idfiltro'],
                'email' => $row['filtro_email']
            );   
        }
        if(/*count($json0)>=1*/true){
            $response = substr_replace($response, '"code":200,', 1, 0);

            $query = "SELECT * FROM usuarios WHERE sub='$parse->sub';";
            $result = $mysqli->query($query);
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
                $response = substr_replace($response, '"privilegios":'.$json[0]["privilegios"].',', 1, 0);
                $response = substr_replace($response, '"idusuario":'.$json[0]["id"].',', 1, 0);
            }else{
                $query = "INSERT INTO `usuarios` (`privilegios`, `sub`, `email`, `name`, `family_name`, `given_name`, `modalidad`) VALUES ('0', '$parse->sub', '$parse->email','$parse->name', '$parse->family_name', '$parse->given_name','');";
                $result = $mysqli->query($query);
                if(!$result){
                    die("Query error " . mysqli_error($mysqli));
                }else{
                    $response = substr_replace($response, '"privilegios":0,', 1, 0);
                }
            }
        }else{
            $response = substr_replace($response, '"code":300,', 1, 0);
        }
        
    }

    echo $response;

?>