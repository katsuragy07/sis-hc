<?php


    function validarToken($tk){
       
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
    }


    

?>