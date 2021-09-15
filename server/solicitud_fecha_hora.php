<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    
    date_default_timezone_set("America/Lima");

    

    $json = array(
        "fecha" => date('Y-m-d'),
        "f_year" => date('Y'),
        "f_month" => date('n'),
        "f_day" => date('j'),
        "f_dayname" => date('w'),
        "hora" => date('H:i:s'),
        "h_hora" => date('G'),
        "h_min" => intval(date('i')),
        "h_seg" => date('s'),
        "h_lab" => date('A')
    );



    //echo date('d-m-Y',$mod_date);
    echo json_encode($json);


?>
