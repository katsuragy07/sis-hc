<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");


    require_once "../connect.php";
    require_once '../vendor/autoload.php';


    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $date = date('d-m-y-'.substr((string)microtime(), 1, 8));
    $date = str_replace(".", "", $date);
    $filename = "export_".$date.".xlsx";

    /*
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setCellValue('A1', 'Hello World !');

    $writer = new Xlsx($spreadsheet);
    $writer->save("generated/$filename");

    $file = URI."reportes/generated/$filename";
    echo json_encode($file);
   */



    //$data = '[{"idregistro":"1","iddependencia":"1","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"1","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 05:58 PM"},{"idregistro":"2","iddependencia":"2","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"3","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Logística","fecha":"05-07-2021 05:59 PM"},{"idregistro":"3","iddependencia":"2","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"3","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Logística","fecha":"05-07-2021 06:24 PM"},{"idregistro":"4","iddependencia":"2","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"2","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Logística","fecha":"05-07-2021 06:27 PM"},{"idregistro":"5","iddependencia":"2","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"2","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Logística","fecha":"05-07-2021 06:27 PM"},{"idregistro":"6","iddependencia":"1","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"2","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 06:31 PM"},{"idregistro":"7","iddependencia":"2","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"3","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Logística","fecha":"05-07-2021 06:31 PM"},{"idregistro":"8","iddependencia":"2","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"1","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Logística","fecha":"05-07-2021 06:33 PM"},{"idregistro":"9","iddependencia":"2","idusuario":"2","sub":"UFl5sKl2rgCSHARV2YR0f62WJv3UwgRj2s5XvHXczrA","accion":"1","email":"t_963532608@uncp.edu.pe","name":"ARIAS DE LA CRUZ ANTONY EDUARDO","nombre":"Oficina de Logística","fecha":"05-07-2021 09:20 PM"},{"idregistro":"10","iddependencia":"1","idusuario":"2","sub":"UFl5sKl2rgCSHARV2YR0f62WJv3UwgRj2s5XvHXczrA","accion":"3","email":"t_963532608@uncp.edu.pe","name":"ARIAS DE LA CRUZ ANTONY EDUARDO","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 09:22 PM"},{"idregistro":"11","iddependencia":"2","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"1","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Logística","fecha":"05-07-2021 10:19 PM"},{"idregistro":"12","iddependencia":"1","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"2","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 10:49 PM"},{"idregistro":"13","iddependencia":"2","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"2","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Logística","fecha":"05-07-2021 10:49 PM"},{"idregistro":"14","iddependencia":"1","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"1","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 10:52 PM"},{"idregistro":"15","iddependencia":"1","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"1","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 11:11 PM"},{"idregistro":"16","iddependencia":"1","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"1","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 11:12 PM"},{"idregistro":"17","iddependencia":"1","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"1","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 11:17 PM"},{"idregistro":"18","iddependencia":"1","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"1","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 11:19 PM"},{"idregistro":"19","iddependencia":"1","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"1","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 11:21 PM"},{"idregistro":"20","iddependencia":"1","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"1","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 11:25 PM"},{"idregistro":"21","iddependencia":"2","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"2","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Logística","fecha":"05-07-2021 11:29 PM"},{"idregistro":"23","iddependencia":"2","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"2","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Logística","fecha":"05-07-2021 11:35 PM"},{"idregistro":"24","iddependencia":"2","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"1","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Logística","fecha":"05-07-2021 11:43 PM"},{"idregistro":"25","iddependencia":"1","idusuario":"1","sub":"ekfSoAfR2B4J7bMWjx4sX_SCvwP1LzKGeLr9lff4_0k","accion":"2","email":"aeariasdlc@uncp.edu.pe","name":"Antony Eduardo Arias de la Cruz","nombre":"Oficina de Información y Comunicación","fecha":"05-07-2021 11:46 PM"}]';
    $data = $_POST['data'];
    $data = json_decode($data);

    $resultado1 = [['REGISTRO','EMAIL','NOMBRE','DEPENDENCIA','REGIMEN','FECHA', 'ACTIVIDADES']];
    $resultado2 = [];
    for($i=0; $i<count($data); $i++){
        $resultado2 = [];
        foreach ($data[$i] as $item => $data[$i]){
            array_push($resultado2, $data[$i]);
       }
       array_push($resultado1, $resultado2);
    }

    /*
    $books = [
        ['ISBN01', 'title', 'author', 'publisher', 'ctry' ],
        [618260307, 'The Hobbit', 'J. R. R. Tolkien', 'Houghton Mifflin', 'USA'],
        [908606664, 'Slinky Malinki', 'Lynley Dodd', 'Mallinson Rendel', 'NZ']
    ];
    */
    
    $xlsx = SimpleXLSXGen::fromArray($resultado1);
    $xlsx->saveAs("generated/$filename"); // or downloadAs('books.xlsx') or $xlsx_content = (string) $xlsx 


    $url_gen = URI."reportes/generated/$filename";
    $json = array(
        'url' => $url_gen
    ); 
    echo json_encode($json);

?>